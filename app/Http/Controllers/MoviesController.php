<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Movie;
use App\comment;
use App\FinalRating;
use App\Rating;
use App\Hit;
use App\Genre;
use App\Phpml\Dataset\CsvDataset;
use App\Phpml\Dataset\ArrayDataset;
use App\Phpml\FeatureExtraction\TokenCountVectorizer;
use App\Phpml\Tokenization\WordTokenizer;
use App\Phpml\CrossValidation\StratifiedRandomSplit;
use App\Phpml\FeatureExtraction\TfIdfTransformer;
use App\Phpml\Metric\Accuracy;
use App\Phpml\Classification\NaiveBayes;
use App\Phpml\SupportVectorMachine\Kernel;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }

        return $url;
    }

    public function index(Request $request)
    {

       /* $this->validate($request,[
            'name'=>'required'
        ]);
        $movies=Movie::all();*/

       if(!empty($request->input('name'))){
           $title=$request->input('name');
           $movies=Movie::where('name','like','%'.$title.'%')->paginate(12);
           return view('movies.index')->with('movies',$movies);
       }
       else{
        $movies=Movie::orderBy('created_at','desc')->paginate(12);
        return view('movies.index')->with('movies',$movies);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'poster'=>'required|max:1999',
            'body-sum'=>'required',
            'url'=>'required'
        ]);
        
        $url=$this->YoutubeID($request->input('url'));
        //handle file upload
        if($request->hasFile('poster')){
            //file name with ext
            $fileNameWithExt=$request->file('poster')->getClientOriginalName();
            //just file name
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //just ext
            $ext=$request->file('poster')->getClientOriginalExtension();
            //name to store
            $fileNameToStore=$fileName.'_'.time().'_'.$ext;
            //upload the image
            $path=$request->file('poster')->storeAs('public/posters',$fileNameToStore);
        }
        
        //create post
        $movie=new Movie();
        $genre1=new Genre();
        $mov_id=uniqid();
        $genre1->movie_ID=$mov_id;
        $movie->name=$request->input('title');
        $movie->desc=$request->input('body');
        $movie->plot_summary=$request->input('body-sum');
        $movie->poster=$fileNameToStore;
        $movie->trailer=$url;
        $movie->movie_ID=$mov_id;
        $movie->save();
        $dataset = new CsvDataset('C:\xampp\htdocs\Somalocok_\public\dataSet1.csv', 1);
        $vectorizer = new TokenCountVectorizer(new WordTokenizer());
        $tfIdfTransformer = new TfIdfTransformer();
        $samples = [];
        foreach ($dataset->getSamples() as $sample) {
            $samples[] = $sample[0];
        }
        $vectorizer->fit($samples);
        $vectorizer->transform($samples);
        $tfIdfTransformer->fit($samples);
        $tfIdfTransformer->transform($samples);
        $dataset = new ArrayDataset($samples, $dataset->getTargets());
        $randomSplit = new StratifiedRandomSplit($dataset, 0.3);
        $classifier = new NaiveBayes();
        $classifier->train($randomSplit->getTrainSamples(), $randomSplit->getTrainLabels());
        $predictedLabels = $classifier->predict($randomSplit->getTestSamples());
        $genre1->genre=$predictedLabels[0];
        $genre1->save();
        return redirect(route('admin'))->with('success','Post Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       
            $movie=Movie::find($id)->first();
            $genre1=Genre::where('movie_ID','=',$movie->movie_ID)->first();
            $gen=$genre1->genre;
            $hit=Hit::where('movie_id','=',$id)->first();
            if($hit){
                $hit->hit++;
                $hit->save();
                        }
            else{
            $hit=new Hit();
            $hit->movie_id=$id;
            $hit->hit=1;
            $hit->save();
            }
            
        
        $ratings=FinalRating::where('movie_id','=',$id)->first();
        if($ratings){
            $rating=$ratings->rating;
        }
        else {
            $rating=5;
        }
        return view('movies.show')->with(['movie'=>$movie,'rating'=>$rating,'genre'=>$gen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie=Movie::find($id);
        return view('pages.edit')->with('movie',$movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'body-sum'=>'required',
        ]);
        //handle file upload

        if($request->hasFile('poster')){
            //file name with ext
            $fileNameWithExt=$request->file('poster')->getClientOriginalName();
            //just file name
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //just ext
            $ext=$request->file('poster')->getClientOriginalExtension();
            //name to store
            $fileNameToStore=$fileName.'_'.time().'_'.$ext;
            //upload the image
            $path=$request->file('poster')->storeAs('public/posters',$fileNameToStore);
        }
        //update post
        $movie=Movie::find($id);
        $movie->name=$request->input('title');
        $movie->desc=$request->input('body');
        $movie->plot_summary=$request->input('body-sum');
        if($request->input('url')){
            $url=$this->YoutubeID($request->input('url'));
            $movie->trailer=$url;
        }
        if($request->hasFile('poster')){
        $movie->poster=$fileNameToStore;
        }
        $movie->save();
        return redirect(route('admin'))->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie=Movie::find($id);
        Storage::delete('public/posters/'.$movie->poster);
        $movie->delete();
                    
        $comments=comment::where("movie_id","=",$id);
        if($comments)
            $comments->delete();               
        $ratings=Rating::where("movie_id","=",$id);
        if($ratings)
            $ratings->delete();   
        $finalratings=FinalRating::where("movie_id","=",$id);
        if($finalratings)
            $finalratings->delete();                 
       
        return redirect(route('admin'))->with('success','Post Deleted');
    }

}
