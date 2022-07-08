<?php

namespace App\Controllers;

use App\Enum\DisplayMode;
use App\Helpers\View;
use App\Repository\BlogRepositoryInterface;

class PageController
{
    use View;

    /**
     * @param \App\Repository\BlogRepositoryInterface $blogRepository
     */
    public function __construct(protected BlogRepositoryInterface $blogRepository)
    {

    }

    /**
     * @return void
     */
    public function home()
    {
        $data = $this->blogRepository->all(['user', 'comments'], ['limit' => 3], DisplayMode::PAGINATE);
        return $this->render(ROOT_PATH . '/templates/home.php', ['data' => $data]);
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function blog_detail(int $id)
    {
        $data = $this->blogRepository->findById($id, ['*'], ['user', 'comments']);
        return $this->render(ROOT_PATH . '/templates/blog_detail.php', ['data' => $data]);
    }

    /**
     * @return void
     */
    public function about()
    {
        return $this->render(ROOT_PATH . '/templates/about.php');
    }
}
