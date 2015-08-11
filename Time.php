<?php

/**
 * @copyright Copyright &copy; JUNIQ GmbH & Co. KG (http://juniq.agency), 2015
 * @package yii2-helper-time
 * @version 1.0.0
 */

namespace juniq\helper;

use Yii;

/**
 * A useful helper function for time calculations
 *
 * @author Richard Jung <richard@coding.toys>
 * @since 1.0
 */
class Time extends \yii\helpers\Inflector
{

    /**
     * Format a time duration to its time units like hours, minutes, seconds
     *
     * @param integer $time Time in seconds
     * @param string $length The display lenghts. Use "short" or "long".
     * @param array $custom_units Time units to display. Pass "false" to use all time units. Possible values: y, m, w, d, h, i, s.
     * @param string $separator The separator sign between time units.
     *
     * @return string Formatted time with units like hours, minutes, seconds
     *
     * Example(s)
     *
     * ~~~
     * use juniq\helpers\Time;
     *
     * $time_in_seconds = 5781; // 1 hour 36 minutes, 21 seconds
     *
     * echo Time::formatDuration($time_in_seconds);
     * // ouput: 1 hour 36 minutes, 21 seconds
     *
     * echo Time::formatDuration($time_in_seconds, 'long', ['h','i','s'], 'long');
     * // ouput: 1 hour 36 minutes 21 seconds
     *
     * echo Time::formatDuration($time_in_seconds, 'short', ['h','i','s'], ',');
     * // output: 36 minutes, 21 seconds
     *
     * echo Time::formatDuration($time_in_seconds, 'short',  ['i','s'], ',');
     * // output: 96 m, 21 s
     *
     *
     * ~~~
     *
     */
    public static function formatDuration($time, $length = 'short', $custom_units = false, $separator = ', ')
    {
        static::initI18N();

        $possible_time_units = ['y', 'm', 'w', 'd', 'h', 'i', 's'];
        $time_bounds = [7257600, 2419200, 604800, 86400, 3600, 60, 1];
        $units = [];
        $ctime = $time;
        $length_switcher = (trim(strtolower($length)) === 'short')? 0 : 1; // Improves loops performance
        $use_custom_units = false; // Improves loops performance

        if ($custom_units != false && is_array($custom_units)) {

            $use_custom_units = true;
        }

        foreach ($possible_time_units as $index => $unit) {

            if ($use_custom_units) {

                if (!in_array($unit, $custom_units)) {

                    continue;
                }
            }

            $bound = $time_bounds[$index];
            $r = $ctime / $bound;


            if ($r < 1) {

                continue;
            }

            $value = floor($r);
            $ctime -= ($value * $bound);

            if ($length_switcher == 0) {

                $value = Yii::t('juniq-helper-time', '{n, plural, one{1 '.$unit.'} other{# '.$unit.'}}', ['n' => $value]);

            } else {

                $value = Yii::t('juniq-helper-time', '{n, plural, one{1 '.$unit.'s} other{# '.$unit.'s}}', ['n' => $value]);
            }

            $units[$unit] = $value;

        }

        $formatted = implode($separator, $units);

        return $formatted;
    }

    /**
     * Initialize translations
     */
    public static function initI18N()
    {
        if (!empty(Yii::$app->i18n->translations['juniq-helper-time'])) {

            return;
        }

        Yii::setAlias("@juniq-helper-time", __DIR__);
        Yii::$app->i18n->translations['juniq-helper-time'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@juniq-helper-time/messages",
            'forceTranslation' => true
        ];
    }

}
