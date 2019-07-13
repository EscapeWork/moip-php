<?php

use PHPUnit\Framework\TestCase;
use EscapeWork\Moip\Data\ReceiverAmountData;

/**
 * @coversDefaultClass \EscapeWork\Moip\Data\ReceiverAmountData
 */
class ReceiverAmountDataTest extends TestCase
{
    /**
     * @test
     * @covers toArray
     */
    public function test_to_array_with_fixed_amount()
    {
        $amountData = new ReceiverAmountData([
            'fixed' => 5000,
        ]);

        $this->assertEquals(5000, $amountData->toArray()['fixed']);
        $this->assertArrayNotHasKey('percentual', $amountData->toArray());
    }

    /**
     * @test
     * @covers toArray
     */
    public function test_to_array_with_percentual_amount()
    {
        $amountData = new ReceiverAmountData([
            'percentual' => 50,
        ]);

        $this->assertEquals(50, $amountData->toArray()['percentual']);
        $this->assertArrayNotHasKey('fixed', $amountData->toArray());
    }
}
