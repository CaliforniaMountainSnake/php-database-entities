<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

use MyCLabs\Enum\Enum;

/**
 * Class represents some entity from the database.
 */
abstract class BaseEntity implements EntityInterface
{
    use TimestampUtils;

    /**
     * @var \ReflectionClass
     */
    private $reflection;

    /**
     * @var array
     */
    private $propertiesNames;

    /**
     * Convert the entity to array.
     *
     * @param string[] $_except_keys     [OPTIONAL] The keys that will be excluded from the generated array.
     * @param bool     $_is_exclude_null [OPTIONAL] Exclude null values?
     *
     * @return array
     */
    public function toArray(array $_except_keys = [], bool $_is_exclude_null = false): array
    {
        $this->makeReflectionObject();
        $this->makePropertiesNames();

        $result = [];
        foreach ($this->propertiesNames as $propertyName) {
            if (\in_array($propertyName, $_except_keys, true)) {
                continue;
            }

            $value = $this->{$propertyName};
            if ($_is_exclude_null && $value === null) {
                continue;
            }

            if ($value instanceof EntityInterface) {
                $result[$propertyName] = $value->toArray([], $_is_exclude_null);
            } elseif (\is_array($value)) {
                $result[$propertyName] = self::convertArrayOfEntitiesToArray($value, $_is_exclude_null);
            } elseif ($value instanceof Enum) {
                $result[$propertyName] = (string)$value;
            } else {
                $result[$propertyName] = $value;
            }
        }

        return $result;
    }

    /**
     * Convert the entity to json.
     *
     * @return string
     */
    public function toJson(): string
    {
        return \json_encode($this->toArray());
    }

    /**
     * Create an entity from json.
     *
     * @param string   $_arr        JSON with an entity.
     * @param string[] $_array_keys [OPTIONAL] The keys of sub array, from which the entity will be extracted.
     *
     * @return EntityInterface|null
     */
    public static function fromJson(string $_arr, string ...$_array_keys): ?EntityInterface
    {
        $decodedArr = \json_decode($_arr, true);
        $targetArr = self::getSubArray($decodedArr, ...$_array_keys);

        if (\json_last_error() === \JSON_ERROR_NONE) {
            return static::fromArray($targetArr);
        }

        return null;
    }

    /**
     * @return array
     */
    public function __debugInfo()
    {
        return $this->toArray();
    }

    /**
     * Convert array of EntityInterface to the usual array.
     *
     * @param EntityInterface[] $_array_of_entities
     * @param bool              $_is_exclude_null Exclude null values?
     *
     * @return array
     * @TODO: Возможно, стоит заменить на array_walk_recursive().
     */
    private static function convertArrayOfEntitiesToArray(
        array $_array_of_entities,
        bool $_is_exclude_null = false
    ): array {
        $result = [];
        foreach ($_array_of_entities as $entity) {
            $result[] = $entity->toArray([], $_is_exclude_null);
        }
        return $result;
    }

    /**
     * Build Reflection object.
     */
    private function makeReflectionObject(): void
    {
        if ($this->reflection !== null) {
            return;
        }

        try {
            $this->reflection = new \ReflectionClass(static::class);
        } catch (\ReflectionException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Collect all PROTECTED properties from current object.
     */
    private function makePropertiesNames(): void
    {
        if ($this->propertiesNames !== null) {
            return;
        }

        $properties = $this->reflection->getProperties();
        foreach ($properties as $property) {
            if ($property->isProtected() && !$property->isStatic()) {
                $this->propertiesNames[] = $property->getName();
            }
        }
    }

    /**
     * @param array    $_arr
     * @param string[] $_keys
     *
     * @return array
     */
    private static function getSubArray(array $_arr, string ...$_keys): array
    {
        $result = $_arr;
        foreach ($_keys as $key) {
            if (!isset($result[$key])) {
                throw new \RuntimeException('The key "' . $key . '" does not exists in the array!');
            }

            $result = $result[$key];
        }

        return $result;
    }
}
