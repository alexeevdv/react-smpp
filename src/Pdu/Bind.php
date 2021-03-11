<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Proto\Address;
use alexeevdv\React\Smpp\Utils\DataWrapper;

abstract class Bind extends Pdu
{
    /**
     * @var string
     */
    private $systemType;

    /**
     * @var string
     */
    private $systemId;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $interfaceVersion;

    /**
     * @var Address
     */
    private $address;

    public function __construct($body = '')
    {
        parent::__construct($body);
        if (strlen($body) === 0) {
            return;
        }

        $wrapper = new DataWrapper($body);
        $this->setSystemId(
            $wrapper->readNullTerminatedString(16)
        );
        $this->setPassword(
            $wrapper->readNullTerminatedString(9)
        );
        $this->setSystemType(
            $wrapper->readNullTerminatedString(13)
        );
        $this->setInterfaceVersion(
            $wrapper->readInt8()
        );
        $this->setAddress(
            $wrapper->readAddress(41)
        );
    }

    public function getSystemType(): string
    {
        return (string) $this->systemType;
    }

    public function setSystemType(string $systemType): self
    {
        $this->systemType = $systemType;
        return $this;
    }

    public function getSystemId(): string
    {
        return (string) $this->systemId;
    }

    public function setSystemId(string $systemId): self
    {
        $this->systemId = $systemId;
        return $this;
    }

    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getInterfaceVersion(): int
    {
        return (int) $this->interfaceVersion;
    }

    public function setInterfaceVersion(int $interfaceVersion): self
    {
        $this->interfaceVersion = $interfaceVersion;
        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function __toString(): string
    {
        $wrapper = new DataWrapper('');
        $wrapper->writeNullTerminatedString(
            $this->getSystemId()
        )->writeNullTerminatedString(
            $this->getPassword()
        )->writeNullTerminatedString(
            $this->getSystemType()
        )->writeInt8(
            $this->getInterfaceVersion()
        )->writeAddress(
            $this->getAddress()
        );
        $this->setBody($wrapper->__toString());
        return parent::__toString();
    }
}
