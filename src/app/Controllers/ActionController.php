<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Repository\BlogRepositoryInterface;
use App\Repository\CommentRepositoryInterface;

class ActionController
{
    use View;

    /**
     * @param \App\Repository\BlogRepositoryInterface $blogRepository
     * @param \App\Repository\CommentRepositoryInterface $commentRepository
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
