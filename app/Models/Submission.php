<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
