<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements  JWTSubject
{
    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



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

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user');
    }




    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach ($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }

        return false;
    }

    public function hasRole($role){
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }


//    public function authorizeRoles($roles)
//    {
//        if (is_array($roles)) {
//            return $this->hasAnyRole($roles) ||
//                abort(401, 'This action is unauthorized.');
//        }
//        return $this->hasRole($roles) ||
//            abort(401, 'This action is unauthorized.');
//    }
//
//    public function hasAnyRole($roles)
//    {
//        return null !== $this->roles()->whereIn('name', $roles)->first();
//    }
//
//    public function hasRole($role)
//    {
//        return null !== $this->roles()->where('name', $role)->first();
//    }
}
