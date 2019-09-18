<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">		
        <title>Somalocok | Movies</title>
        <!-- Loading third party fonts -->
        <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- Loading main css file -->
        
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/app.css">
        	
        <!-- Load js file -->	
        <script src="{{ asset('js/app1.js') }}" defer></script>	
        <script src="{{ asset('js/jquery-1.11.1.min.js') }}" defer></script>	
        <script src="{{ asset('js/plugins.js') }}" defer></script>	
        <script src="{{ asset('js/app.js') }}" defer></script>	
        <script src="{{ asset('js/app1.js') }}" defer></script>		
	</head>
	<body style="background-color:darkslategrey">
		<div id="site-content">
            <header class="site-header">
                <div class="container">
                    <a href="{{ url('/home') }}" id="branding">
                        <img src="{{URL::to('images/logo@2x.png')}}" alt="" class="logo">
                        <div class="logo-copy">
                            <h1 class="site-title">Somalocok</h1>
                            <small class="site-description">Feeling Bored! Search For a Show</small>
                        </div>
                    </a> <!-- #branding -->  
                
                    <form action="{{route('movies.index')}}" class="search-form pull-right" method="GET" accept-charset="UTF-8">
                            <input type="text" placeholder="Search..." name="name"/>
                            <button><i class="fa fa-search"></i></button>
                    </form>   
                </div>
                    <div class="mobile-navigation"></div>
                
            </header>
           
			<main class="main-content">
				<div class="container">
					<div class="page">
						<div class="breadcrumbs">
							<h1> Shows In Our Database</h1>
                        </div>
                        <div class="movie-list">
                        @if(count($movies)>0)
                             @foreach($movies as $movie)			      
							        <div class="movie">
								        <figure class="movie-poster"><img src="storage/posters/{{$movie->poster}}" alt="#"></figure>
								        <div class="movie-title"><a href="{{route('movies.show',['movie'=>$movie->id])}}">{{$movie->name}}</a></div>
							        </div>                                
                            @endforeach
                        </div> <!-- .movie-list -->
						    <div class="pagination">
                                {{$movies->links()}}
                            </div>
                        @else
                            <div class="jumbotron text-center">
                            <h4>Oops, Nothing to see here.</h4>
                            <p>Try Searching for another show :(</p>
                            </div>
                        @endif
					</div>
				</div> <!-- .container -->
            </main>
            <footer class="site-footer"></footer>
	    </div>       
	</body>
</html>