<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];
    protected $fillable = [
        'content',
        'user_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //here we get all users who liked the idea or post
    //the correct convention table name is idea_user
    //because the table name is not idea_user we should put the table name inside the relationship
    public function likes()
    {
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps();
    }
}
