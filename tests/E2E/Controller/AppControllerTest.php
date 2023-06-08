<?php

declare(strict_types=1);

namespace App\Tests\E2E\Controller;

use Symfony\Component\Panther\PantherTestCase as E2ETestCase;

final class AppControllerTest extends E2ETestCase
{
    public function testHome(): void
    {
        $client = self::createPantherClient([
            'external_base_uri' => 'http://127.0.0.1:8000', // use the Symfony CLI
        ]);
        $client->request('GET', '/');
        self::assertSelectorTextContains('body', 'Mercure demo');
    }
}
