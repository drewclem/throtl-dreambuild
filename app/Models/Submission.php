<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Submission extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'why',
        'throtl_username',
        'active_vip',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'car_info',
        'dream_build',
        'ig_post',
        'fav_episode',
        'social_media',
        'terms_of_service',
        'collection_id'
    ];

    protected $casts = [
        'active_vip' => 'boolean',
        'terms_of_service' => 'boolean',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function isWinner(): bool
    {
        return $this->id === $this->collection->winner_id;
    }

    public function allLikes(): HasMany
    {
        return $this->hasMany(SubmissionLike::class);
    }

    public function likes()
    {
        return $this->allLikes()->where('value', 'like');
    }

    public function dislikes()
    {
        return $this->allLikes()->where('value', 'dislike');
    }
}
