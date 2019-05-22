<?php

namespace alexeevdv\React\Smpp\Pdu;

class EnquireLink extends Pdu implements Contract\EnquireLink
{
    public function getCommandId(): int
    {
        return 0x00000015;
    }
}
