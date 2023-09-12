<?php

class DateHelper
{
    public static function getFirstMondayInYear(int $year): DateTime
    {
        $dt = new DateTime(YEAR . "-01-01 00:00:00");
        $weekday = (int)$dt->format('w');
        $diff2NextMonday = (8 - $weekday) % 7;
        $diffPeriod = 'P' . $diff2NextMonday . 'D';
        $dt->add(new DateInterval($diffPeriod));
        return $dt;
    }
}