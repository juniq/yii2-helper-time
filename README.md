# yii2-helper-time

## Description
A useful helper function for time calculations - especially for durations - for Yii Framework 2. You can use the function `Time::formatDuration` to convert seconds into human readable duration strings like: 5 days 8 hours 19 minutes 11 seconds

## How to install

### Composer
The easiest way to install this package is to use composer. If you don't have composer get it here:

[https://getcomposer.org/download/](https://getcomposer.org/download/)

Now you can run the following commands in your *root project directory*:

```
composer require "juniq/yii2-helper-time" "*"
```

or (depending on your installation type)

```
php composer.phar require "juniq/yii2-helper-time" "*"
```

### Manually download

Download the latest version here:

[https://github.com/juniq/yii2-helper-time/](https://github.com/juniq/yii2-helper-time/)

## How to use it

To convert seconds into human readable duration strings, you can use the following function:

```
Time::formatDuration($time, $length = 'short', $custom_units = false, $separator = ', ')
```

Parameter      | Type           | Required? | Description                                  |
---------------|----------------|-----------|----------------------------------------------|
$time          | Integer        | yes       | The time in seconds you want to format.      |
$length        | String         | optional  | The display lenghts. Use "short" or "long".  |
$custom_units  | Array/Boolean  | optional  | Time units to display. Pass "false" to use all time units. Possible values: y, m, w, d, h, i, s. |
$separator     | String         | optional  | The separator sign between time units.       |

## Examples

~~~
use juniq\helper\Time;

$time_in_seconds = 5781; // 1 hour 36 minutes, 21 seconds

echo Time::formatDuration($time_in_seconds);
// ouput: 1 hour 36 minutes, 21 seconds

echo Time::formatDuration($time_in_seconds, 'long', ['h','i','s'], 'long');
// ouput: 1 hour 36 minutes 21 seconds

echo Time::formatDuration($time_in_seconds, 'short', ['h','i','s'], ',');
// output: 36 minutes, 21 seconds

echo Time::formatDuration($time_in_seconds, 'short',  ['i','s'], ',');
// output: 96 m, 21 s

~~~

## License

Look at 'LICENSE.md' file

## About & Copyright

Copyright by JUNIQ GmbH & Co. KG. Author: Richard Jung
