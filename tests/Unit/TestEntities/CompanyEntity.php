<?php

namespace Tests\Unit\TestEntities;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\DatabaseEntities\EntityInterface;
use CaliforniaMountainSnake\DatabaseEntities\Utils\DateFormats;
use DateTime;

class CompanyEntity extends BaseEntity implements DateFormats
{
    public const FOUNDATION_DATE_FORMAT = self::MYSQL_TIMESTAMP_FORMAT;

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
     * @var DateTime
     */
    protected $foundation_date;

    /**
     * CompanyEntity constructor.
     *
     * @param int         $id
     * @param string      $name
     * @param string      $address
     * @param string|null $description
     * @param DateTime    $foundation_date
     */
    public function __construct(int $id, string $name, string $address, ?string $description, DateTime $foundation_date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->description = $description;
        $this->foundation_date = $foundation_date;
    }

    /**
     * @param mixed $value
     * @param bool  $_is_exclude_null
     *
     * @return mixed
     */
    protected function castValue($value, bool $_is_exclude_null = false)
    {
        // Use custom cast:
        if ($value instanceof DateTime) {
            return $value->format(self::FOUNDATION_DATE_FORMAT);
        }

        return parent::castValue($value, $_is_exclude_null);
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
        return new static($_arr['id'], $_arr['name'], $_arr['address'], $_arr['description'],
            DateTime::createFromFormat(self::FOUNDATION_DATE_FORMAT, $_arr['foundation_date']));
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
