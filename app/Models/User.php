<?php

namespace App\Models;

use App\Notifications\CustomResetPasswordNotification;
use App\Traits\CreatedUpdatedByTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email_verified_at',
        'username',
        'email',
        'fullname',
        'role_id',
        'status',
        'description',
        'avatar',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function user()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function users()
	{
		return $this->hasMany(User::class, 'updated_by');
	}
}