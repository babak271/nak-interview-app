<?php

namespace Domain\Content\Casts;

use Domain\Content\Enums\CommentExtraData as CommentExtraDataEnum;
use Domain\Content\Models\Comment;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Collection;

class CommentExtraData implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param Comment $comment
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return Collection
     */
    public function get($comment, $key, $value, $attributes)
    {
        $raw_array       = json_decode($value, true) ?? [];
        $processed_array = [];

        foreach ($raw_array as $item) {
            foreach (CommentExtraDataEnum::asArray() as $key => $value) {
                $processed_array[$key] = $item[$value] ?? null;
            }
        }

        return collect($processed_array)->filter();
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Comment $comment
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return false|string
     */
    public function set($comment, $key, $value, $attributes)
    {
        return json_encode($value, JSON_FORCE_OBJECT);
    }
}
