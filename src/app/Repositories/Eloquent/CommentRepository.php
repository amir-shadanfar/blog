<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repository\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    /**
     * @param \App\Models\Comment $model
     */
    public function __construct(Comment $model)
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
        if (!empty($filter['content'])) {
            $query->where('content', 'LIKE', '%' . $filter['content'] . '%');
        }
        // blog
        if (!empty($filter['blog_id'])) {
            $query->whereHas('blog', function ($q) use ($filter) {
                $q->where('id', $filter['blog_id']);
            });
        }
        return $query;
    }
}
