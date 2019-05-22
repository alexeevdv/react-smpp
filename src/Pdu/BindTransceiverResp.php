<?php

namespace alexeevdv\React\Smpp\Pdu;

class BindTransceiverResp extends Pdu implements Contract\BindTransceiverResp
{
    public function getCommandId(): int
    {
        return 0x80000009;
    }
}
