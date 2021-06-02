<?php

namespace App\Content\Http\Requests;

use Domain\Content\Enums\CommentExtraData;
use Domain\Content\Models\Comment;
use Domain\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateComment extends FormRequest
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
            'title' => 'nullable|required_without_all:body,rate|string|max:250',
            'body'  => 'nullable|required_without_all:title,rate|max:50000',
            'rate'  => 'nullable|required_without_all:title,body|digits_between:1,5',
        ];
    }

    /**
     * Update comment.
     *
     * @param Comment $comment
     * @return Comment
     */
    public function persist(Comment $comment)
    {
        $data = $this->all();

        $data['extra_data'] = [CommentExtraData::RATE => $this->get('rate')];

        return app(CommentRepositoryInterface::class)
            ->update($data, $comment);
    }
}
