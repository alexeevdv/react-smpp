<?php

declare(strict_types=1);

namespace alexeevdv\React\Smpp\Proto\Address;

/**
 * Type of number
 */
class Ton
{
    private const TON_UNKNOWN = 0b00000000;
    private const TON_INTERNATIONAL = 0b00000001;
    private const TON_NATIONAL = 0b00000010;
    private const TON_NETWORK_SPECIFIC = 0b00000011;
    private const TON_SUBSCRIBER_NUMBER = 0b00000100;
    private const TON_ALPHANUMERIC = 0b00000101;
    private const TON_ABBREVIATED = 0b00000110;

    private static $allowedValues = [
        self::TON_UNKNOWN,
        self::TON_INTERNATIONAL,
        self::TON_NATIONAL,
        self::TON_NETWORK_SPECIFIC,
        self::TON_SUBSCRIBER_NUMBER,
        self::TON_ALPHANUMERIC,
        self::TON_ABBREVIATED,
    ];

    /**
     * @var int
     */
    private $value;

    public static function unknown(): self
    {
        return new self(self::TON_UNKNOWN);
    }

    public static function international(): self
    {
        return new self(self::TON_INTERNATIONAL);
    }

    public static function national(): self
    {
        return new self(self::TON_NATIONAL);
    }

    public static function networkSpecific(): self
    {
        return new self(self::TON_NETWORK_SPECIFIC);
    }

    public static function subscriberNumber(): self
    {
        return new self(self::TON_SUBSCRIBER_NUMBER);
    }

    public static function alphanumeric(): self
    {
        return new self(self::TON_ALPHANUMERIC);
    }

    public static function abbreviated(): self
    {
        return new self(self::TON_ABBREVIATED);
    }

    public function __construct(int $value)
    {
        if (!in_array($value, self::$allowedValues)) {
            throw new \InvalidArgumentException('Unsupported TON value: ' . $value);
        }
        $this->value = $value;
    }

    public function toInteger(): int
    {
        return $this->value;
    }
}
