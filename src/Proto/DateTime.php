<?php

namespace alexeevdv\React\Smpp\Proto;

use DateTimeZone;

class DateTime extends \DateTime
{
    public function __construct($time = 'now', DateTimeZone $timezone = null)
    {
        $dateTime = self::createFromFormat('ymdHis', substr($time, 0, 12));
        if ($dateTime) {
            $time = $dateTime->format('c');
        }
        parent::__construct($time, $timezone);
    }

    public function __toString()
    {
        return $this->format('ymdHis') . '000+';
    }
}
