<?php

namespace alexeevdv\React\Smpp\Proto;

class Address implements Contract\Address
{
    /**
     * @var int
     */
    private $ton;

    /**
     * @var int
     */
    private $npi;

    /**
     * @var string
     */
    private $value;

    public function __construct(int $ton, int $npi, string $value)
    {
        $this->ton = $ton;
        $this->npi = $npi;
        $this->value = $value;
    }

    public function getTon(): int
    {
        return $this->ton;
    }

    public function getNpi(): int
    {
        return $this->npi;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
