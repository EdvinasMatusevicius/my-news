<?php

declare(strict_types = 1);

namespace App\Http\Requests\Front\Account;

use App\Http\Requests\Admin\ArticleUpdateRequest as AdminArticleUpdateRequest;

/**
 * Class ArticleUpdateRequest
 * @package App\Http\Requests\Front\Account
 */
class ArticleUpdateRequest extends AdminArticleUpdateRequest
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
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'poster' => 'nullable|image',
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $return = [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'content' => $this->input('content')
        ];

        if ($this->file('poster')) {
            $return['poster'] = $this->getPoster();
        }

        return $return;
    }
}