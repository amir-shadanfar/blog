<?php

namespace App\Repository;

use App\Enum\DisplayMode;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @param array $relations
     * @param array $filter
     * @param \App\Enum\DisplayMode $listMode
     *
     * @return array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     * @throws \Exception
     */
    public function all(array $relations = [], array $filter = [], DisplayMode $listMode = DisplayMode::LIST)
    {
        $query = $this->filter($filter);
        // paginate or list
        if ($listMode->value == DisplayMode::PAGINATE->value) {
            // check limit is numeric
            if (!empty($filter['limit'])) {
                if (!is_numeric($filter['limit'])) {
                    throw new \Exception('Pagination limit should be numeric');
                }
                $limit = $filter['limit'];
            } else {
                $limit = 3;
            }
            return $query->with($relations)
                ->orderBy('created_at', 'DESC')
                ->paginate($limit);
        } elseif ($listMode == DisplayMode::LIST->value) {
            return $query->with($relations)->orderBy('created_at', 'DESC')->get();
        } else {
            throw new \Exception(sprintf(__('messages.list.not_exist') . "%s &  %s", DisplayMode::LIST->value, DisplayMode::PAGINATE->value));
        }
    }

    /**
     * @param int $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    /**
     * @param array $payload
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    /**
     * @param int $modelId
     * @param array $payload
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $modelId, array $payload): Model
    {
        $model = $this->findById($modelId);
        $model->update($payload);

        return $model;
    }

    /**
     * @param int $modelId
     *
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }
}
