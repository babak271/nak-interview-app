<?php

namespace App\Content\Http\Requests;

use Domain\Content\Models\Post;
use Domain\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'title'  => 'nullable|string|max:250',
            'slug'   => 'nullable|string|max:250',
            'status' => 'nullable',
            'body'   => 'required',
        ];
    }

    /**
     * Store post.
     *
     * @return Post
     */
    public function persist()
    {
        return app(PostRepositoryInterface::class)
            ->create($this->all());
    }
}
