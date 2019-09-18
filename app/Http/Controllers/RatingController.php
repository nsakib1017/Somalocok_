<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\Movie;
use App\FinalRating;

class RatingController extends Controller
{
   

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request,[
                'rating'=>'required'
        ]);

        if($request->input('rating')>5)
            return redirect()->back();

        $user_id=auth()->user()->id;
        $post_id=$request->input('post_id');
        $previousrating=Rating::where('user_id','=',$user_id)
                              ->where('movie_id','=',$post_id)
                              ->first();
        if(!$previousrating){
           $newrating=new Rating();
           $newrating->user_id=$user_id;
           $newrating->movie_id=$post_id;
           $newrating->ratings=$request->input('rating');
           $newrating->save();
        }
        else{
            
            $id=$previousrating->id;
            $updaterating=Rating::find($id);
            $updaterating->ratings=$request->input('rating');
            $updaterating->save();
        }
        $ratings=Rating::where('movie_id','=',$post_id)->get();
        $movie=Movie::find($post_id);
        $summed_rating=$movie->ratings->sum('ratings');
        $people=count($ratings);
        $rating=$summed_rating/$people;
        //add to final rating
        $finalrating=FinalRating::where('movie_id','=',$post_id)->first();
        if($finalrating){
            $finalrating->rating=$rating;
            $finalrating->save();
        }else{
        $finalrating=new FinalRating();
        $finalrating->movie_id=$post_id;
        $finalrating->rating=$rating;
        $finalrating->save();
        }
        return redirect(route('movies.show',['movie'=>$post_id]));
            
    }

}
