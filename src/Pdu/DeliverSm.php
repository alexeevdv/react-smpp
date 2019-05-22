<?php

namespace alexeevdv\React\Smpp\Pdu;

class DeliverSm extends Pdu implements Contract\DeliverSm
{
    public function getCommandId(): int
    {
        return 0x00000005;
    }
}
