<?php

namespace alexeevdv\React\Smpp\Proto\DataCoding;

use alexeevdv\React\Smpp\Proto\Contract\DataCoding;

class Gsm0338 implements DataCoding
{
    public function encode(string $data): string
    {
        //"source_addr_ton":5,"source_addr_npi":0,"source_addr":"Efun",
        //"dest_addr_ton":1,"dest_addr_npi":1,"destination_addr":"79969557595",
        //"esm_class":3,"protocol_id":0,"priority_flag":0,"schedule_delivery_time":"",
        //"validity_period":"2019-05-24T06:21:26.000Z","registered_delivery":1,"replace_if_present_flag":0,
        //"data_coding":8,"sm_default_msg_id":0,"short_message":{"message":"Код: 303193, действителен в течение 30 мин.【Efun Platform】"}}

        //"source_addr_ton":1,"source_addr_npi":1,"source_addr":"79022977831",
        //"dest_addr_ton":1,"dest_addr_npi":1,"destination_addr":"79047253066",
        //"esm_class":0,"protocol_id":0,"priority_flag":0,"schedule_delivery_time":"",
        //"validity_period":"2019-05-25T06:15:09.000Z","registered_delivery":1,"replace_if_present_flag":0,
        //"data_coding":8,"sm_default_msg_id":0,"short_message":{"message":"До 20 000 руб. со скидкой 30%! Промокод: MAY. Торопись!\nlmzm.cc/regk"}}
        // TODO: Implement encode() method.
    }

    public function decode(string $data): string
    {
        // TODO: Implement decode() method.
    }

}
