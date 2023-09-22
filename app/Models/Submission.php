<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
