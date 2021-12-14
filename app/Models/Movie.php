<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'show';
    protected $dates = [
        'release_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function getRatingAttribute()
    {
        $reviews = Review::where('show_id', $this->show_id)->get();
        $count = $reviews->count();
        if ($count == 0) {
            return '-';
        }
        $total = 0;
        foreach ($reviews as $review) {
            $total += $review->rating;
        }
        return $total / $count;
    }

    public function getCountAttribute()
    {
        $count = Movie::select('show.show_id')->join('watchlist', 'show.show_id', '=', 'watchlist.show_id')
            ->where('show.show_id', $this->show_id)->groupBy('show.show_id')->count();
        return $count;
    }

    public function getOwnRatingAttribute()
    {
        $user = Auth::user();
        $review = Review::where('show_id', $this->show_id)->where('user_id', $user->user_id)->first();
        if ($review == null) {
            return '-';
        } else {
            return $review->rating;
        }
    }
}
