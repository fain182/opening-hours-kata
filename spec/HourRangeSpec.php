<?php

namespace spec;

use HourRange;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HourRangeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(8, 14);
        $this->shouldHaveType(HourRange::class);
    }

    function it_includes_some_hours()
    {
        $this->beConstructedWith(8, 14);
        $this->includes((new \DateTimeImmutable())->setTime(11, 0))->shouldReturn(true);
        $this->includes((new \DateTimeImmutable())->setTime(7, 0))->shouldReturn(false);
        $this->includes((new \DateTimeImmutable())->setTime(18, 0))->shouldReturn(false);
    }
}
