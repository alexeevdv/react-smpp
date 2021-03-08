<?php

declare(strict_types=1);

namespace alexeevdv\React\Smpp\Proto\Address;

/**
 * Numbering plan indicator
 */
class Npi
{
    private const NPI_UNKNOWN = 0b00000000;
    private const NPI_ISDN = 0b00000001;
    private const NPI_DATA = 0b00000011;
    private const NPI_TELEX = 0b00000100;
    private const NPI_LAND_MOBILE = 0b00000110;
    private const NPI_NATIONAL = 0b00001000;
    private const NPI_PRIVATE = 0b00001001;
    private const NPI_ERMES = 0b00001010;
    private const NPI_INTERNET_IP = 0b00001110;
    private const NPI_WAP_CLIENT_ID = 0b00010010;

    private static $allowedValues = [
        self::NPI_UNKNOWN,
        self::NPI_ISDN,
        self::NPI_DATA,
        self::NPI_TELEX,
        self::NPI_LAND_MOBILE,
        self::NPI_NATIONAL,
        self::NPI_PRIVATE,
        self::NPI_ERMES,
        self::NPI_INTERNET_IP,
        self::NPI_WAP_CLIENT_ID,
    ];

    /**
     * @var int
     */
    private $value;

    public static function unknown(): self
    {
        return new self(self::NPI_UNKNOWN);
    }

    public static function isdn(): self
    {
        return new self(self::NPI_ISDN);
    }

    public static function data(): self
    {
        return new self(self::NPI_DATA);
    }

    public static function telex(): self
    {
        return new self(self::NPI_TELEX);
    }

    public static function landMobile(): self
    {
        return new self(self::NPI_LAND_MOBILE);
    }

    public static function national(): self
    {
        return new self(self::NPI_NATIONAL);
    }

    public static function privateNumberingPlan(): self
    {
        return new self(self::NPI_PRIVATE);
    }

    public static function ermes(): self
    {
        return new self(self::NPI_ERMES);
    }

    public static function internetIp(): self
    {
        return new self(self::NPI_INTERNET_IP);
    }

    public static function wapClientId(): self
    {
        return new self(self::NPI_WAP_CLIENT_ID);
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
