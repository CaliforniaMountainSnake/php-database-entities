<?php

namespace Tests\Unit;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use PHPUnit\Framework\TestCase;
use Tests\Unit\TestEntities\UserEntity;

class BaseEntityTest extends TestCase
{
    /**
     * @covers BaseEntity::fromArray, BaseEntity::toArray
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testFromToArray(): void
    {
        $userEntity = UserEntity::fromArray($this->getUserArray());
        $this->assertEquals(\serialize($this->getUserArray()), \serialize($userEntity->toArray()));
    }

    /**
     * @covers BaseEntity::fromJson, BaseEntity::toJson
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testFromToJson(): void
    {
        $json       = \json_encode($this->getUserArray());
        $userEntity = UserEntity::fromJson($json);
        $this->assertEquals($json, $userEntity->toJson());
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testFromToJsonWithKeys(): void
    {
        $jsonBase     = \json_encode($this->getUserArray());
        $jsonWithKeys = \json_encode(['some_key_1' => [0 => ['some_key_3' => $this->getUserArray()]]]);
        $userEntity   = UserEntity::fromJson($jsonWithKeys, 'some_key_1', 0, 'some_key_3');
        $this->assertEquals($jsonBase, $userEntity->toJson());
    }

    protected function getUserArray(): array
    {
        return [
            'id' => 53,
            'email' => 'some@email.com',
            'name' => 'James Bond',
            'company' => [
                'id' => 12,
                'name' => 'Some Company',
                'address' => 'this is some address',
            ],
        ];
    }
}
