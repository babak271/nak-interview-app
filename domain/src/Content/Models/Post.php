<?php

namespace Domain\Content\Models;

use Domain\Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'slug',
        'title',
        'body',
    ];

    protected $attributes = [
        'status' => 1,
    ];

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
