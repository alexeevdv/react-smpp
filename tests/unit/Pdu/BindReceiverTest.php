<?php

namespace tests\unit\Pdu;

use alexeevdv\React\Smpp\Pdu\BindReceiver;
use alexeevdv\React\Smpp\Proto\Address;
use Codeception\Test\Unit;

final class BindReceiverTest extends Unit
{
    public function testParsingRawData(): void
    {
        $data = '546573745f73667477005a66342a5055526d000034000000';
        $pdu = new BindReceiver(hex2bin($data));

        self::assertSame('Test_sftw', $pdu->getSystemId());
        self::assertSame('Zf4*PURm', $pdu->getPassword());
        self::assertSame('', $pdu->getSystemType());
        self::assertSame(52, $pdu->getInterfaceVersion());
        self::assertInstanceOf(Address::class, $pdu->getAddress());
        self::assertEquals(Address\Ton::unknown(), $pdu->getAddress()->getTon());
        self::assertEquals(Address\Npi::unknown(), $pdu->getAddress()->getNpi());
        self::assertSame('', $pdu->getAddress()->getValue());
    }

    public function testAssemblingData(): void
    {
        $pdu = new BindReceiver();
        $pdu->setSystemId('Test_sftw');
        $pdu->setPassword('Zf4*PURm');
        $pdu->setSystemType('');
        $pdu->setInterfaceVersion(52);
        $pdu->setAddress(null);

        $expectedData = '00000028000000010000000000000001546573745f73667477005a66342a5055526d000034000000';
        self::assertSame(hex2bin($expectedData), $pdu->__toString());
    }
}
