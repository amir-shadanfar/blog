<?php

namespace App\Repository;

use App\Enum\DisplayMode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @param array $relations
     * @param array $filter
     * @param \App\Enum\DisplayMode $listMode
     *
     * @return mixed
     */
    public function all(array $relations = [], array $filter = [], DisplayMode $listMode = DisplayMode::LIST);

    /**
     * @param array $filter
     *
     * @return mixed
     */
    public function filter(array $filter): Builder;

    /**
     * @param int $modelId
     * @param array|string[] $columns
     * @param array $relations
     * @param array $appends
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model;

    /**
     * @param array $payload
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function create(array $payload): ?Model;

    /**
     * @param int $modelId
     * @param array $payload
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $modelId, array $payload): Model;

    /**
     * @param int $modelId
     *
     * @return bool
     */
    public function deleteById(int $modelId): bool;

}
