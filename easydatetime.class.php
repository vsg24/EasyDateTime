<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * EasyDateTime class.
 *
 * Provides high level abstractions for jDateTimePlus class.
 *
 * Copyright (c) 2016 Vahid Amiri Motlagh <vahid.a1996@gmail.com>
 * http://atvsg.com
 *
 * The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * 1- The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * 2- THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 * List of supported timezones can be found here:
 * http://www.php.net/manual/en/timezones.php
 *
 *
 * @package    EasyDateTime
 * @author     Vahid Amiri Motlagh <vahid.a1996@gmail.com>
 * @copyright  2016 Vahid Amiri Motlagh
 * @license    http://opensource.org/licenses/mit-license.php The MIT License
 * @link       https://github.com/vsg24/EasyDateTime
 * @see        DateTime
 * @version    1.0.0
 */
class EasyDateTime
{
    public $timezone; // any php standard timezone
    public $mode; // 'jalali' or 'gregorian'
    public $jDatetimePlus; // an instance of jDateTimePlus

    public function __construct($timezone, $mode)
    {
        $this->timezone = $timezone;
        $this->mode = $mode;
        if($mode == 'jalali')
        {
            $this->jDatetimePlus = new jDateTimePlus(false, true, $timezone);
        }
        else
        {
            $this->jDatetimePlus = new jDateTimePlus(false, false, $timezone);
        }
    }

    /**
     * Formats and returns given timestamp just like php's
     * built in date() function.
     *
     * @param string $format
     * @param string|bool $timestamp
     * @return string
     */
    public function date($format = 'Y-m-d H:i:s', $timestamp = false)
    {
        if($this->mode == 'jalali')
        {
            return $this->jDatetimePlus->date($format, $timestamp, false, true, $this->timezone);
        }
        else
        {
            return $this->jDatetimePlus->date($format, $timestamp, false, false, $this->timezone);
        }
    }

    /**
     * Converts a given Gregorian date string to the equivalent Jalali date string.
     *
     * @param string $jalaliFormat
     * @param string $gregorianFormat
     * @param string $datetimeString
     * @return \Exception|string
     */
    public function gregorianStringToJalaliString($datetimeString, $gregorianFormat, $jalaliFormat)
    {
        if($this->mode == 'jalali')
        {
            return $this->jDatetimePlus->convertFormatToFormat($jalaliFormat, $gregorianFormat, $datetimeString,
                $this->timezone, false);
        }
        return new \Exception("self::mode should be 'jalali' for gregorianStringToJalaliString() method to work
        properly.");
    }

    /**
     * Converts a given Jalali DateTime string to a formatted Gregorian DateTime
     * Supported formats for Jalali input include:
     *
     * 1395-04-16 19:25:15
     * 1395/04/16 19:25:15
     * 1395-04-16 19:25
     * 1395/04/16 19:25
     * 1395-04-16
     * 1395/04/16
     *
     * @param string $datetimeString
     * @param string $gregorianFormat
     * @return string
     */
    public function jalaliStringToGregorianString($datetimeString, $gregorianFormat = 'Y-m-d H:i:s')
    {
        $datetime_sep = explode(' ', $datetimeString);
        $date_sep1 = explode('-', $datetime_sep[0]);
        $date_sep2 = explode('/', $datetime_sep[0]);

        $datetimeInfo = [];

        if(count($datetime_sep) === 2)
        {
            // contains time
            $time = $datetime_sep[1];
            $time_sep = explode(':', $time);

            if(count($time_sep) === 2) {
                // does not contain seconds
                $datetimeInfo['hour'] = $time_sep[0];
                $datetimeInfo['minute'] = $time_sep[1];
                $datetimeInfo['second'] = 0;
            } elseif(count($time_sep) === 3) {
                // contains seconds
                $datetimeInfo['hour'] = $time_sep[0];
                $datetimeInfo['minute'] = $time_sep[1];
                $datetimeInfo['second'] = $time_sep[2];
            }
        } else {
            $datetimeInfo['hour'] = 0;
            $datetimeInfo['minute'] = 0;
            $datetimeInfo['second'] = 0;
        }
        
        if(count($date_sep1) === 3 || count($date_sep2) == 3)
        {
            // supported
            $datetimeInfo['year'] = (isset($date_sep1[0]) && count($date_sep1[0]) === 4) ? $date_sep1[0] : $date_sep2[0];
            $datetimeInfo['month'] = isset($date_sep1[1]) ? $date_sep1[1] : $date_sep2[1];
            $datetimeInfo['day'] = isset($date_sep1[2]) ? $date_sep1[2] : $date_sep2[2];
        }

        $timestamp = $this->jDatetimePlus->mktime($datetimeInfo['hour'], $datetimeInfo['minute'],
            $datetimeInfo['second'], $datetimeInfo['month'], $datetimeInfo['day'], $datetimeInfo['year'], true);

        return $this->jDatetimePlus->gDate($gregorianFormat, $timestamp);
    }

    /**
     * Converts a DateTime string from the given format and timezone to the field timezone and passed format
     *
     * @param $gregorianInputDateTime
     * @param $inputTimezone
     * @param $outputTimezone
     * @param string $outputFormat
     * @return string
     */
    public function convertTimeZone($gregorianInputDateTime, $inputTimezone, $outputTimezone, $outputFormat = 'Y-m-d H:i:s')
    {
        $original_timezone = new DateTimeZone($inputTimezone);
        // Instantiate the DateTime object, setting it's date, time and time zone.
        $datetime = new DateTime($gregorianInputDateTime, $original_timezone);

        // Set the DateTime object's time zone to convert the time appropriately.
        $target_timezone = new DateTimeZone($outputTimezone);
        $datetime->setTimezone($target_timezone);

        // Outputs a date/time string based on the time zone you've set on the object.
        $output = $datetime->format($outputFormat);

        return $output;
    }

    /**
     * Converts numbers in a given string from English to Persian and vice versa
     *
     * @param $string
     * @return string
     */
    public function convertNumbers($string)
    {
        return $this->jDatetimePlus->convertNumbers($string, $this->mode == 'jalali' ? 'fa' : 'en');
    }
}