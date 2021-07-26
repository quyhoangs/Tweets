<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Tweet extends Model
{   
    
    use Likable;
    protected $guarded=[];
    
    public function user()
    {
        
        return $this->belongsTo(User::class);
    }

   
}
