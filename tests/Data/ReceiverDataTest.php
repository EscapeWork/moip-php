<?php

use PHPUnit\Framework\TestCase;
use EscapeWork\Moip\Data\ReceiverData;

/**
 * @coversDefaultClass \EscapeWork\Moip\Data\ReceiverData
 */
class ReceiverDataTest extends TestCase
{
    /**
     * @test
     * @covers toArray
     */
    public function test_to_array()
    {
        $receiverData = new ReceiverData([
            'type'  => ReceiverData::TYPE_PRIMARY,
            'feePayor' => true,
            'moipAccount' => ['id' => 'MOIP-XXX'],
            'amount' => ['fixed' => 5000],
        ]);

        $this->assertEquals(ReceiverData::TYPE_PRIMARY, $receiverData->toArray()['type']);
        $this->assertTrue($receiverData->toArray()['feePayor']);
        $this->assertEquals('MOIP-XXX', $receiverData->toArray()['moipAccount']['id']);
        $this->assertEquals(5000, $receiverData->toArray()['amount']['fixed']);
    }
}
