<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'bio',
        'image',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function ideas()
    {
        return $this->hasMany(Idea::class)->latest();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function followings()
    {
        //return $this->hasMany(User::class, 'user_id');
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id');
    }

    public function followers()
    {
        //return $this->hasMany(User::class, 'follower_id');
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id');
    }

    public function follows(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    public function likesIdea(Idea $idea)
    {
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }
    //here we get all ideas that the user liked it.
    //the correct convention table name is idea_user
    //because the table name is not idea_user we should put the table name inside the relationship
    public function likes()
    {
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps();
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/'. $this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$this->name}}";
    }
}
