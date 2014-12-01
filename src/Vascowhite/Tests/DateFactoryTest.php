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
    public function testCanGetDateWithNullParameters()
    {
        $testDate = DateFactory::getDate();
        $this->assertInstanceOf('\DateTime', $testDate);
    }

    public function testCanGetDateWithNoTimeZone()
    {
        $testDate = DateFactory::getDate('2014-12-25 12:00:00');
        $this->assertInstanceOf('\DateTime', $testDate);
    }

    public function testCanGetDateWithValidTimeZone()
    {
        $testDate = DateFactory::getDate('2014-12-25 12:00:00', 'Europe/London');
        $this->assertInstanceOf('\DateTime', $testDate);
    }

    public function testCanGetDateWithIncompleteTime()
    {
        $testDate = DateFactory::getDate('2014-12-25', 'Europe/London');
        $this->assertInstanceOf('\DateTime', $testDate);

        $testDate = DateFactory::getDate('2014-12-25 12:00', 'Europe/London');
        $this->assertInstanceOf('\DateTime', $testDate);
    }
    
    public function testWillReturnFalseForInvalidDateString()
    {
        $this->assertFalse(DateFactory::getDate('2014-13-25'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid TimeZone string passed
     */
    public function testWillThrowExceptionsForInvalidTimeZoneString()
    {
        $testDate = DateFactory::getDate(null, 'invalidtimezonestring');
    }
}
 