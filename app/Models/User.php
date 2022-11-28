<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const adminRole=1;
    const userRole=0;
    const Active=1;
    const Deactive=0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'contact',
        'gender',
        'address',
        'country',
        'profile',
        'role_id',
        'action'
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

    //accessor 
    public function getFullNameAttribute(){
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }
    public function getRoleNameAttribute(){
        return ($this->role_id==self::adminRole)?'Admin':'User';
    }
//country relationship
    public function getCountry(){
        return $this->hasOne(CountryModel::class, 'id', 'country');
    }
//comment relationship
    public function getComment(){
        return $this->hasOne(Comments::class);
    }
}
