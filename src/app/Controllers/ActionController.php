<?php

namespace App\Controllers;

use App\Repositories\Eloquent\BlogRepositoryInterface;
use App\Repositories\Eloquent\CommentRepositoryInterface;

class ActionController extends Controller
{
    /**
     * @param \App\Repositories\Eloquent\BlogRepositoryInterface $blogRepository
     * @param \App\Repositories\Eloquent\CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        protected BlogRepositoryInterface    $blogRepository,
        protected CommentRepositoryInterface $commentRepository
    )
    {
    }

    /**
     * @return void
     */
    public function store_blog()
    {
        $this->blogRepository->create([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'image' => 'https://placeholder.com'
        ]);

        redirect('blogs');
    }

    /**
     * @param $id
     *
     * @return void
     */
    public function delete_comment($id)
    {
        $this->commentRepository->deleteById($id);
        redirect('blogs');
    }
}
