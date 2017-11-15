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

    /**
     * Returns an array of rules for validation.
     *
     * @param bool $edit
     * @return array
     */
    public function validationRules(bool $edit = false)
    {
        $rules = [
            'title'    => 'required|max:191|unique:posts,title',
            'body'     => 'required|min:10',
            'category' => 'required|min:1',
        ];

        if ($edit) {
            $rules['title'] = sprintf(
                'required|max:191|unique:posts,title,%d',
                $this->id
            );
        }

        return $rules;
    }
}
