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
 * File: DateFactoryTest.php
 * @package datefactory
 */
 
 /**
  * @package 
  */

namespace Vascowhite\DateFactory\Tests;
use Vascowhite\DateFactory\DateFactory;

class DateFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $format = 'Y-m-d H:i:s';

    public function testCanGetDateWithNoTimeZone()
    {
        $testDate = DateFactory::getDate('2014-12-25 12:00:00', $this->format);
        $this->assertInstanceOf(
            '\DateTime',
            $testDate
        );
    }

    public function testCanGetDateWithValidTimeZone()
    {
        $testDate = DateFactory::getDate('2014-12-25 12:00:00', $this->format, 'Europe/London');
        $this->assertInstanceOf(
            '\DateTime',
            $testDate
        );
    }

    public function testWillReturnFalseForInvalidDateString()
    {
        $this->assertFalse(
            DateFactory::getDate('2014-13-25', $this->format),
            "Invalid date string did not return false"
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid TimeZone string passed
     */
    public function testWillThrowExceptionsForInvalidTimeZoneString()
    {
        DateFactory::getDate('2014-12-25 12:00:00', $this->format, 'invalidtimezonestring');
    }

    public function testNonsenseDateReturnsFalse()
    {
        $this->assertFalse(
            DateFactory::getDate('9999-99-99 12:00:00', $this->format),
            "Nonsense date did not return false"
        );
    }

    public function testInvalidFormatStringReturnsFalse()
    {
        $this->assertFalse(
            DateFactory::getDate('2014-12-25 12:00:00', 'invalid format'),
            "Invalid format string did not return false"
        );
    }
}