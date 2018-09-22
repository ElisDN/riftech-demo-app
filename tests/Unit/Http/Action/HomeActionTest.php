<?php

namespace Test\Unit\Http\Action;

use App\Http\Action\HomeAction;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class HomeActionTest extends TestCase
{
    public function testSuccess(): void
    {
        $action = new HomeAction();

        $response = $action->handle(new ServerRequest());

        self::assertEquals(200, $response->getStatusCode());
        self::assertJson($content = $response->getBody()->getContents());

        $data = json_decode($content, true);

        self::assertEquals(['name' => 'Api'], $data);
    }
}
