<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \App\Models\BaseModel;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const ROLE_CUSTOMER  = 3;
    const ROLE_VENDOR  = 4;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'role_id',
        'status',
    ];

    protected $appends = ['full_name'];

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

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function getTableName($alias = '')
    {
        $table = with(new static)->getTable();
        if($alias!==''){
            $parts = explode('as', $table);
            $_table = trim($parts[0]).' as '.$alias;
            return $_table;
        }
        return $table;
    }

    public function getFullName(){
        return trim($this->first_name.' '.$this->last_name);
    }

    public static function getApprover($userId){
        $user = User::where('id',$userId)->get()->first();
        if($user){
            return $user->full_name;
        }else{
            return 'NA';
        }
    }

    public function role(){
        return $this->belongsTo(Role::class,'role_id','id');
    }
}
