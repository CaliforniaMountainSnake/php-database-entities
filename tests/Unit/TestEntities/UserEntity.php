<?php

namespace Tests\Unit\TestEntities;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\DatabaseEntities\EntityBuildUtils;
use CaliforniaMountainSnake\DatabaseEntities\EntityInterface;

class UserEntity extends BaseEntity
{
    use EntityBuildUtils;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var CompanyEntity|null
     */
    protected $company;

    /**
     * UserEntity constructor.
     * @param int $id
     * @param string $email
     * @param string $name
     * @param CompanyEntity|null $company
     */
    public function __construct(int $id, string $email, string $name, ?CompanyEntity $company)
    {
        $this->id      = $id;
        $this->email   = $email;
        $this->name    = $name;
        $this->company = $company;
    }

    /**
     * Create an entity from array.
     * @param array $_arr Associative array.
     *
     * @return self
     */
    public static function fromArray(array $_arr): EntityInterface
    {
        // Make Relations Entities
        $relatedEntities = self::makeRelatedEntitiesFromArray([
            'company' => CompanyEntity::class,
        ], $_arr);

        return new static ($_arr['id'], $_arr['email'], $_arr['name'], ...$relatedEntities);
    }
}
