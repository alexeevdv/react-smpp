<?php

namespace tests\unit\Proto\DataCoding;

use alexeevdv\React\Smpp\Proto\DataCoding\UCS2;
use Codeception\Test\Unit;

class UCS2Test extends Unit
{
    public function testEncode()
    {
        $input = 'Ваш код: 311398. Введите его за 30 минут.[Efun Platform]';
        $expectedResult = "0412043004480020043a043e0434003a0020003300310031003300390038002e";
        $expectedResult.= "00200412043204350434043804420435002004350433043e0020043704300020";
        $expectedResult.= "003300300020043c0438043d04430442002e005b004500660075006e00200050";
        $expectedResult.= "006c006100740066006f0072006d005d";

        $encoder = new UCS2;
        $this->assertEquals($expectedResult, bin2hex($encoder->encode($input)));
    }

    public function testDecode()
    {
        $input = "0412043004480020043a043e0434003a0020003300310031003300390038002e";
        $input.= "00200412043204350434043804420435002004350433043e0020043704300020";
        $input.= "003300300020043c0438043d04430442002e005b004500660075006e00200050";
        $input.= "006c006100740066006f0072006d005d";
        $expectedResult = 'Ваш код: 311398. Введите его за 30 минут.[Efun Platform]';

        $decoder = new UCS2;
        $this->assertEquals($expectedResult, $decoder->decode(hex2bin($input)));
    }
}
