<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

/**
 * Интерфейс какой-либо сущности данных из БД.
 */
interface EntityInterface
{
    /**
     * Create an entity from array.
     * @param array $_arr Associative array.
     *
     * @return EntityInterface
     */
    public static function fromArray(array $_arr): EntityInterface;

    /**
     * Create an entity from array.
     * @param string $_arr
     * @param string[] $_array_keys The keys of sub array, from which we need to extract the entity.
     * @return EntityInterface|null
     */
    public static function fromJson(string $_arr, string ...$_array_keys): ?EntityInterface;

    /**
     * Convert an entity to array.
     * @return array
     */
    public function toArray(): array;

    /**
     * Convert an entity to json.
     * @return string
     */
    public function toJson(): string;
}
