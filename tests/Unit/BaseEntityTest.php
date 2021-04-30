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
        $json = json_encode($this->getUserArray());
        $userEntity = UserEntity::fromJson($json);
        $this->assertEquals($json, $userEntity->toJson());
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testFromToJsonWithKeys(): void
    {
        $jsonBase = json_encode($this->getUserArray());
        $jsonWithKeys = json_encode(['some_key_1' => [0 => ['some_key_3' => $this->getUserArray()]]]);
        $userEntity = UserEntity::fromJson($jsonWithKeys, 'some_key_1', 0, 'some_key_3');
        $this->assertEquals($jsonBase, $userEntity->toJson());
    }

    /**
     * @return array
     */
    protected function getUserArray(): array
    {
        return [
            'id' => 53,
            'email' => 'some@email.com',
            'name' => 'James Bond',
            'second_name' => null,
            'company' => [
                'id' => 12,
                'name' => 'Some Company',
                'address' => 'this is some address',
                'description' => null,
                'foundation_date' => '2021-01-07 13:53:51',
            ],
        ];
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testExcludeNull(): void
    {
        $user = UserEntity::fromArray($this->getUserArray());
        $userArr = $user->toArray([], false);
        $userArrWithoutNullValues = $user->toArray([], true);

        $this->assertArrayHasKey('second_name', $userArr);
        self::assertNull($userArr['second_name']);
        $this->assertArrayHasKey('description', $userArr['company']);
        self::assertNull($userArr['company']['description']);

        $this->assertArrayNotHasKey('second_name', $userArrWithoutNullValues);
        $this->assertArrayNotHasKey('description', $userArrWithoutNullValues['company']);
    }
}
