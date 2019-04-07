<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

trait TimestampUtils
{
    /**
     * Получить количество секунд, прошедших с полуночи 1 января 1970, из даты формата "Y-m-d H:i:s".
     * @param string|null $_sql_time
     * @return int|null
     */
    protected function getUnixTimestampFromYmdHisTime(?string $_sql_time): ?int
    {
        if ($_sql_time === null) {
            return null;
        }
        return \strtotime($_sql_time);
    }

    /**
     * Получить время в формате "Y-m-d H:i:s" из количества секунд, из прошедших с полуночи 1 января 1970.
     *
     * @param int|null $_timestamp
     * @return string|null
     */
    protected function getYmdHisTimeFromUnixTimestamp(?int $_timestamp): ?string
    {
        if ($_timestamp === null) {
            return null;
        }
        return \date('Y-m-d H:i:s', $_timestamp);
    }
}
