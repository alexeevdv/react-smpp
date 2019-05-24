<?php

namespace tests\unit\Pdu;

use alexeevdv\React\Smpp\Pdu\SubmitSmResp;
use Codeception\Test\Unit;

class SubmitSmRespTest extends Unit
{
    public function testParseData()
    {
        $rawData = '64336163303766392d343362382d343263372d623330342d34333334383732656332393900';
        $pdu = new SubmitSmResp(hex2bin($rawData));
        $this->assertEquals('d3ac07f9-43b8-42c7-b304-4334872ec299', $pdu->getMessageId());
    }

    public function testDataAssembly()
    {
        $expectedData = '0000003580000004000000000000000164336163303766392d343362382d343263372d623330342d34333334383732656332393900';
        $pdu = new SubmitSmResp;
        $pdu->setMessageId('d3ac07f9-43b8-42c7-b304-4334872ec299');
        $this->assertEquals(hex2bin($expectedData), $pdu->__toString());
    }
}
