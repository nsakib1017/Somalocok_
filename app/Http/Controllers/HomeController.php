<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\DB;
use App\FinalRating;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $movies=Movie::all();
        $toprated=DB::table('movies')
                    ->join('final_ratings','final_ratings.movie_id','=','movies.id')
                    ->whereBetween('final_ratings.rating',[4,5])
                    ->select('movies.id as x','movies.poster as y')
                    ->get();
       /* foreach($toprated as $top){
            echo $top->x;
            echo $top->y;
        }*/
        $hits=DB::table('movies')
        ->join('hits','hits.movie_id','=','movies.id')
        ->whereBetween('hits.hit',[3,100])
        ->select('movies.id as x','movies.poster as y')
        ->get();

        return view('home')->with(['movies'=>$movies,'tops'=>$toprated,'hits'=>$hits]);
    }
}
