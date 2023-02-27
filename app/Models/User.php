<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone',
        'status',
        'referal',
        'kunci',
        'cms_role_id'
    ];

    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

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

    public static function save_data($request){

        $save = User::insert([
            "id"            => (string) Str::uuid(),
            "name"          =>$request->name,
            "email"         =>$request->email,
            "phone"         =>$request->phone,
            "password"      =>Hash::make($request->password),
            "created_at"    =>date('Y-m-d H:i:s'),
            "cms_role_id"   =>3,
            "status"        =>'notactive'
        ]);

        return $save;
    }

    public static function fetch_one($id){
        $data=User::join('cms_role','users.cms_role_id','=','cms_role.id')
                ->where('users.id',$id)
                ->select('users.*','cms_role.name as cms_role_name')
                ->first();

        return $data;
    }
}
