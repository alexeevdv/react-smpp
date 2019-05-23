<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface SubmitSmResp extends Pdu
{
    public function getMessageId(): string;
}
