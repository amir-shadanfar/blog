<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

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

    /**
     * @param string $email
     * @param string $password
     *
     * @return \App\Models\User
     * @throws \Exception
     */
    public function login(string $email, string $password): User
    {
        $user = $this->model->where('email', $email)->first();
        if (!$user) {
            throw new \Exception('Email or Password is incorrect!');
        }
        if ($user) {
            if (password_verify($password, $user->password)) {
                // login successful
                $_SESSION["user_id"] = $user->id;
                $_SESSION["user_name"] = $user->name;

                return $user;
            }
        }
    }

    public function logout(): void
    {

    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return \App\Models\User
     */
    public function register(string $name, string $email, string $password): User
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
        return $user;
    }
}
