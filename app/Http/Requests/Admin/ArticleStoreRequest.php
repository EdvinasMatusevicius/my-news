<?php

declare(strict_types = 1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

/**
 * Class ArticleStoreRequest
 * @package App\Http\Requests\Admin
 */
class ArticleStoreRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'active' => 'boolean',
        ];
    }

    /**
     * @param Validator $validator
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (!$this->isSlugUnique()) {
                $validator->errors()->add('slug', 'Made slug must be unique');
            }
        });
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'content' => $this->input('content'),
            'poster' => $this->getPoster(),
            'user_id' => $this->input('user_id'),
            'active' => (bool)$this->input('active'),
        ];
    }

    /**
     * @return string
     */
    protected function getSlug(): string
    {
        $slug = $this->input('slug');

        if ($slug == null) {
            $slug = $this->getTitle();
        }

        return Str::slug($slug);
    }

    /**
     * @return string|null
     */
    protected function getTitle(): ?string
    {
        return $this->input('title');
    }

    /**
     * @return bool
     */
    protected function isSlugUnique(): bool
    {
        $slug = $this->getSlug();

        return DB::table('articles')
            ->where('slug', '=', $slug)
            ->doesntExist();
    }

    /**
     * @return string|null
     */
    protected function getPoster(): ?string
    {
        if ($poster = $this->file('poster')) {
            if ($path = $poster->store('article')) {
                return $path;
            }
        }

        return null;
    }
}