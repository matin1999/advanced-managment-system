<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function CreateUser(array $data) : ?User;
    public function getUserByEmail(string $email): ?User;
}
