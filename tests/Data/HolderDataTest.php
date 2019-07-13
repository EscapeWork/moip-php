<?php

use PHPUnit\Framework\TestCase;
use EscapeWork\Moip\Data\HolderData;

function dd()
{
    var_dump(func_get_args()); die;
}

/**
 * @coversDefaultClass \EscapeWork\Moip\Data\HolderData
 */
class HolderDataTest extends TestCase
{
    /**
     * @test
     * @covers toArray
     */
    public function test_to_array()
    {
        $holderData = new HolderData([
            'fullname'  => 'Luis Dalmolin',
            'birthdate' => '1991-03-10',
            'cpf' => '99999999999',
            'phone' => [
                'areaCode' => '11',
                'number' => '999999999',
            ],
        ]);

        $this->assertEquals('Luis Dalmolin', $holderData->toArray()['fullname']);
        $this->assertEquals('1991-03-10', $holderData->toArray()['birthdate']);
        $this->assertEquals('CPF', $holderData->toArray()['taxDocument']['type']);
        $this->assertEquals('99999999999', $holderData->toArray()['taxDocument']['number']);
        $this->assertEquals('55', $holderData->toArray()['phone']['countryCode']);
        $this->assertEquals('11', $holderData->toArray()['phone']['areaCode']);
        $this->assertEquals('999999999', $holderData->toArray()['phone']['number']);
    }
}
