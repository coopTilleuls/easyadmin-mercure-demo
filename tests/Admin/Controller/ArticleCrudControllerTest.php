<?php

declare(strict_types=1);

namespace App\Tests\Admin\Controller;

use App\Controller\Admin\ArticleCrudController;
use App\Controller\Admin\DashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Test\AbstractCrudTestCase;

/**
 * @see https://symfony.com/bundles/EasyAdminBundle/current/tests.html
 */
final class ArticleCrudControllerTest extends AbstractCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return ArticleCrudController::class;
    }

    protected function getDashboardFqcn(): string
    {
        return DashboardController::class;
    }

    public function testRedirectOnRoot(): void
    {
        $this->client->request('GET', '/admin');
        self::assertResponseRedirects();
    }

    public function testIndexPage(): void
    {
        $this->client->request('GET', $this->generateIndexUrl());
        self::assertResponseIsSuccessful();
        self::assertIndexFullEntityCount(0);
    }

    public function testNewPage(): void
    {
        $crawler = $this->client->request('GET', $this->generateNewFormUrl());
        self::assertResponseIsSuccessful();

        $form = $crawler->selectButton('Create')->form(); // create and add...
        $this->client->followRedirects();

        $this->client->submit($form, [
            $form->getName().'[code]' => 'CDB141',
            $form->getName().'[description]' => 'Chaise de bureau 1',
            $form->getName().'[quantity]' => '11',
            $form->getName().'[price]' => '51',
        ]);
        self::assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateIndexUrl());
        self::assertResponseIsSuccessful();
        self::assertIndexFullEntityCount(1);
    }
}
