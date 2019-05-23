<?php

namespace alexeevdv\React\Smpp\Pdu;

class BindReceiver extends Bind implements Contract\BindReceiver
{
    public function getCommandId(): int
    {
        return 0x00000001;
    }
}
