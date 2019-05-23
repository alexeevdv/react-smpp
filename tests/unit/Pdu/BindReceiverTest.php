<?php

namespace tests\unit\Pdu;

use alexeevdv\React\Smpp\Pdu\BindReceiver;
use Codeception\Test\Unit;

class BindReceiverTest extends Unit
{
    public function testParsingRawData()
    {
        $data = '546573745f73667477005a66342a5055526d000034000000';
        $pdu = new BindReceiver(0x00000000, 0x00000001, hex2bin($data));

        $this->assertEquals('Test_sftw', $pdu->getSystemId());
        $this->assertEquals('Zf4*PURm', $pdu->getPassword());
        $this->assertEquals('', $pdu->getSystemType());
        $this->assertEquals(52, $pdu->getInterfaceVersion());
        $this->assertEquals(null, $pdu->getAddress());
    }

    public function testAssemblingData()
    {
        $pdu = new BindReceiver;
        $pdu->setSystemId('Test_sftw');
        $pdu->setPassword('Zf4*PURm');
        $pdu->setSystemType('');
        $pdu->setInterfaceVersion(52);
        $pdu->setAddress(null);

        $expectedData = '00000028000000010000000000000001546573745f73667477005a66342a5055526d000034000000';
        $this->assertEquals(hex2bin($expectedData), $pdu->__toString());
    }
}
