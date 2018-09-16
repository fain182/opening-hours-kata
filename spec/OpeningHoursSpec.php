<?php

namespace spec;

use OpeningHours;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OpeningHoursSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new \DayRange(), new \HourRange(0, 0));
        $this->shouldHaveType(OpeningHours::class);
    }

    function it_is_closed_by_default()
    {
        $this->beConstructedWith(new \DayRange(), new \HourRange(0, 0));
        $this->isOpenOn(new \DateTimeImmutable())->shouldReturn(false);
    }

    function it_can_be_open_some_days_only()
    {
        $this->beConstructedWith(new \DayRange([\Days::MONDAY, \Days::WEDNESDAY, \Days::FRIDAY]), new \HourRange(9, 22));
        $wednesday = '2016-05-11T12:22:11.824Z';
        $thursday  = '2016-05-12T12:22:11.824Z';
        $this->isOpenOn(new \DateTimeImmutable($wednesday))->shouldReturn(true);
        $this->isOpenOn(new \DateTimeImmutable($thursday))->shouldReturn(false);
    }

    function it_is_open_on_some_hours_only()
    {
        $this->beConstructedWith(new \DayRange([\Days::MONDAY, \Days::WEDNESDAY, \Days::FRIDAY]), new \HourRange(8, 16));
        $nineAm  = '2016-05-11T09:22:11.824Z';
        $sevenPm = '2016-05-11T19:22:11.824Z';
        $this->isOpenOn(new \DateTimeImmutable($nineAm))->shouldReturn(true);
        $this->isOpenOn(new \DateTimeImmutable($sevenPm))->shouldReturn(false);
    }

    function it_display_the_date_of_the_next_opening()
    {
        $this->beConstructedWith(new \DayRange([\Days::MONDAY, \Days::FRIDAY]), new \HourRange(8, 16));
        $wednesday = new \DateTimeImmutable('2016-05-11T12:22:11.824Z');
        $fridayMorning = new \DateTimeImmutable('2016-05-13T08:00:00.000Z');
        $this->nextOpeningDate($wednesday)->shouldBeLike($fridayMorning);
    }

    function it_display_the_date_of_the_next_opening_in_the_same_day()
    {
        $this->beConstructedWith(new \DayRange([\Days::WEDNESDAY]), new \HourRange(8, 16));
        $wednesday = new \DateTimeImmutable('2016-05-11T07:22:11.824Z');
        $wednesdayOpeningTime = new \DateTimeImmutable('2016-05-11T08:00:00.000Z');
        $this->nextOpeningDate($wednesday)->shouldBeLike($wednesdayOpeningTime);
    }

}
