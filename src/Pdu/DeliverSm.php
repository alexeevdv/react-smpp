<?php

namespace alexeevdv\React\Smpp\Pdu;

class DeliverSm extends SubmitSm
{
    public function getCommandId(): int
    {
        return 0x00000005;
    }
}
