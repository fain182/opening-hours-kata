<?php

class HourRange
{
    private $fromHour;
    private $toHour;

    public function __construct($fromHour, $toHour)
    {
        $this->fromHour = $fromHour;
        $this->toHour = $toHour;
    }

    public function includes(DateTimeImmutable $date) : bool
    {
        $hour = $date->format('G');
        return $hour >= $this->fromHour && $hour < $this->toHour;
    }

    public function setStartingTimeTo(DateTimeImmutable $date) : \DateTimeImmutable
    {
        return $date->setTime($this->fromHour, 0);
    }
}
