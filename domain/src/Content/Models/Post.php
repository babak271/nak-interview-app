<?php

namespace Domain\Content\Models;

use BenSampo\Enum\Traits\CastsEnums;
use Cviebrock\EloquentSluggable\Sluggable;
use Domain\Content\Enums\PostStatus;
use Domain\Content\Traits\HasComments;
use Domain\Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use CastsEnums;
    use HasComments;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'status',
        'slug',
        'title',
        'body',
    ];

    protected $attributes = [
        'status' => PostStatus::ACTIVE,
    ];

    protected $casts = [
        'status' => PostStatus::class,
    ];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    /**
     * Generate slug for the product.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
