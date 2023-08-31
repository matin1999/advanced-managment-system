<?php

namespace App\Repositories;


use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{

    public function CreateUser(array $data): ?User
    {
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        try {
            $user->save();
            return $user;
        } catch (\Exception $exception) {
            Log::error('save_user_to_db_exception_' . $exception->getMessage());
            return null;
        }
    }
    public function getUserByEmail(string $email): ?User
    {
        $user = User::where('email', $email)->first();
        try {
            return $user;
        } catch (\Exception $exception) {
            Log::error('getUserByEmail_exception_' . $exception->getMessage());
            return null;
        }
    }
}
