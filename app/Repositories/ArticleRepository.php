<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleRepository
{
    /**
     * @param array $data
     * @return Article
     */
    public function createNew(array $data): Article
    {
        return Article::query()->create($data);
    }
    /**
     * @return LengthAwarePaginator
     */
    public function getActivePaginate(): LengthAwarePaginator
    {
        return Article::query()
            ->where('active', '=', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * @param string $slug
     * @return Article
     */
    public function getActiveBySlug(string $slug): Article
    {
        return Article::query()
        ->with(['comments' => function (HasMany $query) {
            $query->orderByDesc('created_at');
        }])
            ->where('active', '=', true)
            ->where('slug', '=', $slug)
            ->firstOrFail();
    }
    /**
     * @param $accountId
     * @return LengthAwarePaginator
     */
    public function getPaginateByAccountId($accountId): LengthAwarePaginator
    {
        return Article::query()
            ->where('user_id', '=', $accountId)
            ->orderByDesc('created_at')
            ->paginate();
    }
     /**
     * @param int $id
     * @param bool $active
     * @return int
     */
    public function changeActive(int $id, bool $active = false): int
    {
        return Article::query()
            ->where('id', $id)
            ->update(['active' => $active]);
    }
} 