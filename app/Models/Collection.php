<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'open_date',
        'close_date',
        'description',
        'company_id',
        'cta',
        'subtitle',
        'lowerBanner',
    ];

    protected $casts = [
        'open_date' => 'date',
        'close_date' => 'date',
    ];

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
