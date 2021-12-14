<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function deleteReview(User $user, Review $review)
    {
        if ($review->user_id == $user->user_id) {
            return true;
        } else {
            return false;
        }
    }
}
