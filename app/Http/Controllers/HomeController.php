<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::paginate(10);

        $latestMovies = Movie::latest('release_date')->take(5)->get();

        $genres = Genre::get();

        $randomMovies = Movie::inRandomOrder()->limit(3)->get();

        return view('index', compact('movies', 'latestMovies', 'genres', 'randomMovies'));
    }
}
