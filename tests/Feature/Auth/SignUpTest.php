<?php

declare(strict_types=1);

namespace Test\Feature\Auth;

use Test\Feature\WebTestCase;

class SignUpTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $response = $this->post('/auth/signup', [
            'email' => 'test-mail@example.com',
            'password' => 'test-password',
        ]);

        self::assertEquals(201, $response->getStatusCode());
        self::assertJson($content = $response->getBody()->getContents());

        $data = json_decode($content, true);

        self::assertEquals([
            'email' => 'test-mail@example.com',
            'links' => [
                'confirm' => [
                    'url' => '/auth/signup/confirm',
                ],
            ],
        ], $data);
    }
}
