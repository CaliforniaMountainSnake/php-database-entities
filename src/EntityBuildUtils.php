<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

/**
 * Вспомогательный трейт для создания объектов сущностей из сырого массива, полученного из БД.
 */
trait EntityBuildUtils
{
    /**
     * Создать сущности для переданных отношений.
     *
     * @param array $_relations Массив отношений вида:
     * ['название метода-ссылки в моделе SomeEloquentModel' => 'EntityInterface::class'].
     * Если значение отношения является массивом (содержащим единственный элемент с именем класса сущности),
     * то это индикатор того, что данное отношение содержит массив сущностей, а не единичную сущность.
     *
     * @param array $_raw_data_array Сырой массив данных из запроса из БД, который может содержать переданные сущности.
     *
     * @return EntityInterface[]|null[]
     */
    protected static function makeRelatedEntitiesFromArray(array $_relations, array $_raw_data_array): array
    {
        $resultEntitiesArr = [];
        /**
         * @var  $relationName string
         * @var  $entityClassname EntityInterface
         */
        foreach ($_relations as $relationName => $entityClassname) {
            $relationRawValue = $_raw_data_array[$relationName] ?? null;
            if ($relationRawValue === null) {
                $resultEntitiesArr[] = null;
                continue;
            }

            $resultEntitiesArr[] = self::makeRelationValueFromArray($entityClassname, $relationRawValue);
        }

        return $resultEntitiesArr;
    }

    /**
     * Создать значение отношения из сырого массива. Может быть как сущностью, так и массивом сущностей.
     *
     * @param $_entity_classname
     * @param array $_raw_relation_value
     * @return EntityInterface|EntityInterface[]
     */
    private static function makeRelationValueFromArray($_entity_classname, array $_raw_relation_value)
    {
        if (!\is_array($_entity_classname)) {
            return self::makeEntity($_entity_classname, $_raw_relation_value);
        }

        // Если имя сущности отношения является массивом - это индикатор того,
        // что данное отношение содержит массив сущностей, а не единичную сущность.
        $_entity_classname = $_entity_classname[0];
        $relationEntities  = [];
        foreach ($_raw_relation_value as $entityRawValue) {
            $relationEntities[] = self::makeEntity($_entity_classname, $entityRawValue);
        }
        return $relationEntities;
    }

    /**
     * @param string $_entity_classname
     * @param array $_entity_value
     * @return EntityInterface
     */
    private static function makeEntity(string $_entity_classname, array $_entity_value): EntityInterface
    {
        /** @var $_entity_classname EntityInterface */
        return $_entity_classname::fromArray($_entity_value);
    }
}
