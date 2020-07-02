<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\ArticleComment;
use Illuminate\Database\Eloquent\Model;

class ArticleCommentRepository
{
    /**
     * @param array $data
     * @return ArticleComment|Model
     */
    public function createNew(array $data): ArticleComment
    {
        return ArticleComment::query()->create($data);
    }
} 