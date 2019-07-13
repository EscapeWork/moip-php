<?php

use PHPUnit\Framework\TestCase;
use EscapeWork\Moip\Data\CreditCardData;

/**
 * @coversDefaultClass \EscapeWork\Moip\Data\CreditCardData
 */
class CreditCardDataTest extends TestCase
{
    /**
     * @test
     * @covers toArray
     */
    public function test_to_array()
    {
        $creditCardData = new CreditCardData([
            'hash' => '12345',
            'holder' => [
                'fullname'  => 'Luis Dalmolin',
                'birthdate' => '1991-03-10',
                'cpf' => '99999999999',
                'phone' => [
                    'areaCode' => '11',
                    'number' => '999999999',
                ],
            ],
        ]);

        $data = $creditCardData->toArray();
        $holderData = $data['holder'];

        $this->assertEquals('12345', $data['hash']);
        $this->assertEquals('Luis Dalmolin', $holderData['fullname']);
        $this->assertEquals('1991-03-10', $holderData['birthdate']);
        $this->assertEquals('CPF', $holderData['taxDocument']['type']);
        $this->assertEquals('99999999999', $holderData['taxDocument']['number']);
        $this->assertEquals('55', $holderData['phone']['countryCode']);
        $this->assertEquals('11', $holderData['phone']['areaCode']);
        $this->assertEquals('999999999', $holderData['phone']['number']);
    }
}
