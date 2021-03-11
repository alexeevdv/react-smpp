<?php

namespace alexeevdv\React\Smpp\Pdu;

class EnquireLinkResp extends Pdu
{
    public function getCommandId(): int
    {
        return 0x80000015;
    }
}
