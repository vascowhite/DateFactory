#DateFactory
A factory for `\DateTime` objects with checks that the date string supplied matches the format supplied.

##Installation
Install using composer, add the following to composer.json:-

```json
"require": {
    "vascowhite/datefactory": "dev-master"
}
```

##Why
Because `\DateTime::createFromFormat()` does [stupid things](http://3v4l.org/9qavI) and I needed a way of doing server side validation on user supplied dates.

##DateFactory
There is just one public method:

####DateFactory::getDate()
__Signature:-__
```php
DateTime DateFactory::getDate(String $date, String $format, [String $timeZone])
```

__Arguments__
`$date` is a string representing a date/time, e.g. '2014-14 14:12:10'.
`$format` Format string. Available formats are any available for [`\DateTime::createFromFormat()`](http://php.net/manual/en/datetime.createfromformat.php).
`$timeZone` Optional. A valid Time Zone identifier from [this list](http://php.net/manual/en/timezones.php).

__Example__
```php
$dateTime = DateFactory::getDate('2014-12-25 12:00:00',  'Y-m-d H:i:s', 'Europe/London');
```

__Return__
Returns a `DateTime` object or false on failure.

---