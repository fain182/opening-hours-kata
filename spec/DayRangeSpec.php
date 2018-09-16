<?php

namespace spec;

use DayRange;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DayRangeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DayRange::class);
    }

    function it_includes_some_days()
    {
        $this->beConstructedWith([\Days::MONDAY, \Days::WEDNESDAY, \Days::FRIDAY]);
        $wednesday = '2016-05-11T12:22:11.824Z';
        $thursday  = '2016-05-12T12:22:11.824Z';
        $this->includes(new \DateTimeImmutable($wednesday))->shouldReturn(true);
        $this->includes(new \DateTimeImmutable($thursday))->shouldReturn(false);
    }

    function it_set_the_next_opening_day_to_false_if_range_is_empty()
    {
        $this->beConstructedWith([]);
        $this->getNextOpeningDay(new \DateTimeImmutable())->shouldReturn(false);
    }

    function it_sets_the_next_opening_day_in_the_same_week()
    {
        $this->beConstructedWith([\Days::MONDAY, \Days::WEDNESDAY, \Days::FRIDAY]);
        $thursday = '2016-05-12T12:22:11.824Z';
        $this->getNextOpeningDay(new \DateTimeImmutable($thursday))->format('N')->shouldReturn('5');
    }

    function it_sets_the_next_opening_day_even_after_weekend()
    {
        $this->beConstructedWith([\Days::MONDAY, \Days::WEDNESDAY]);
        $thursday = '2016-05-12T12:22:11.824Z';
        $this->getNextOpeningDay(new \DateTimeImmutable($thursday))->format('N')->shouldReturn('1');
    }

}
