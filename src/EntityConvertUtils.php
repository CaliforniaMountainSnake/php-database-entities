<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

class EntityConvertUtils
{
    /**
     * Преобразовать массив из сущностей в обычный массив.
     *
     * @param EntityInterface[] $_list
     * @return array
     */
    public function listToArray(array $_list): array
    {
        \array_walk_recursive($_list, static function (&$value) {
            if ($value instanceof EntityInterface) {
                $value = $value->toArray();
            }
        });

        return $_list;
    }

    /**
     * Создать массив сущностей из обычного массива.
     *
     * @param array $_raw_array Multi-dimensional raw array, for example, from database.
     * @param string $_entity_classname
     *
     * @return EntityInterface[]
     */
    public function createEntitiesListFromArray(array $_raw_array, string $_entity_classname): array
    {
        $result = [];
        foreach ($_raw_array as $rawEntity) {
            /** @var EntityInterface $_entity_classname */
            $result[] = $_entity_classname::fromArray($rawEntity);
        }

        return $result;
    }

    /**
     * Создать массив сущностей из json.
     *
     * @param string $_raw_json Multi-dimensional raw json, for example, from database.
     * @param string $_entity_classname
     *
     * @return EntityInterface[]|null
     */
    public function createEntitiesListFromJson(string $_raw_json, string $_entity_classname): ?array
    {
        $array = \json_decode($_raw_json, true);
        if (\json_last_error() === \JSON_ERROR_NONE) {
            return $this->createEntitiesListFromArray($array, $_entity_classname);
        }

        return null;
    }

    /**
     * Собрать массив, используя сущности.
     *
     * @param callable|null $_callback_get_key
     * @param callable $_callback_get_value
     * @param EntityInterface ...$_entities
     * @return array
     */
    public function makeArrayWithEntities(
        ?callable $_callback_get_key,
        callable $_callback_get_value,
        EntityInterface ...$_entities
    ): array {
        $result = [];
        foreach ($_entities as $entity) {
            if ($_callback_get_key === null) {
                $result[] = $_callback_get_value($entity);
            } else {
                $result[$_callback_get_key($entity)] = $_callback_get_value($entity);
            }
        }

        return $result;
    }
}
