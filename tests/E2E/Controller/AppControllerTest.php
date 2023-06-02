<?php

declare(strict_types=1);

namespace App\Tests\E2E\Controller;

use Symfony\Component\Panther\PantherTestCase as E2ETestCase;

final class AppControllerTest extends E2ETestCase
{
    public function testHome(): void
    {
        $client = self::createPantherClient();
        $client->request('GET', '/');
        self::assertSelectorTextContains('body', 'EasyAdmin+Mercure');
    }
}
