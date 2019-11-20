<?php

namespace Tests\Unit\TestEntities;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\DatabaseEntities\EntityInterface;

class CompanyEntity extends BaseEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * CompanyEntity constructor.
     *
     * @param int         $id
     * @param string      $name
     * @param string      $address
     * @param string|null $description
     */
    public function __construct(int $id, string $name, string $address, ?string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->description = $description;
    }

    /**
     * Create an entity from array.
     *
     * @param array $_arr Associative array.
     *
     * @return self
     */
    public static function fromArray(array $_arr): EntityInterface
    {
        return new static($_arr['id'], $_arr['name'], $_arr['address'], $_arr['description']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
