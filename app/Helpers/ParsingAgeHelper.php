<?php

namespace App\Helpers;

class ParsingAgeHelper {
    public static function getRelevantPassages($ageString)
    {
        $matches = [];

        preg_match_all('/'.self::getOpenEndPattern().'|'.
            self::getYearsWithValuePattern().'|'.
            self::getMonthsWithValuePattern().'|'.
            self::getWeeksWithValuePattern().'|'.
            self::getHoursWithValuePattern().'/',
            $ageString,
            $matches,
            PREG_PATTERN_ORDER);

        return $matches[0];
    }

    public static function getAgeValue($match)
    {
        $ageValue = (int) preg_replace('/'.self::getOpenEndPattern().'|'.
            self::getYearsPattern().'|'.
            self::getWeeksPattern().'|'.
            self::getMonthsPattern().'|'.
            self::getYearsPattern().'/',
            '',
            $match);

        if (preg_match('/'.self::getMonthsPattern().'/', $match))
        {
            $ageValue = (int) ($ageValue / 12);
        }
        if (preg_match('/'.self::getHoursPattern().'|'.self::getWeeksPattern().'/', $match))
        {
            $ageValue = 0;
        }
        else if (preg_match('/'.self::getOpenEndPattern().'/', $match))
        {
            $ageValue = null;
        }

        return $ageValue;
    }

    public static function setAgeValues($trial, $ages)
    {
        if(count($ages) === 2)
        {
            $trial->min_age = $ages[0];
            $trial->max_age = $ages[1];
        }
        else
        {
            $trial->min_age = null;
            $trial->max_age = null;
        }

        $trial->save();
    }

    private static function getOpenEndPattern() {
        return '(up\sto)|(\solder)';
    }

    private static function getHoursPattern() {
        return '(\sHour)|(\sHours)';
    }

    private static function getWeeksPattern() {
        return '(\sWeek)|(\sWeeks)';
    }

    private static function getMonthsPattern() {
        return '(\sMonth)|(\sMonths)';
    }

    private static function getYearsPattern() {
        return '(\sYear)|(\sYears)';
    }

    private static function getHoursWithValuePattern()
    {
        return '(\d+\sHour)|(\d+\sHours)';
    }

    private static function getWeeksWithValuePattern()
    {
        return '(\d+\sWeek)|(\d+\sWeeks)';
    }

    private static function getMonthsWithValuePattern()
    {
        return '(\d+\sMonth)|(\d+\sMonths)';
    }

    private static function getYearsWithValuePattern()
    {
        return '(\d+\sYear)|(\d+\sYears)';
    }
}
