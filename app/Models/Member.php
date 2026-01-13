<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SuccessStory;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'profession',
        'company',
        'linkedin_url',
        'status'
    ];

    public function successStories(): HasMany
    {
        return $this->hasMany(SuccessStory::class);
    }
}
