<?php

namespace CaliforniaMountainSnake\DatabaseEntities\Utils;

/**
 * Interface contains various types of useful date constants.
 *
 * @see https://www.php.net/manual/ru/datetime.format.php
 */
interface DateFormats
{
    public const MYSQL_DATE_FORMAT = 'Y-m-d';
    public const MYSQL_TIME_FORMAT = 'H:i:s';
    public const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    public const MYSQL_TIMESTAMP_FORMAT = 'Y-m-d H:i:s';
    public const MYSQL_YEAR_FORMAT = 'Y';

    public const MYSQL_MIN_DATE_DATE = '1000-01-01';
    public const MYSQL_MAX_DATE_DATE = '9999-12-31';
    public const MYSQL_MIN_DATETIME_DATE = '1000-01-01 00:00:00';
    public const MYSQL_MAX_DATETIME_DATE = '9999-12-31 23:59:59';
    public const MYSQL_MIN_TIMESTAMP_DATE = '1970-01-01 00:00:00';
    public const MYSQL_MAX_TIMESTAMP_DATE = '2038-01-19 03:14:07';
    public const MYSQL_MIN_TIMESTAMP_DATE_INT = 0;
    public const MYSQL_MAX_TIMESTAMP_DATE_INT = 2147483647;

    public const UNIX_TIMESTAMP = 'U';
}
