<?php

class DayRange
{
    private $daysOfTheWeek;

    public function __construct(array $daysOfTheWeek = [])
    {
        $this->daysOfTheWeek = $daysOfTheWeek;
    }

    public function includes(\DateTimeImmutable $date) : bool
    {
        $dayOfTheWeek = $date->format('N');
        return in_array($dayOfTheWeek, $this->daysOfTheWeek);
    }

    public function getNextOpeningDay(\DateTimeImmutable $date)
    {
        for ($i = 0; $i < 7; $i++) {
            $nextDate = $date->add(new \DateInterval('P'.$i.'D'));
            if ($this->includes($nextDate)) {
                return $nextDate;
            }
        }

        return false;
    }
}
