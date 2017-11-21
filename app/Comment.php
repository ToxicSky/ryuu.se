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

    /**
     * Returns an array of rules for validation.
     *
     * @return array
     */
    public function validationRules()
    {
        $rules = [
            'name'    => 'required',
            'email'   => 'required|max:191',
            'comment' => 'required|min:2',
            'post_id' => 'required|min:1',
        ];

        return $rules;
    }
}
