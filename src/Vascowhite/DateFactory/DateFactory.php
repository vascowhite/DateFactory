<?php
/*
    Copyright (C) 2014  Paul White

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * User: Paul White
 * Date: 01/12/2014
 * 
 * File: DateFactory.php
 * @package datefactory
 */
 
 /**
  * @package 
  */

namespace Vascowhite\DateFactory;

class DateFactory
{
    /** @const String DateTime format */
    const FORMAT = 'Y-m-d H:i:s';

    /**
     * @param null || String $date A valid date string in the format Y-m-d H:i:s
     * @param null || String $timezone A valid TimeZone string from this list http://php.net/manual/en/timezones.php
     * @throws InvalidArgumentException
     *
     * @return bool || DateTime  Returns a \DateTime object or false if an invalid string is passed.
     */
    public static function getDate($dateString = null, $timezone = null)
    {
        if(!$timezone){
            $tz = new \DateTimeZone(date_default_timezone_get());
        } else {
            if(!self::checkTZStringIsValid($timezone)){
                throw new \InvalidArgumentException('Invalid TimeZone string passed');
            }
            $tz = new \DateTimeZone($timezone);
        }

        if(!$dateString){
            $date = new \DateTime(null, $tz);
        } else {
            $dateString = self::fixTime($dateString);

            list($year, $month, $day) = explode('-', explode(' ', $dateString)[0]);

            if(checkdate((int)$month, (int)$day, (int)$year)){
                $date = \DateTime::createFromFormat(self::FORMAT, $dateString, $tz);
            } else {
                return false;
            }
        }
        return $date;
    }

    /**
     * @param String $TZString
     * @return bool
     */
    private static function checkTZStringIsValid($TZString)
    {
        return in_array($TZString, \DateTimeZone::listIdentifiers());
    }

    /**
     * @param String $dateString
     * @return string
     */
    private static function fixTime($dateString)
    {
        $split = explode(' ', $dateString);
        if(!isset($split[1])){
            return $dateString . ' 00:00:00';
        }
        if(count(explode(':', $split[1])) < 3){
            return $dateString . ':00';
        }
        return $dateString;
    }
}