<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Admin;

class AdminRepository
{
    public function createNew(array $data): Admin
    {
        return Admin::query()->create($data);
    }
}