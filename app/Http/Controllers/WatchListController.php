<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WatchListController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax() && !$request->filter) {
            if ($request->search == '') {
                $watchlists = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('watchlist.user_id', $user->user_id)
                    ->get();
                $view = view('watchlists.data', compact('watchlists'))->render();
                return response()->json(['html' => $view]);
            } else {
                $watchlists = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('watchlist.user_id', $user->user_id)
                    ->where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('watchlists.data', compact('watchlists'))->render();
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && $request->filter) {
            if ($request->search == '') {
                if ($request->filter != 'all') {
                    $watchlists = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('watchlist.user_id', $user->user_id)->where('watchlist.status', $request->filter)
                        ->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                } else if ($request->filter == 'all') {
                    $watchlists = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('watchlist.user_id', $user->user_id)->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                }
            } else {
                if ($request->filter == 'all') {
                    $watchlists = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('watchlist.user_id', $user->user_id)->where('show.title', 'LIKE', '%' . $request->search . '%')->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                } else {
                    $watchlists = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('watchlist.user_id', $user->user_id)->where('show.title', 'LIKE', '%' . $request->search . '%')->where('watchlist.status', $request->filter)
                        ->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                }
            }
        }

        $watchlists = Movie::join('watchlist', 'show.show_id', '=', 'watchlist.show_id')->where('watchlist.user_id', $user->user_id)->paginate(4);
        return view('watchlists.index', compact('watchlists'));
    }

    public function store(Movie $movie)
    {
        $this->authorize('addWatchList', $movie);

        $user = Auth::user();
        Watchlist::create([
            'show_id' => $movie->show_id,
            'user_id' => $user->user_id,
            'status' => 'Planning'
        ]);
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('actionWatchList', $movie);

        $user = Auth::user();
        $watchlist = Watchlist::where('user_id', $user->user_id)->where('show_id', $movie->show_id)->delete();
    }

    public function action(Request $request, Movie $movie)
    {
        $this->authorize('actionWatchList', $movie);

        $user = Auth::user();
        if ($request->status == 'planning' || $request->status == 'finished' || $request->status == 'watching') {
            DB::table('watchlist')->where('user_id', $user->user_id)->where('show_id', $movie->show_id)->update([
                'status' => ucfirst($request->status)
            ]);
        } else if ($request->status == 'remove') {
            $watchlist = Watchlist::where('user_id', $user->user_id)->where('show_id', $movie->show_id)->delete();
        }

        return redirect('/watchlist?page=' . $request->page)->with('success-info', 'Watchlist has been updated');
    }
}
