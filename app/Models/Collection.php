<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\Cast\Bool_;

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

    public function scopeActive($query)
    {
        return Collection::where('open_date', '<=', now())
            ->where(function ($query) {
                return $query->where('close_date', '>=', now());
            });
    }

    public function scopeIsActive($query): Bool
    {
        return $this->open_date <= now() && $this->close_date >= now();
    }
}
