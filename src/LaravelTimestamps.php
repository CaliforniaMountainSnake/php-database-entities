<?php

namespace CaliforniaMountainSnake\DatabaseEntities;

/**
 * Трейт для добавления в сущность стандартных столбцов даты Laravel.
 */
trait LaravelTimestamps
{
    /**
     * @var string|null
     */
    protected $created_at;

    /**
     * @var string|null
     */
    protected $updated_at;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @return int|null
     */
    public function getCreatedAtTimestamp(): ?int
    {
        return $this->getColumnTimestamp($this->created_at);
    }

    /**
     * @return int|null
     */
    public function getUpdatedAtTimestamp(): ?int
    {
        return $this->getColumnTimestamp($this->updated_at);
    }

    /**
     * @param string|null $_column
     * @return int|null
     */
    private function getColumnTimestamp(?string $_column): ?int
    {
        if ($_column === null) {
            return null;
        }
        return \strtotime($_column);
    }
}
