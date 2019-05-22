<?php

namespace alexeevdv\React\Smpp\Pdu;

class DeliverSmResp extends Pdu implements \alexeevdv\React\Smpp\Pdu\Contract\DeliverSmResp
{
    public function getCommandId(): int
    {
        return 0x80000005;
    }
}
