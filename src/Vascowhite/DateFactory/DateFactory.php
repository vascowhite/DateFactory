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
  * @package datefactory
  */

namespace Vascowhite\DateFactory;

class DateFactory
{
    /**
     * @param String $dateString A dateString string
     * @param String $format A format understood by \DateTime::createFromFormat()
     * @param null || String $timezone A valid TimeZone string from this list http://php.net/manual/en/timezones.php
     * @throws InvalidArgumentException
     *
     * @return bool || DateTime  Returns a \DateTime object or false on failure.
     */
    public static function getDate($dateString, $format, $timezone = null)
    {
        if(!$timezone){
            $tz = new \DateTimeZone(date_default_timezone_get());
        } else {
            if(!self::checkTZStringIsValid($timezone)){
                throw new \InvalidArgumentException('Invalid TimeZone string passed');
            }
            $tz = new \DateTimeZone($timezone);
        }

        if($format && self::validateDate($dateString, $format)){
            return \DateTime::createFromFormat($format, $dateString, $tz);
        }
        return false;
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
     * Checks that the date string supplied is compatible with the format.
     *
     * Thanks to Glavik for this comment
     * http://php.net/manual/en/function.checkdate.php#113205
     *
     * @param string $dateString
     * @param string $format
     * @return bool
     */
    private static function validateDate($dateString, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $dateString);
        return $d && $d->format($format) == $dateString;
    }
}