<!DOCTYPE html>
<html lang="en">
	<head>       
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">		
        <title>Somalocok | {{$movie->name}}</title>
        <!-- Loading third party fonts -->
        <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- Loading main css file -->
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
        
        <!-- Load js file -->
        <script src="{{ asset('js/app1.js') }}" defer></script>	
        <script src="{{ asset('js/jquery-1.11.1.min.js') }}" defer></script>	
        <script src="{{ asset('js/plugins.js') }}" defer></script>	
        <script src="{{ asset('js/app.js') }}" defer></script>
       		
                
	</head>
<body>
    <div id="site-content">
        <header class="site-header">
            <div class="container">
            <a href="{{ url('/home') }}"id="branding">
                    <img src="{{URL::to('images/logo.png')}}" alt="" class="logo">
                    <div class="logo-copy">
                        <h1 class="site-title">Somalocok</h1>
                        <small class="site-description">Feeling Bored! Search for a Show</small>
                    </div>
                </a> <!-- #branding -->
                <div class="main-navigation">
                    <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
                    <ul class="menu">
                        						
                    <li class="menu-item"><a href="{{route('movies.index')}}">Movies</a></li>
                    <li class="menu-item"><a href="{{URL::to('forums')}}">Forum</a></li>
                    <li class="menu-item"><a href="{{route('about')}}">About</a></li>  
                    @if(Auth::user()->id == 1)	                 
                        <li class="menu-item"><a class="nav-link" href="{{ url('\admin') }}">Admin</a></li>
                        @endif
                        <li class="menu-item"><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                        </li>
                    </ul> <!-- .menu -->           
                </div> <!-- .main-navigation -->
                <div class=" mobile-navigation"></div> 
            </div>  
        </header> 
		<main class="main-content">
			<div class="container">
				<div class="page">
					<div class="breadcrumbs">
						<h2> Your Search Result </h2>
					</div>

					<div class="content">
						<div class="row">
								<div class="col-md-6">
									<figure class="movie-poster"><img src="{{ URL::to('/storage/posters/' . $movie->poster) }}" alt="#"></figure>
								</div>
								<div class="col-md-6">
                                <h2 class="movie-title">{{$movie->name}}</h2>
                                <h5 class="movie-summary"><B>Genre: {{$genre}}</B></h5>
									<div class="movie-summary" style="font-style: italic;font-family:cursive;letter-spacing:1px">
										{!!$movie->plot_summary!!}
									</div>
								</div>
							</div> <!-- .row -->
							<div class="entry-content" id="body" style="font-family: cursive;font-size:17px;letter-spacing:1px;margin-bottom:30px">
								{!!$movie->desc!!}
                            </div>
                            
                            <div class="row" style="margin-bottom:40px">
                                    <div class="col-md-12">
                                            <div class="breadcrumbs title" style="margin-top:3%;letter-spacing:2px" alt="Trailer">
                                                    <h1>Trailer</h1>                        
                                               </div>
                                       
                                        <div class="embed-responsive"> 
                                            <iframe height="500px" width="100%" class="embed-responsive-item" src="http://www.youtube.com/embed/{{$movie->trailer}}" frameborder="3" allowfullscreen></iframe>
                                    
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                            <div class="breadcrumbs title" style="margin-top:3%;letter-spacing:2px" alt="Trailer">
                                                <h1>Rating</h1>                        
                                            </div>
                                        
                                        <div class="col-md-12">
                                            <div class="progress" style="margin-bottom:10px">
                                            <div title="{{$rating}} out of 5"class="row progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$rating/5*100}}%; padding-top:10px" aria-valuenow="{{$rating}}" aria-valuemin="0" aria-valuemax="5">{{$rating}} out of 5</div>
                                            </div>
                                            <br>
                                                <div id="rate" style="display:none;margin-bottom:30px">
                                                {!!Form::open(['action'=>['RatingController@store'],'method'=>'POST'])!!}
                                                {{Form::text('rating','',['placeholder'=>'Rate it','style'=>'height: 20%;width:25%'])}}
                                                {{Form::hidden('post_id',$movie->id)}}
                                                {!!Form::close()!!}
                                                </div>
                                                    <a href="javascript:void(0);" id="rbtn" onclick="myFunction1()" style="margin-bottom:3%;font-size: 20px;font-family:cursive">Rate it..</a>
                                                    <a href="javascript:void(0);" id="nbtn" onclick="myFunction1()" style="margin-bottom:3%;font-size: 20px;font-family:cursive;display:none">Don't rate..</a>               
                                        </div>
                            </div>
                            
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="breadcrumbs title" style="margin-top:3%;letter-spacing:2px" alt="Trailer">
                                         <h1><B>Comments</B></h1>                        
                                    </div>
                                    <div class="col-md-12 col-sm-12" id="myDIV" style="marign-top:30px;margin-bottom:30px;padding:40px;display:none" >   
                                        <div style="margin-bottom:3%;border-radius:20px">
                                            @if(count($movie->comments)>0)
                                                @foreach ($movie->comments as $comment) 
                                                    <div class="col-md-12 col-sm-12" style="margin: 5px; padding: 5px; background-color:ghostwhite">  
                                                            <div class="row col-md-12 col-sm-12" style="margin-bottom:20px">
                                                        <div class="fa fa-comments" style="padding:5px;color:darkcyan;letter-spacing:2px">  </div>                             
                                                            <B style="font-size: 18px;letter-spacing: 2px;font-family: cursive">{{$comment->user_name}}</B>  <B style="letter-spacing: 2px;font-family: cursive">Posted at {{$comment->created_at}} </B>   
                                                            </div>
                                                            <div class="col-md-8 col-sm-4 embed-responsive" style="margin-bottom:5px">
                                                           <p class="embed-responsive-item" style="font-family: cursive;letter-spacing:2px"> {{$comment->comment}} </p>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            @endif
                                            
                                        </div>  
                                            
                                        </div>  
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:30px">
                                        <a href="javascript:void(0);" id="show" onclick="myFunction()" style="margin-bottom:3%;font-size: 20px;font-family:cursive">Show Comments..</a>
                                        <a href="javascript:void(0);" id="hide" onclick="myFunction()" style="margin-bottom:3%;display:none;font-size: 20px;font-family:cursive">Hide Comments</a>
                                    </div>
                                    <div class="col-md-12"style="letter-spacing:2px;font-family:cursive">  
                                            <h2>Share your thoughts</h2>
                                        </div>
                                        <div class="col-md-12">
                                            {!!Form::open(['action'=>['CommentsController@store'],'method'=>'POST'])!!}
                                            {{Form::textArea('comment','',['placeholder'=>'Write A comment','style'=>'height: 60px;width:100%;font-family:cursive'])}}
                                            {{Form::hidden('post_id',$movie->id)}}
                                            {{Form::submit('Comment',['class'=>'button form-control','style'=>'margin-top:9px'])}}                                
                                            {!!Form::close()!!}
                                        </div>
                                </div>
                                
                            </div>
                    </div>
				</div>
            </div>
             <!-- .container -->             
		    </main>
		    <footer class="site-footer"></footer>
        </div>	
        <script>
            function myFunction() {
                 var x = document.getElementById("myDIV");
                 var y=document.getElementById("show");
                 var z=document.getElementById("hide");
                if (x.style.display === "none") {
                     x.style.display = "block";
                     y.style.display="none"
                    z.style.display="block";


                   
                } else {
                x.style.display = "none";
                y.style.display="block";
                z.style.display="none";
                }
            }
        
        
        </script>
        <script>
                 function myFunction1() {
                 var x = document.getElementById("rate");
                 var y=document.getElementById("rbtn");
                 var z=document.getElementById("nbtn");
                if (x.style.display === "none") {
                     x.style.display = "block";
                     y.style.display="none"
                    z.style.display="block";


                   
                } else {
                x.style.display = "none";
                y.style.display="block";
                z.style.display="none";
                }
            }
        
            
            </script>
	</body>
</html>

<!-- -->