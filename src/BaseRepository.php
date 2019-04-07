<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

/**
 * Базовый класс репозитория, содержащего методы, реализующие низкоуровневую логику работы с БД, и оперирующие сущностями.
 */
abstract class BaseRepository
{
    use TimestampUtils;

    /**
     * @var EntityConvertUtils
     */
    protected $convertUtils;

    public function __construct(EntityConvertUtils $convertUtils)
    {
        $this->convertUtils = $convertUtils;
    }

    /**
     * @return EntityConvertUtils
     */
    public function getConvertUtils(): EntityConvertUtils
    {
        return $this->convertUtils;
    }
}
