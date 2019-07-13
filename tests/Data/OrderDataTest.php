<?php

use PHPUnit\Framework\TestCase;
use EscapeWork\Moip\Data\OrderData;

/**
 * @coversDefaultClass \EscapeWork\Moip\Data\OrderData
 */
class OrderDataTest extends TestCase
{
    /**
     * @test
     * @covers toArray
     */
    public function test_to_array()
    {
        $orderData = new OrderData([
            'ownId'  => '12345',
            'currency' => 'BRL',
        ]);

        $this->assertEquals('12345', $orderData->toArray()['ownId']);
        $this->assertEquals('BRL', $orderData->toArray()['currency']);
    }
}
