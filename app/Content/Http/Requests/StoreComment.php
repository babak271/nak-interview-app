<?php

namespace App\Content\Http\Requests;

use Domain\Content\Enums\CommentExtraData;
use Domain\Content\Enums\CommentType;
use Domain\Content\Events\CommentCreated;
use Domain\Content\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
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
     * Store post.
     *
     * @return Comment
     */
    public function persist($target_resource)
    {
        $data = $this->all();

        $data['user_id']    = \Auth::check() ? \Auth::id() : null;
        $data['type']       = CommentType::COMMENT;
        $data['extra_data'] = [CommentExtraData::RATE => $this->get('rate')];

        $comment = \Domain\Content\Facades\Comment::create($target_resource, $data);

        event(new CommentCreated($comment));
        return $comment;
    }
}
