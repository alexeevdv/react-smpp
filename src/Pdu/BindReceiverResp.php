<?php

namespace alexeevdv\React\Smpp\Pdu;

class BindReceiverResp extends BindResp implements Contract\BindReceiverResp
{
    public function getCommandId(): int
    {
        return 0x80000001;
    }
}
