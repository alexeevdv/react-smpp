<?php

namespace alexeevdv\React\Smpp\Proto\Contract;

use alexeevdv\React\Smpp\Proto\Address\Npi;
use alexeevdv\React\Smpp\Proto\Address\Ton;

interface Address
{
    public function getTon(): Ton;

    public function getNpi(): Npi;

    public function getValue(): string;
}
