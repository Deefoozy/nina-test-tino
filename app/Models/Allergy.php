<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'allergy',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'allergies_users');
    }
}