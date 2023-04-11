<?php

namespace App\Models;

use App\Helpers\FilterHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'location',
        'personalities',
        'diet',
        'religion',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function filterable(): array
    {
        return [
            ['field' => 'name', 'type' => 'str', 'query' => 'where like'],
            ['field' => 'age', 'type' => 'int', 'query' => 'where'], // where (match, lower, higher, between)
            ['field' => 'location', 'type' => 'str', 'query' => 'where like'],
            ['field' => 'religion', 'type' => 'enum|str', 'query' => 'where like'],
        ];
    }

    public function filterFromData(array $values): Collection
    {
        $query = FilterHelper::applyFilters(
            DB::table($this->getTable()),
            $this->filterable(),
            $values
        );

        return $query->get();
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'languages_users');
    }

    public function allergies(): BelongsToMany
    {
        return $this->belongsToMany(Allergy::class, 'allergies_users');
    }
}
