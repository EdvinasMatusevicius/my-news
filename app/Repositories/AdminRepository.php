<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Admin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminRepository
{
    public function createNew(array $data): Admin
    {
        return Admin::query()->create($data);
    }
    public function getPaginatedList(?int $perPage = null,array $columns = ['*']):LengthAwarePaginator
    {
        return Admin::query()->paginate($perPage,$columns);
    }
}