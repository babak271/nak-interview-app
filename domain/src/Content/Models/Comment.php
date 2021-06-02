<?php

namespace Domain\Content\Models;

use BenSampo\Enum\Traits\CastsEnums;
use Domain\Content\Casts\CommentExtraData;
use Domain\Content\Enums\CommentStatus;
use Domain\Content\Enums\CommentType;
use Domain\Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CastsEnums;

    protected $fillable = [
        'type',
        'user_id',
        'parent_id',
        'status',
        'title',
        'body',
        'model_id',
        'model_type',
        'extra_data',
        'ip_address',
    ];

    protected $casts = [
        'type'       => CommentType::class,
        'status'     => CommentStatus::class,
        'extra_data' => CommentExtraData::class,
    ];

    /**
     * The attributes that have default values.
     *
     * @var array
     */
    protected $attributes = [
        'type'   => CommentType::COMMENT,
        'status' => CommentStatus::ACCEPTED,
    ];

    protected static function newFactory()
    {
        return CommentFactory::new();
    }

    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo('model');
    }

    /**
     * Get user
     *
     * @return BelongsTo
     */
    public function user()
    {
        // TODO: fill here after implementing user model.
    }

    public function scopeActive($query)
    {
        return $query->where('status', CommentStatus::ACCEPTED);
    }

    public function scopeComment($query)
    {
        return $query->where('type', CommentType::COMMENT);
    }

    public function scopeReview($query)
    {
        return $query->where('type', CommentType::COMMENT);
    }

//    public function getRateAttribute()
//    {
//        return $this->extra_data->get(CommentExtraData::RATE()->key);
//    }
}
