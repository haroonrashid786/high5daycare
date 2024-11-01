<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Authorization\RoleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use NunoMaduro\Collision\Provider;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, RoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'unread_count'
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
        'password' => 'hashed',
    ];


        public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }
        $this->roles()->attach($role->id);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    public function provider()
    {
        return $this->hasOne(DaycareProvider::class,'user_id','id');
    }

    public function parent()
    {
        return $this->hasOne(Parents::class,'user_id','id');
    }


    public function sentMessages()
    {
    return $this->hasMany(TicketMessage::class, 'sender_id');
    }

    public function receivedMessages()
    {
    return $this->hasMany(TicketMessage::class, 'receiver_id');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_users', 'user_id', 'ticket_id')->withTimestamps();
    }

    public function notices()
    {
        return $this->hasMany(Notification::class,'user_id','id')->where('read_at',null)->latest();
    }
}
