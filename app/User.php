<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use function PHPUnit\Framework\isNull;

class User extends Authenticatable
{
    use Notifiable,Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

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
    //Lấy link avatar trong db 
    public function getAvatarAttribute($value)
    {   
        $img='storage/avatars/avatar-default.png';
        
        return asset( $value ?'storage/'.$value: $img);
    }

    // Mã hoá mật khẩu khi update user
    public function setPasswordAtribute($value)
    {
        $this->attributes['password']=bcrypt($value);
    }
    //Hiển thị bài đăng trong timeline
    public function timeline()
    {   
        $friends=$this->follows()->pluck('id');

        return Tweet::whereIn('user_id',$friends)
                ->orWhere('user_id',$this->id)
                ->withLikes()  //Truyền số lượng like và dislike từ scopeWithLikes
                ->latest()->paginate(10);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

   // Lấy tên URl bao gồm Username
    public function getRouteKeyName()
    {
        return 'username';
    }
    //Xử lý path cho Router
    public function path($append = '')
    {   
        $path = route('profile',$this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

    public function likes() 
    {
         return $this->hasMany(Like::class); 
    }

}
