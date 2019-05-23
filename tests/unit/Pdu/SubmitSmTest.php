<?php

namespace tests\unit\Pdu;

use alexeevdv\React\Smpp\Pdu\SubmitSm;
use Codeception\Test\Unit;

class SubmitSmTest extends Unit
{
    public function testParsingRawData()
    {
        $rawData = "0005004566756e000101373939393837333937333800030000003139303532343039303831393030302b000100080070";
        $rawData.= "0412043004480020043a043e0434003a0020003300310031003300390038002e";
        $rawData.= "00200412043204350434043804420435002004350433043e0020043704300020";
        $rawData.= "003300300020043c0438043d04430442002e005b004500660075006e00200050";
        $rawData.= "006c006100740066006f0072006d005d";

        $pdu = new SubmitSm(9, 1, hex2bin($rawData));

        $this->assertEquals('', $pdu->getServiceType());
        $this->assertEquals(5, $pdu->getSourceAddress()->getTon());
        $this->assertEquals(0, $pdu->getSourceAddress()->getNpi());
        $this->assertEquals('Efun', $pdu->getSourceAddress()->getValue());
        $this->assertEquals(1, $pdu->getDestinationAddress()->getTon());
        $this->assertEquals(1, $pdu->getDestinationAddress()->getNpi());
        $this->assertEquals('79998739738', $pdu->getDestinationAddress()->getValue());
        $this->assertEquals(3, $pdu->getEsmClass());
        $this->assertEquals(8, $pdu->getDataCoding());
        $this->assertEquals("Ваш код: 311398. Введите его за 30 минут.[Efun Platform]", $pdu->getShortMessage());
        // protocol_id":0,"priority_flag":0,"schedule_delivery_time":"","validity_period":"2019-05-24T09:08:19.000Z","registered_delivery":1,"replace_if_present_flag":0
        // sm_default_msg_id: 0
    }

    /*

    000000b0 00000004 00000000 032dbcc2

     */
}
