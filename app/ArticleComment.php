<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class ArticleComment
 *
 * @package App
 * @property int $id
 * @property int $article_id
 * @property string $email
 * @property string $comment
 * @property mixed|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ArticleComment newModelQuery()
 * @method static Builder|ArticleComment newQuery()
 * @method static Builder|ArticleComment query()
 * @method static Builder|ArticleComment whereArticleId($value)
 * @method static Builder|ArticleComment whereComment($value)
 * @method static Builder|ArticleComment whereCreatedAt($value)
 * @method static Builder|ArticleComment whereEmail($value)
 * @method static Builder|ArticleComment whereId($value)
 * @method static Builder|ArticleComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ArticleComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'article_id',
        'email',
        'comment',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];
}