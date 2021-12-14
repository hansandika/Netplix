<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $this->authorize('review', $movie);

        $request->validate([
            'rating' => 'required|numeric|min:1|max:10',
            'description' => 'required'
        ]);


        Review::create([
            'show_id' => $movie->show_id,
            'user_id' => Auth::user()->user_id,
            'rating' => $request->rating,
            'body' => $request->description,
            'review_date' => Carbon::now()
        ]);


        return redirect('/movie/' . $movie->show_id)->with('success', 'Review posted');
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('deleteReviewMovie', $movie);

        $user = Auth::user();

        $review = Review::where('show_id', $movie->show_id)->where('user_id', $user->user_id)->delete();

        return redirect('/movie/' . $movie->show_id)->with('success', 'Review successfully deleted');
    }
}
