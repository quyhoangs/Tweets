<?php
namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likable{

    /*   select * from tweets a 
         left join (
                    select tweet_id, sum(liked) likes,sum(!liked) dislike from likes
                    GROUP BY tweet_id
                    ) b ON b.tweet_id=a.id 
    */
    public function scopeWithLikes(Builder $querry)
    {   //leftJoinSub($querry,$as,$fisrt)
        $querry->leftJoinSub(
            'select tweet_id, sum(liked) likes,sum(!liked) dislikes from likes GROUP BY tweet_id',
            'likes',
            'likes.tweet_id', 'tweets.id'
        );

    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function isLikedBy(User $user)
    {
        return (bool) $user->likes
        ->where('tweet_id',$this->id)
        ->where('liked',true)
        ->count();
    }

    public function isDisLikedBy(User $user)
    {
        return (bool) $user->likes
        ->where('tweet_id',$this->id)
        ->where('liked',false)
        ->count();
    }

    public function dislike($user=null)
    {
        return  $this->like($user,false);
    }

    public function like($user=null,$liked= true)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id()
        ],[ 
            'liked'  =>$liked 
        ]);
    }
}


