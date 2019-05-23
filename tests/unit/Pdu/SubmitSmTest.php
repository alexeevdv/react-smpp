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

        $pdu = new SubmitSm(0, 1, hex2bin($rawData . $message));

        $this->assertEquals('', $pdu->getServiceType());
        $this->assertEquals(5, $pdu->getSourceAddress()->getTon());
        $this->assertEquals(0, $pdu->getSourceAddress()->getNpi());
        $this->assertEquals('Efun', $pdu->getSourceAddress()->getValue());
        $this->assertEquals(1, $pdu->getDestinationAddress()->getTon());
        $this->assertEquals(1, $pdu->getDestinationAddress()->getNpi());
        $this->assertEquals('79998739738', $pdu->getDestinationAddress()->getValue());
        $this->assertEquals(3, $pdu->getEsmClass());
        $this->assertEquals(8, $pdu->getDataCoding());
        $this->assertEquals(hex2bin($message), $pdu->getShortMessage());
        $this->assertEquals('2019-05-24 09:08:19', $pdu->getValidityPeriod()->format('Y-m-d H:i:s'));
        $this->assertNull($pdu->getScheduleDeliveryTime());
        // "protocol_id":0,"priority_flag":0,"registered_delivery":1,"replace_if_present_flag":0, "sm_default_msg_id": 0
    }

    public function testParsingRawData2()
    {
        $rawData = '0005013334313630343630303630000501323334383131373835393039330000000000000100000006';
        $message = '313233343536';

        $pdu = new SubmitSm(0, 1, hex2bin($rawData . $message));

        $this->assertEquals('', $pdu->getServiceType());
        $this->assertEquals(5, $pdu->getSourceAddress()->getTon());
        $this->assertEquals(1, $pdu->getSourceAddress()->getNpi());
        $this->assertEquals('34160460060', $pdu->getSourceAddress()->getValue());
        $this->assertEquals(5, $pdu->getDestinationAddress()->getTon());
        $this->assertEquals(1, $pdu->getDestinationAddress()->getNpi());
        $this->assertEquals('2348117859093', $pdu->getDestinationAddress()->getValue());
        $this->assertEquals(0, $pdu->getEsmClass());
        $this->assertEquals(0, $pdu->getDataCoding());
        $this->assertEquals(hex2bin($message), $pdu->getShortMessage());
        $this->assertNull($pdu->getValidityPeriod());
        $this->assertNull($pdu->getScheduleDeliveryTime());
        //"protocol_id":0,"priority_flag":0,"registered_delivery":1,"replace_if_present_flag":0,"sm_default_msg_id":0
    }

    public function testParsingRawData3()
    {
        $rawData = '0005013334313630343630303630000501323334383131373634363839320000000000000100060074';
        $message = 'bfdedbe3e7d8e2d5203130302520d5d6d5d4ddd5d2ddded520dfe0d5d4dbded6';
        $message.= 'd5ddd8d520ddd0207370632d706c792e636f6d2f73706420e1d5d9e7d0e12120b';
        $message.= '2ded9d4d8e2d520d220e1d8e1e2d5dce320e120416e67656c736f7068696120d8';
        $message.= '20d8d3e0d0d9e2d520dfde2de1d2ded5dce321';

        $pdu = new SubmitSm(0, 1, hex2bin($rawData . $message));

        $this->assertEquals('', $pdu->getServiceType());
        $this->assertEquals(5, $pdu->getSourceAddress()->getTon());
        $this->assertEquals(1, $pdu->getSourceAddress()->getNpi());
        $this->assertEquals('34160460060', $pdu->getSourceAddress()->getValue());
        $this->assertEquals(5, $pdu->getDestinationAddress()->getTon());
        $this->assertEquals(1, $pdu->getDestinationAddress()->getNpi());
        $this->assertEquals('2348117646892', $pdu->getDestinationAddress()->getValue());
        $this->assertEquals(0, $pdu->getEsmClass());
        $this->assertEquals(6, $pdu->getDataCoding());
        $this->assertEquals(hex2bin($message), $pdu->getShortMessage());
        $this->assertNull($pdu->getValidityPeriod());
        $this->assertNull($pdu->getScheduleDeliveryTime());
        // "protocol_id":0,"priority_flag":0,"registered_delivery":1, "replace_if_present_flag":0,"sm_default_msg_id":0
    }
    /*

    /*

0000: 0000 00ec 0000 0004 0000 0000 0000 0011 0005 0133 3431 3630 3436 3030 3630 0005  ...................34160460060..
0020: 0132 3334 3831 3139 3236 3536 3530 0000 0000 0000 0100 0000 b347 7261 6220 796f  .2348119265650...........Grab yo
0040: 7572 2031 3030 2520 4461 696c 7920 4465 616c 2061 7420 7370 632d 706c 792e 636f  ur 100% Daily Deal at spc-ply.co
0060: 6d2f 7370 6420 6e6f 7721 204c 6f67 2069 6e20 7769 7468 2041 6e67 656c 736f 7068  m/spd now! Log in with Angelsoph
0080: 6961 2061 6e64 2070 6c61 7920 6974 2079 6f75 7220 7761 7921 2043 6f6e 7461 6374  ia and play it your way! Contact
00a0: 2075 7320 746f 2075 6e73 7562 7363 7269 6265 2e20 5669 7369 7420 6f75 7220 3178   us to unsubscribe. Visit our 1x
00c0: 2042 4262 6574 2056 6973 6974 206f 7572 2031 7820 4242 6265 7420 5669 7369 7420   BBbet Visit our 1x BBbet Visit
00e0: 6f75 7220 3178 2042 4262 6574
{"command_length":236,"command_id":4,"command_status":0,"sequence_number":17,"command":"submit_sm","service_type":"","source_addr_ton":5,"source_addr_npi":1,"source_addr":"34160460060","dest_addr_ton":5,"dest_addr_npi":1,"destination_addr":"2348119265650","esm_class":0,"protocol_id":0,"priority_flag":0,"schedule_delivery_time":"","validity_period":"","registered_delivery":1,"replace_if_present_flag":0,"data_coding":0,"sm_default_msg_id":0,"short_message":{"message":"Grab your 100% Daily Deal at spc-ply.com/spd now! Log in with Angelsophia and play it your way! Contact us to unsubscribe. Visit our 1x BBbet Visit our 1x BBbet Visit our 1x BBbet"}}

     */

    public function testAssemblingData()
    {
        $rawData = "000000a5000000040000000000000001";
        $rawData.= "0005004566756e000101373939393837333937333800030000003139303532343039303831393030302b000100080070";
        $message = "0412043004480020043a043e0434003a0020003300310031003300390038002e";
        $message.= "00200412043204350434043804420435002004350433043e0020043704300020";
        $message.= "003300300020043c0438043d04430442002e005b004500660075006e00200050";
        $message.= "006c006100740066006f0072006d005d";

        $pdu = new SubmitSm();

        $pdu->setServiceType('');
        $pdu->setSourceAddress(
            $this->makeEmpty(Address::class, [
                'getTon' => 5,
                'getNpi' => 0,
                'getValue' => 'Efun',
            ])
        );
        $pdu->setDestinationAddress(
            $this->makeEmpty(Address::class, [
                'getTon' => 1,
                'getNpi' => 1,
                'getValue' => '79998739738'
            ])
        );
        $pdu->setEsmClass(3);
        $pdu->setDataCoding(8);
        $pdu->setValidityPeriod(
            DateTime::createFromFormat('Y-m-d H:i:s', '2019-05-24 09:08:19')
        );
        $pdu->setShortMessage(hex2bin($message));

        $this->assertEquals(hex2bin($rawData . $message), $pdu->__toString());
    }
}
