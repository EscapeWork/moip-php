<?php

use GuzzleHttp\Client;
use EscapeWork\Moip\Config;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use EscapeWork\Moip\Resources\Order;
use EscapeWork\Moip\Data\ReceiverData;

/**
 * @coversDefaultClass \EscapeWork\Moip\Resources\Order
 */
class OrderTest extends TestCase
{
    /**
     * @var \EscapeWork\Moip\Config
     */
    protected $config;

    public function setUp(): void
    {
        parent::setUp();

        $this->config = Mockery::mock(Config::class);
        $this->config->shouldReceive('configured')->andReturn(true);
        $this->config->client = Mockery::mock(Client::class);
    }

    /**
     * @test
     * @covers ::create
     */
    public function test_create_without_receivers()
    {
        $this->config->client->shouldReceive('post')->once()->withArgs(function ($path, $params) {
            $this->assertArrayNotHasKey('receivers', $params['json']);
            $this->assertEquals('BRL', $params['json']['amount']['currency']);
            $this->assertEquals(1, $params['json']['ownId']);
            $this->assertEquals(2, $params['json']['customer']['ownId']);

            return true;
        })->andReturn(new Response(200, [], json_encode([])));

        $order = new Order($this->config);
        $order->setOrder(['ownId' => 1, 'shipping' => null]);
        $order->setCustomer([
            'ownId' => 2,
            'fullname' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'birthDate' => '1990-04-23',
            'cpf' => '99999999999',

            'phone' => [
                'countryCode' => '55',
                'areaCode' => '11',
                'number' => '999999999',
            ],

            'shippingAddress' => []
        ]);
        $order->create();
    }

    /**
     * @test
     * @covers ::create
     */
    public function test_create_with_receivers()
    {
        $this->config->client->shouldReceive('post')->once()->withArgs(function ($path, $params) {
            $this->assertArrayHasKey('receivers', $params['json']);
            $this->assertCount(2, $params['json']['receivers']);

            $this->assertEquals(ReceiverData::TYPE_PRIMARY, $params['json']['receivers'][0]['type']);
            $this->assertTrue($params['json']['receivers'][0]['feePayor']);
            $this->assertEquals('MOIP-123', $params['json']['receivers'][0]['moipAccount']['id']);
            $this->assertEquals(200, $params['json']['receivers'][0]['amount']['fixed']);
            $this->assertArrayNotHasKey('percentage', $params['json']['receivers'][0]['amount']);

            $this->assertEquals(ReceiverData::TYPE_SECONDARY, $params['json']['receivers'][1]['type']);
            $this->assertFalse($params['json']['receivers'][1]['feePayor']);
            $this->assertEquals('MOIP-234', $params['json']['receivers'][1]['moipAccount']['id']);
            $this->assertEquals(50, $params['json']['receivers'][1]['amount']['fixed']);
            $this->assertArrayNotHasKey('percentage', $params['json']['receivers'][1]['amount']);

            $this->assertEquals('BRL', $params['json']['amount']['currency']);
            $this->assertEquals(1, $params['json']['ownId']);
            $this->assertEquals(2, $params['json']['customer']['ownId']);

            return true;
        })->andReturn(new Response(200, [], json_encode([])));

        $order = new Order($this->config);
        $order->setOrder(['ownId' => 1, 'shipping' => null]);
        $order->setReceiver([
            'type' => ReceiverData::TYPE_PRIMARY,
            'feePayor' => true,
            'moipAccount' => ['id' => 'MOIP-123'],
            'amount' => ['fixed' => 200],
        ]);
        $order->setReceiver([
            'type' => ReceiverData::TYPE_SECONDARY,
            'feePayor' => false,
            'moipAccount' => ['id' => 'MOIP-234'],
            'amount' => ['fixed' => 50],
        ]);
        $order->setCustomer([
            'ownId' => 2,
            'fullname' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'birthDate' => '1990-04-23',
            'cpf' => '99999999999',

            'phone' => [
                'countryCode' => '55',
                'areaCode' => '11',
                'number' => '999999999',
            ],

            'shippingAddress' => []
        ]);
        $order->create();
    }
}
