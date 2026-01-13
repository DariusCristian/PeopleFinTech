<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuccessStory extends Model
{
    protected $fillable = [
        'title',
        'story',
        'member_id',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
