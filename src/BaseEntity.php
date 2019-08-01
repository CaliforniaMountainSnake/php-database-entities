<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

use MyCLabs\Enum\Enum;

/**
 * Базовый класс какой-либо сущности из БД.
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
     * @param string[] $_except [OPTIONAL] Поля, которые необходимо исключить из сгенерированного массива.
     * @return array
     */
    public function toArray(array $_except = []): array
    {
        $this->makeReflectionObject();
        $this->makePropertiesNames();

        $result = [];
        foreach ($this->propertiesNames as $propertyName) {
            if (\in_array($propertyName, $_except, true)) {
                continue;
            }

            $value = $this->{$propertyName};
            if ($value instanceof EntityInterface) {
                $result[$propertyName] = $value->toArray();
            } elseif (\is_array($value)) {
                $result[$propertyName] = self::entitiesArrayToArray(...$value);
            } elseif ($value instanceof Enum) {
                $result[$propertyName] = (string)$value;
            } else {
                $result[$propertyName] = $value;
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return \json_encode($this->toArray());
    }

    /**
     * @param string $_arr
     * @param string[] $_array_keys
     * @return EntityInterface|null
     */
    public static function fromJson(string $_arr, string ...$_array_keys): ?EntityInterface
    {
        $decodedArr = \json_decode($_arr, true);
        $targetArr  = self::getSubArray($decodedArr, ...$_array_keys);

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
     * Преобразовать массив сущностей в обычный массив.
     * @param EntityInterface[] $_entities
     * @return array
     * @TODO: Возможно, стоит заменить на array_walk_recursive().
     */
    private static function entitiesArrayToArray(EntityInterface ...$_entities): array
    {
        $result = [];
        foreach ($_entities as $entity) {
            $result[] = $entity->toArray();
        }
        return $result;
    }

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
     * @param array $_arr
     * @param string[] $_keys
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
