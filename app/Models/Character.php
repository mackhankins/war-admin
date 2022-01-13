<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'character_name',
        'character_company',
        'guilded_name',
        'character_level',
        'primary_role',
        'primary_weapon',
        'primary_weapon_level',
        'second_weapon',
        'second_weapon_level',
        'gear_score',
        'third_weapon',
        'fourth_weapon',
        'fifth_weapon',
        'share_information',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
}
