<?php

namespace Domain;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface BaseRepositoryInterface
{
    /**
     * Get resource/s by passing id or ids of resource/s.
     *
     * @param int|array $id
     * @param bool $complain
     * @return mixed|Collection
     * @throws ModelNotFoundException
     */
    public function getById($id, bool $complain = true);
}
