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
     * @var string|null
     */
    protected $second_name;

    /**
     * @var CompanyEntity|null
     */
    protected $company;

    /**
     * UserEntity constructor.
     *
     * @param int                $id
     * @param string             $email
     * @param string             $name
     * @param string|null        $second_name
     * @param CompanyEntity|null $company
     */
    public function __construct(int $id, string $email, string $name, ?string $second_name, ?CompanyEntity $company)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->second_name = $second_name;
        $this->company = $company;
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
        // Make Relations Entities
        /** @var CompanyEntity[]|null[] $relatedEntities */
        $relatedEntities = self::makeRelatedEntitiesFromArray([
            'company' => CompanyEntity::class,
        ], $_arr);

        return new static ($_arr['id'], $_arr['email'], $_arr['name'], $_arr['second_name'], ...$relatedEntities);
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSecondName(): ?string
    {
        return $this->second_name;
    }

    /**
     * @return CompanyEntity|null
     */
    public function getCompany(): ?CompanyEntity
    {
        return $this->company;
    }
}
