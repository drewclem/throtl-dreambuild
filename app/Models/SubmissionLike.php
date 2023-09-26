<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubmissionLike extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'submission_id',
        'user_id',
        'value'
    ];

    public function submission(): HasOne
    {
        return $this->hasOne(Submission::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
