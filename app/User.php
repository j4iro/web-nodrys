<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role','name','surname', 'email', 'password','image','points','state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion One to Many
    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    //Relacion One to Many
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    //Relacion One to Many
    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'asigned_roles');
    }

    public function hasRoles(array $roles){
        //dd($this->roles->toArray());
        foreach ($roles as $role) {
            foreach ($this->roles as $userRole) {
                if($userRole->name===$role){
                    return true;
                }
            }
        }
        return false;
    }

}
