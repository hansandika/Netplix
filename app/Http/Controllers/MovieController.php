<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{

    public function index(Request $request)
    {

        $movies = Movie::paginate(5);

        $trendingMovies = Movie::get();
        $trendingMovies = $trendingMovies->sortBy(function ($trendSort) {
            return $trendSort->count;
        });
        $trendingMovies = $trendingMovies->reverse();

        $genres = Genre::get();

        $randomMovies = Movie::inRandomOrder()->limit(3)->get();

        $pages = Movie::count() / 5;

        if ($request->ajax() && $request->page) {
            $view = view('movie.data', compact('movies'))->render();
            return response()->json(['html' => $view]);
        } else if ($request->ajax() && $request->genre && !$request->sort) {
            if ($request->search == '') {
                $moviesGenres = Movie::join('showgenre', 'show.show_id', '=', 'showgenre.show_id')
                    ->join('genre', 'showgenre.genre_id', '=', 'genre.genre_id')
                    ->where('genre.name', $request->genre)->get();
                $view = view('movie.data', ['movies' => $moviesGenres])->render();
                return response()->json(['html' => $view]);
            } else {
                $moviesGenres = Movie::join('showgenre', 'show.show_id', '=', 'showgenre.show_id')
                    ->join('genre', 'showgenre.genre_id', '=', 'genre.genre_id')
                    ->where('genre.name', $request->genre)
                    ->where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('movie.data', ['movies' => $moviesGenres])->render();
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && !$request->genre && $request->sort) {
            if ($request->search == '') {
                $moviesSort = '';
                if ($request->sort == 'Latest') {
                    $moviesSort = Movie::latest('release_date')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesSort = Movie::select('*')->orderBy('title')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesSort = Movie::select('*')->orderBy('title', 'desc')->get();
                } else if ($request->sort == 'Rating') {
                    $moviesSort = Movie::get();
                    $moviesSort = $moviesSort->sortBy(function ($currMovieSort) {
                        return $currMovieSort->rating;
                    });
                    $moviesSort = $moviesSort->reverse();
                }
                $view = view('movie.data', ['movies' => $moviesSort])->render();
                return response()->json(['html' => $view]);
            } else {
                $moviesSort = '';
                if ($request->sort == 'Latest') {
                    $moviesSort = Movie::latest('release_date')
                        ->where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesSort = Movie::select('*')->orderBy('title')
                        ->where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesSort = Movie::select('*')->orderBy('title', 'desc')
                        ->where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                } else if ($request->sort == 'Rating') {
                    $moviesSort = Movie::where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                    $moviesSort = $moviesSort->sortBy(function ($currMovieSort) {
                        return $currMovieSort->rating;
                    });
                    $moviesSort = $moviesSort->reverse();
                }
                $view = view('movie.data', ['movies' => $moviesSort])->render();
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && $request->genre && $request->sort) {
            if ($request->search == '') {
                $moviesMix = Movie::join('showgenre', 'show.show_id', '=', 'showgenre.show_id')
                    ->join('genre', 'showgenre.genre_id', '=', 'genre.genre_id')
                    ->where('genre.name', $request->genre);
                if ($request->sort == 'Latest') {
                    $moviesMix = $moviesMix->orderBy('release_date', 'desc')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesMix = $moviesMix->orderBy('title')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesMix = $moviesMix->orderBy('title', 'desc')->get();
                } else if ($request->sort == 'Rating') {
                    $moviesMix = $moviesMix->get();
                    $moviesMix = $moviesMix->sortBy(function ($currMovieSort) {
                        return $currMovieSort->rating;
                    });
                    $moviesMix = $moviesMix->reverse();
                };
                $view = view('movie.data', ['movies' => $moviesMix])->render();
                return response()->json(['html' => $view]);
            } else {
                $moviesMix = Movie::join('showgenre', 'show.show_id', '=', 'showgenre.show_id')
                    ->join('genre', 'showgenre.genre_id', '=', 'genre.genre_id')
                    ->where('genre.name', $request->genre)
                    ->where('show.title', 'LIKE', '%' . $request->search . '%');
                if ($request->sort == 'Latest') {
                    $moviesMix = $moviesMix->orderBy('release_date', 'desc')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesMix = $moviesMix->orderBy('title')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesMix = $moviesMix->orderBy('title', 'desc')->get();
                } else if ($request->sort == 'Rating') {
                    $moviesMix = $moviesMix->get();
                    $moviesMix = $moviesMix->sortBy(function ($currMovieSort) {
                        return $currMovieSort->rating;
                    });
                    $moviesMix = $moviesMix->reverse();
                };
                $view = view('movie.data', ['movies' => $moviesMix])->render();
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && !$request->genre && !$request->sort) {
            if ($request->search == '') {
                $moviesGenres = Movie::get();
                $view = view('movie.data', ['movies' => $moviesGenres])->render();
                return response()->json(['html' => $view]);
            } else {
                $moviesGenres = Movie::where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('movie.data', ['movies' => $moviesGenres])->render();
                return response()->json(['html' => $view]);
            }
        }

        return view('movie.index', compact('movies', 'trendingMovies', 'genres', 'randomMovies', 'pages'));
    }

    public function show(Movie $movie)
    {
        $genres = DB::table('showgenre')
            ->join('genre', 'showgenre.genre_id', '=', 'genre.genre_id')
            ->where('show_id', $movie->show_id)->get();

        $actors = DB::table('show')
            ->join('cast', 'show.show_id', '=', 'cast.show_id')
            ->join('actor', 'cast.actor_id', '=', 'actor.actor_id')
            ->where('show.show_id', $movie->show_id)->get();

        $reviews = Review::where('show_id', $movie->show_id)->get();

        $movies = Movie::get();

        return view('movie.show', compact('movie', 'actors', 'genres', 'reviews', 'movies'));
    }
}
