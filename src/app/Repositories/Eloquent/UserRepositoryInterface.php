<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function login(string $email, string $password): User;

    public function register(string $name, string $email, string $password): User;

    public function logout(): void;
}
