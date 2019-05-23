<?php

namespace tests\unit\Proto\DataCoding;

use alexeevdv\React\Smpp\Proto\DataCoding\Gsm0338;
use Codeception\Test\Unit;

class Gsm0338Test extends Unit
{
    public function testEncode()
    {
        $input = 'Seqüencia de teste em Portugues';
        $expectedResult = "\x53\x65\x71\x7e\x65\x6e\x63\x69\x61\x20\x64\x65\x20\x74\x65\x73\x74\x65\x20\x65\x6d\x20\x50\x6f\x72\x74\x75\x67\x75\x65\x73";

        $encoder = new Gsm0338;
        $this->assertEquals($expectedResult, $encoder->encode($input));
    }

    public function testDecode()
    {
        $input = "\x53\x65\x71\x7e\x65\x6e\x63\x69\x61\x20\x64\x65\x20\x74\x65\x73\x74\x65\x20\x65\x6d\x20\x50\x6f\x72\x74\x75\x67\x75\x65\x73";
        $expectedResult = 'Seqüencia de teste em Portugues';

        $decoder = new Gsm0338;
        $this->assertEquals($expectedResult, $decoder->decode($input));
    }
}
