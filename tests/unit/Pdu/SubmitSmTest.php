<?php

namespace tests\unit\Pdu;

use alexeevdv\React\Smpp\Pdu\SubmitSm;
use alexeevdv\React\Smpp\Proto\Address;
use Codeception\Test\Unit;
use DateTime;

class SubmitSmTest extends Unit
{
    public function testParsingRawData()
    {
        $rawData = "0005004566756e000101373939393837333937333800030000003139303532343039303831393030302b000100080070";

        $message = "0412043004480020043a043e0434003a0020003300310031003300390038002e";
        $message.= "00200412043204350434043804420435002004350433043e0020043704300020";
        $message.= "003300300020043c0438043d04430442002e005b004500660075006e00200050";
        $message.= "006c006100740066006f0072006d005d";

        $pdu = new SubmitSm(hex2bin($rawData . $message));

        $this->assertEquals('', $pdu->getServiceType());
        $this->assertEquals(Address\Ton::alphanumeric(), $pdu->getSourceAddress()->getTon());
        $this->assertEquals(Address\Npi::unknown(), $pdu->getSourceAddress()->getNpi());
        $this->assertEquals('Efun', $pdu->getSourceAddress()->getValue());
        $this->assertEquals(Address\Ton::international(), $pdu->getDestinationAddress()->getTon());
        $this->assertEquals(Address\Npi::isdn(), $pdu->getDestinationAddress()->getNpi());
        $this->assertEquals('79998739738', $pdu->getDestinationAddress()->getValue());
        $this->assertEquals(3, $pdu->getEsmClass());
        $this->assertEquals(8, $pdu->getDataCoding());
        $this->assertEquals(hex2bin($message), $pdu->getShortMessage());
        $this->assertEquals('2019-05-24 09:08:19', $pdu->getValidityPeriod()->format('Y-m-d H:i:s'));
        $this->assertNull($pdu->getScheduleDeliveryTime());
        $this->assertEquals(1, $pdu->getRegisteredDelivery());
    }

    public function testParsingRawData2()
    {
        $rawData = '0005013334313630343630303630000501323334383131373835393039330000000000000100000006';
        $message = '313233343536';

        $pdu = new SubmitSm(hex2bin($rawData . $message));

        $this->assertEquals('', $pdu->getServiceType());
        $this->assertEquals(Address\Ton::alphanumeric(), $pdu->getSourceAddress()->getTon());
        $this->assertEquals(Address\Npi::isdn(), $pdu->getSourceAddress()->getNpi());
        $this->assertEquals('34160460060', $pdu->getSourceAddress()->getValue());
        $this->assertEquals(Address\Ton::alphanumeric(), $pdu->getDestinationAddress()->getTon());
        $this->assertEquals(Address\Npi::isdn(), $pdu->getDestinationAddress()->getNpi());
        $this->assertEquals('2348117859093', $pdu->getDestinationAddress()->getValue());
        $this->assertEquals(0, $pdu->getEsmClass());
        $this->assertEquals(0, $pdu->getDataCoding());
        $this->assertEquals(hex2bin($message), $pdu->getShortMessage());
        $this->assertNull($pdu->getValidityPeriod());
        $this->assertNull($pdu->getScheduleDeliveryTime());
        $this->assertEquals(1, $pdu->getRegisteredDelivery());
    }

    public function testParsingRawData3()
    {
        $rawData = '0005013334313630343630303630000501323334383131373634363839320000000000000100060074';
        $message = 'bfdedbe3e7d8e2d5203130302520d5d6d5d4ddd5d2ddded520dfe0d5d4dbded6';
        $message.= 'd5ddd8d520ddd0207370632d706c792e636f6d2f73706420e1d5d9e7d0e12120b';
        $message.= '2ded9d4d8e2d520d220e1d8e1e2d5dce320e120416e67656c736f7068696120d8';
        $message.= '20d8d3e0d0d9e2d520dfde2de1d2ded5dce321';

        $pdu = new SubmitSm(hex2bin($rawData . $message));

        $this->assertEquals('', $pdu->getServiceType());
        $this->assertEquals(Address\Ton::alphanumeric(), $pdu->getSourceAddress()->getTon());
        $this->assertEquals(Address\Npi::isdn(), $pdu->getSourceAddress()->getNpi());
        $this->assertEquals('34160460060', $pdu->getSourceAddress()->getValue());
        $this->assertEquals(Address\Ton::alphanumeric(), $pdu->getDestinationAddress()->getTon());
        $this->assertEquals(Address\Npi::isdn(), $pdu->getDestinationAddress()->getNpi());
        $this->assertEquals('2348117646892', $pdu->getDestinationAddress()->getValue());
        $this->assertEquals(0, $pdu->getEsmClass());
        $this->assertEquals(6, $pdu->getDataCoding());
        $this->assertEquals(hex2bin($message), $pdu->getShortMessage());
        $this->assertNull($pdu->getValidityPeriod());
        $this->assertNull($pdu->getScheduleDeliveryTime());
    }

    public function testAssemblingData()
    {
        $rawData = "000000b0000000040000000000000001";
        $rawData.= "0005004566756e000101373939393837333937333800030000003139303532343039303831393030302b000100080070";
        $message = "0412043004480020043a043e0434003a0020003300310031003300390038002e";
        $message.= "00200412043204350434043804420435002004350433043e0020043704300020";
        $message.= "003300300020043c0438043d04430442002e005b004500660075006e00200050";
        $message.= "006c006100740066006f0072006d005d";

        $pdu = new SubmitSm;

        $pdu->setServiceType('');
        $pdu->setSourceAddress(new Address(
            Address\Ton::alphanumeric(),
            Address\Npi::unknown(),
            'Efun'
        ));
        $pdu->setDestinationAddress(new Address(
            Address\Ton::international(),
            Address\Npi::isdn(),
            '79998739738')
        );
        $pdu->setEsmClass(3);
        $pdu->setDataCoding(8);
        $pdu->setValidityPeriod(
            DateTime::createFromFormat('Y-m-d H:i:s', '2019-05-24 09:08:19')
        );
        $pdu->setShortMessage(hex2bin($message));
        $pdu->setRegisteredDelivery(1);

        $this->assertEquals(hex2bin($rawData . $message), $pdu->__toString());
    }
}
