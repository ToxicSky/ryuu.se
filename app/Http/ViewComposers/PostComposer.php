<?php

namespace App\Http\ViewComposers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PostComposer
{

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (($archive = Session::get('archive', null)) === null) {
            $archive = Post::orderBy(
                'created_at', 'desc'
            )->get()->groupBy(function ($item) {
                return Carbon::createFromFormat(
                    'Y-m-d H:i:s', $item['created_at']
                )->format('Y');
            })->map(function ($item) {
                return $item->groupBy(function ($item) {
                    return Carbon::createFromFormat(
                        'Y-m-d H:i:s', $item['created_at']
                    )->format('F');
                });
            })->toJson();

            Session::put('archive', $archive);
        }

        $view->with('archive', $archive);
    }
}
