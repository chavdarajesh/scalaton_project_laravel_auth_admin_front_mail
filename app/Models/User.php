<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'is_admin',
        'status',
        'is_verified',
        'phone',
        'username',
        'address',
        'dateofbirth',
        'profileimage',
        'created_at',
        'updated_at',
        'deleted_at',
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

    static public function get_user_by_id($id)
    {
        $User=[];
        $user=User::find($id);
        if($user){
            $User=$user;
        }
        else{
            $User['name']='User Deleted';
        }
        return $User;
    }
    static public function get_total_use_referral_user_by_id($id)
    {
        $user=User::find($id);
        if($user){
            $user_referral_code=$user->referral_code;
            $user_other_referral_code=User::where('other_referral_code',$user_referral_code)->count();
            return $user_other_referral_code;
        }
        else{
            return 0;
        }
    }
}
