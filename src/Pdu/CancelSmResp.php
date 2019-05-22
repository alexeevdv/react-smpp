<?php

namespace alexeevdv\React\Smpp\Pdu;

class CancelSmResp extends Pdu implements Contract\CancelSmResp
{
    public function getCommandId(): int
    {
        return 0x00000008;
    }
}
