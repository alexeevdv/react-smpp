<?php

namespace alexeevdv\React\Smpp\Pdu;

class BindTransceiver extends Pdu implements Contract\BindTransceiver
{
    public function getCommandId(): int
    {
        return 0x00000009;
    }
}
