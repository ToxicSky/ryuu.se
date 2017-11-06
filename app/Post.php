<?php

namespace App;

use App\Category;
use App\Comment;
use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'category_id',
    ];

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return mixed
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
