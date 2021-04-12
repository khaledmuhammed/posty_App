<?php

namespace App;
use App\Like;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Post extends Model
{
    // App\Item::factory()->create();
    // use RefreshDatabase;

    protected $fillable = [
        'user_id', 'body',
    ];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id',$user->id);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
