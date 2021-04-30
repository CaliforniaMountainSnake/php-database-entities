<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

/**
 * Interface represents some entity from the database.
 */
interface EntityInterface
{
    /**
     * Create an entity from array.
     *
     * @param array $_arr Associative array.
     *
     * @return EntityInterface
     */
    public static function fromArray(array $_arr): EntityInterface;

    /**
     * Create an entity from json.
     *
     * @param string   $_arr        JSON with an entity.
     * @param string[] $_array_keys [OPTIONAL] The keys of sub array, from which the entity will be extracted.
     *
     * @return EntityInterface|null
     */
    public static function fromJson(string $_arr, string ...$_array_keys): ?EntityInterface;

    /**
     * Convert the entity to array.
     *
     * @param string[] $_except_keys     [OPTIONAL] The keys that will be excluded from the generated array.
     * @param bool     $_is_exclude_null [OPTIONAL] Exclude null properties?
     *
     * @return array
     */
    public function toArray(array $_except_keys = [], bool $_is_exclude_null = false): array;

    /**
     * Convert the entity to json.
     *
     * @return string
     */
    public function toJson(): string;
}
