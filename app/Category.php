<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
