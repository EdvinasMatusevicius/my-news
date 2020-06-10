<?php

declare(strict_types = 1);

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\DB;

/**
 * Class ArticleUpdateRequest
 * @package App\Http\Requests\Admin
 */
class ArticleUpdateRequest extends ArticleStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return parent::rules();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $return = [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'content' => $this->input('content'),
            'user_id' => $this->input('user_id'),
            'active' => (bool)$this->input('active'),
        ];

        if ($this->file('poster')) {
            $return['poster'] = $this->getPoster();
        }

        return $return;
    }

    protected function isSlugUnique(): bool
    {
        $slug = $this->getSlug();
        $articleId = $this->route()->parameter('article')->id;

        return DB::table('articles')
            ->where('slug', '=', $slug)
            ->where('id', '!=', $articleId)
            ->doesntExist();
    }
}