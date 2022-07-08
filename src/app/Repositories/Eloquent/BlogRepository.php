<?php

namespace App\Repository\Eloquent;

use App\Models\Blog;
use App\Repository\BlogRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repository\BaseRepository;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    /**
     * @param \App\Models\Blog $model
     */
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $filter
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(array $filter): Builder
    {
        $query = $this->model->query();
        // name
        if (!empty($filter['title'])) {
            $query->where('title', 'LIKE', '%' . $filter['title'] . '%');
        }
        // user
        if (!empty($filter['user_id'])) {
            $query->whereHas('user', function ($q) use ($filter) {
                $q->where('id', $filter['user_id']);
            });
        }
        return $query;
    }
}
