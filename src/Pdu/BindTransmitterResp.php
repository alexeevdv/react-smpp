<?php

namespace alexeevdv\React\Smpp\Pdu;

class BindTransmitterResp extends Pdu implements Contract\BindTransmitterResp
{
    public function getCommandId(): int
    {
        return 0x80000002;
    }
}
