<?php

namespace App\DesignPatterns\Property;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class RelationalProperty extends Property
{
    protected array $columns = [];

    protected int $per_page = -1;

    protected int $page = 1;

    abstract public function model(): string;

    /**
     * @return Collection|Builder[]
     */
    public function get()
    {
        return $this->query()->get();
    }

    public function query(): Builder
    {
        $model = $this->model();
        $instance = new $model;
//        if ($instance instanceof Model) {
        $query = $instance::query();
        if (count($this->columns) > 0) {
            $query->select($this->columns);
        }
        if ($this->per_page > 0) {
            $offset = ($this->page - 1) * $this->per_page;
            $query->limit($this->per_page)->offset($offset);
        }
        return $query;
//        }
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getPerPage(): int
    {
        return $this->per_page;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPerPage(int $per_page): void
    {
        $this->per_page = $per_page;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }
}
