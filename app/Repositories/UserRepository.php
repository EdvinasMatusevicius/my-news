<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function listFormSelectElement(): array
    {
        return User::query()->select(['id', 'name', 'email'])->get()
            ->mapWithKeys(function (User $user) {
                return [$user->id => $user->name . ' <' . $user->email . '>'];
            })->all();
    }
} 