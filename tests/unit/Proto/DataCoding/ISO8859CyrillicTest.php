<?php

namespace tests\unit\Proto\DataCoding;

use alexeevdv\React\Smpp\Proto\DataCoding\ISO8859Cyrillic;
use Codeception\Test\Unit;

class ISO8859CyrillicTest extends Unit
{
    public function testEncode()
    {
        $input = 'Получите 100% ежедневное предложение на example.com/spd сейчас! Войдите в систему с AngelMania и играйте по-своему!';
        $output = 'bfdedbe3e7d8e2d5203130302520d5d6d5d4ddd5d2ddded520dfe0d5d4dbded6d5ddd8d520ddd0206578616d706c652e636f6d2f73706420e1d5d9e7d0e12120b2ded9d4d8e2d520d220e1d8e1e2d5dce320e120416e67656c4d616e696120d820d8d3e0d0d9e2d520dfde2de1d2ded5dce321';
        $encoder = new ISO8859Cyrillic;
        $this->assertEquals($output, bin2hex($encoder->encode($input)));
    }

    public function testDecode()
    {
        $input = 'bfdedbe3e7d8e2d5203130302520d5d6d5d4ddd5d2ddded520dfe0d5d4dbded6d5ddd8d520ddd0206578616d706c652e636f6d2f73706420e1d5d9e7d0e12120b2ded9d4d8e2d520d220e1d8e1e2d5dce320e120416e67656c4d616e696120d820d8d3e0d0d9e2d520dfde2de1d2ded5dce321';
        $output = 'Получите 100% ежедневное предложение на example.com/spd сейчас! Войдите в систему с AngelMania и играйте по-своему!';
        $decoder = new ISO8859Cyrillic;
        $this->assertEquals($output, $decoder->decode(hex2bin($input)));
    }
}
