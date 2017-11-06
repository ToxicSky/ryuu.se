<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Post;

class Tag extends Model
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
        return $this->belongsToMany(Post::class);
    }

    /**
     * Inserts new tags into the database while also fetching those already
     * in the list.
     *
     * @param string $str
     * @return array
     */
    public function createFromStr(string $str, string $seperator = ',')
    {
        $tagArray = explode($seperator, $str);
        $tagArray = array_map('trim', $tagArray);

        $newTags = [];
        foreach ($tagArray as $tag) {
            $newTag    = self::firstOrCreate(['title' => $tag]);
            $newTags[] = $newTag->id;
        }

        return $newTags;
    }
}
