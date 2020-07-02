<?php

declare(strict_types = 1);

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'article_id' => 'required|integer|exists:articles,id',
            'email' => 'required|string|email',
            'comment' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'article_id' => $this->input('article_id'),
            'email' => $this->input('email'),
            'comment' => $this->input('comment'),
        ];
    }
}