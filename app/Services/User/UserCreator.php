<?php

namespace App\Services\User;

use App\Mail\RegistrarUser;
use App\Models\Role;
use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserCreator
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store($data)
    {
        try {
            $data['token'] = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $role = Role::where('name', $data['role'])->first();
            $data['password'] = $this->generateRandomAlphabeticString(8);
            $data['reference'] = $data['password'];
            $data['password'] = bcrypt($data['password']);
            $user = $this->userRepository->store($data);
            $user->roles()->attach($role);
            // Mail::to($user->email)->send(new RegistrarUser($user));
            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }


    private function generateRandomAlphabeticString($length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
