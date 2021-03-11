<?php

namespace alexeevdv\React\Smpp\Pdu;

class DeliverSmResp extends SubmitSmResp
{
    public function getCommandId(): int
    {
        return 0x80000005;
    }
}
