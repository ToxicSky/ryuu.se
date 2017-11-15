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

    /**
     * Returns an array of rules for validation.
     *
     * @param bool $edit
     * @return array
     */
    public function validationRules(bool $edit = false)
    {
        $rules = [
            'title' => 'required|max:191|unique:categories',
        ];

        if ($edit) {
            $rules['title'] = sprintf(
                'required|max:191|unique:categories,%d',
                $this->id
            );
        }

        return $rules;
    }
}
