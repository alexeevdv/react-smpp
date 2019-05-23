<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

use alexeevdv\React\Smpp\Proto\Contract\Address;

interface Bind extends Pdu
{
    public function getSystemType(): string;

    public function getSystemId(): string;

    public function getPassword(): string;

    public function getInterfaceVersion(): int;

    public function getAddress(): Address;
}
