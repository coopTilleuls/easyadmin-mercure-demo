<?php

declare(strict_types=1);

namespace App\Tests\E2E\Controller\Admin;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Symfony\Component\Panther\PantherTestCase as E2ETestCase;

/**
 * @see https://github.com/symfony/panther#creating-isolated-browsers-to-test-apps-using-mercure-or-websockets
 */
final class ArticleCrudControllerTest extends E2ETestCase
{
    private const SYMFONY_SERVER_URL = 'http://127.0.0.1:8000'; // Use the Symfony CLI local web server

    private const ARTICLE_LIST_URL = '/admin?crudAction=index&crudControllerFqcn=App\Controller\Admin\ArticleCrudController';

    // this is the second article as we created the first one in the AdminCrud test
    private const ARTICLE_EDIT_URL = '/admin?crudAction=edit&crudControllerFqcn=App\Controller\Admin\ArticleCrudController&entityId=2';

    private const ARTICLE_NEW_URL = '/admin?crudAction=new&crudControllerFqcn=App\Controller\Admin\ArticleCrudController';

    private const NOTIFICATION_SELECTOR = '#conflict_notification';

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function testMercureNotification(): void
    {
        $this->takeScreenshotIfTestFailed();

        // 1st administrator connects
        $client = self::createPantherClient([
            'external_base_uri' => self::SYMFONY_SERVER_URL,
        ]);

        $client->request('GET', self::ARTICLE_LIST_URL);
        self::assertSelectorTextContains('body', 'Article');
        self::assertSelectorTextContains('body', 'Add Article');

        // 1st administrator creates an article
        $client->request('GET', self::ARTICLE_NEW_URL);
        $client->submitForm('Create', [
            'Article[code]' => 'CDB142',
            'Article[description]' => 'Chaise de bureau 2',
            'Article[quantity]' => '10',
            'Article[price]' => '50',
        ]);

        // 1st admin access the edit page of the article he just created
        $client->request('GET', self::ARTICLE_EDIT_URL);

        self::assertSelectorTextContains('body', 'Save changes');
        // self::assertSelectorIsNotVisible(self::NOTIFICATION_SELECTOR); // does not work on CI

        // 2nd administrator access the edit page of the same article and modifies the quantity
        $client2 = self::createAdditionalPantherClient();
        $client2->request('GET', self::ARTICLE_EDIT_URL);
        $client2->submitForm('Save changes', [
            'Article[quantity]' => '9',
        ]);

        // 1st admin has a notification thanks to Mercure and is invited to reload the page
        $client->waitForVisibility(self::NOTIFICATION_SELECTOR);

        self::assertSelectorIsVisible(self::NOTIFICATION_SELECTOR);
        self::assertSelectorTextContains(self::NOTIFICATION_SELECTOR, 'The data displayed is outdated');
        self::assertSelectorTextContains(self::NOTIFICATION_SELECTOR, 'Reload');
    }
}
