<?php

namespace common\helpers;

use Yii;

/**
 * Хелпер для работы с датами.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class DateHelper
{
    /**
    * Получить объект \DateTimeImmutable текущего времени в заданной таймзоне
    *
    * @param string $timezone Код часового пояса | смещение, если нет - используется текущая таймзона из Yii
    * @return resource \DateTimeImmtable
    */
    public static function current(string $timezone = null): \DateTimeImmutable
    {
        return static::from('now', $timezone);
    }

    /**
    * Получить объект \DateTimeImmutable конкретного переданного времени в заданной таймзоне
    *
    * @param string $timezone Код часового пояса | смещение, если нет - используется текущая таймзона из Yii
    * @return resource \DateTimeImmutable
    */
    public static function from(string $time, string $timezone = null): \DateTimeImmutable
    {
        return new \DateTimeImmutable($time, new \DateTimeZone($timezone ?? Yii::$app->timezone));
    }
}
