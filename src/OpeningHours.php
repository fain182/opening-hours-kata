<?php

class OpeningHours
{
    private $hourRange;
    private $dayRange;

    public function __construct(DayRange $dayRange, HourRange $hourRange)
    {
        $this->dayRange = $dayRange;
        $this->hourRange = $hourRange;
    }

    public function isOpenOn(\DateTimeImmutable $date): bool
    {
        return $this->dayRange->includes($date) && $this->hourRange->includes($date);
    }

    public function nextOpeningDate(\DateTimeImmutable $date)
    {
        if ($this->isOpenOn($date)) {
            return $date;
        }

        $date = $this->dayRange->getNextOpeningDay($date);
        return $this->hourRange->setStartingTimeTo($date);
    }
}
