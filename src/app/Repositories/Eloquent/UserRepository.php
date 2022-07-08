<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param \App\Models\User $model
     */
    public function __construct(User $model)
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
        if (!empty($filter['name'])) {
            $query->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }
        // name
        if (!empty($filter['email'])) {
            $query->where('email', 'LIKE', '%' . $filter['email'] . '%');
        }
        // blog
        if (!empty($filter['blog_ids'])) {
            $query->whereHas('blogs', function ($q) use ($filter) {
                $q->whereIn('id', $filter['blog_ids']);
            });
        }
        return $query;
    }
}
