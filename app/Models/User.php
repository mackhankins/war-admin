<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'discriminator',
        'email',
        'password',
        'discord_id',
        'avatar',
        'nickname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findOrCreateUser($user)
    {
        if ($authUser = User::where('discord_id', $user->id)->orWhere('email',$user->email)->first()) {
            $authUser->update([
                'avatar' => $user->avatar,
                'name' => $user->name,
                'discriminator' => $user->user['discriminator'],
                'username' => $user->nickname,
            ]);

            return $authUser;
        }

        return User::create([
            'discord_id' => $user->id,
            'avatar' => $user->avatar,
            'name' => $user->name,
            'discriminator' => $user->user['discriminator'],
            'nickname' => $user->nickname,
        ])->assignRole('user');


    }

    public function getDiscordAttribute()
    {
        return $this->name.'#'.$this->discriminator;
    }

    public function character()
    {
        return $this->hasOne(Character::class);
    }
}
