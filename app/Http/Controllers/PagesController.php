<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
class PagesController extends Controller
{   
     
    public function cover(){
        return view("pages.welcome");
    }
    public function settings(){
        return view("pages.settings");
    }
    public function admin(){
        if(auth()->user()->id==1){
        $movies=Movie::all();
        return view("pages.admin")->with('movies',$movies);
        }
        else 
        return redirect()->back();
    }
    public function about(){
        return view('pages.about');
    }
    
}
