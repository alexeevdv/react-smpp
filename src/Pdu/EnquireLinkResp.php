<?php

namespace alexeevdv\React\Smpp\Pdu;

class EnquireLinkResp extends Pdu implements Contract\EnquireLinkResp
{
    public function getCommandId(): int
    {
        return 0x80000015;
    }
}
