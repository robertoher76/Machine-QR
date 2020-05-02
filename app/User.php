<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the role associated with the user.
     */
    public function role(){

        return $this->belongsTo('App\Role');

    }

    public function isSuperAdmin(){

        if($this->role->nombre_role == 'SuperAdmin')
            return true;
        return false;            
    }

    public function isAdmin(){

        if($this->role->nombre_role == 'Admin')
            return true;
        return false;            
    }

    public static function getUsuarios(){
        return User::where('id','!=',Auth::id())->get();
    }
}
