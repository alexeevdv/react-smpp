<?php

namespace tests\unit\Proto;

use alexeevdv\React\Smpp\Proto\DateTime;
use Codeception\Test\Unit;

class DateTimeTest extends Unit
{
    public function testParsing()
    {
        $string = '190524090819000+';
        $dateTime = new DateTime($string);
        $this->assertEquals('2019-05-24 09:08:19', $dateTime->format('Y-m-d H:i:s'));
    }

    public function testToString()
    {
        $dateTime = new DateTime('2019-05-24 09:08:19');
        $this->assertEquals('190524090819000+', $dateTime->__toString());
    }
}
