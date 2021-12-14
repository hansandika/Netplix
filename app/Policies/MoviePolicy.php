<?php

namespace App\Policies;

use App\Models\{User, Movie, Review};
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function review(User $user, Movie $movie)
    {
        $count = Review::where('show_id', '=', $movie->show_id)->where('user_id', '=', $user->user_id)->count();
        if ($count == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReviewMovie(User $user, Movie $movie)
    {
        $count = Review::where('show_id', '=', $movie->show_id)->where('user_id', '=', $user->user_id)->count();
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function addWatchList(User $user, Movie $movie)
    {
        $count = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('show.show_id', '=', $movie->show_id)
            ->where('user_id', '=', $user->user_id)->count();
        if ($count == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function actionWatchList(User $user, Movie $movie)
    {
        $count = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('show.show_id', '=', $movie->show_id)
            ->where('user_id', '=', $user->user_id)->count();
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }
}
