<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    //category has many category_posts
    public function categoryPosts(){
        return $this->hasMany(CategoryPost::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
