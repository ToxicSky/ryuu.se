<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'comment',
        'email',
        'name',
    ];

    /**
     * @return mixed
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
