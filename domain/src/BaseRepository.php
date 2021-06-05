<?php

namespace Domain;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public function getById($id, $complain = true)
    {
        $query = $this->getQuery();
        if (is_array($id)) {
            return $query->whereIn('id', $id)->get();
        }
        $query->whereId($id);
        return $complain ? $query->firstOrFail() : $query->first();
    }

    /**
     * A handler for querying based on column name.
     *
     * @param $column_name
     * @param $column_value
     * @param bool $complain
     * @return Builder|Model|object|null
     */
    protected function getByColumn($column_name, $column_value, bool $complain)
    {
        $query = $this->getQuery();
        $query->where($column_name, $column_value);
        return $complain ? $query->firstOrFail() : $query->first();
    }

    /**
     * Specify query of your model here.
     *
     * @return Builder
     */
    abstract protected function getQuery();
}
