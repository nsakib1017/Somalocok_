<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">		
		<title>Somalocok | Home</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
		<!-- Loading main css file -->
		<link rel="stylesheet" href="css/style.css">
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
                    <div class="mobile-navigation"></div> 
                </div>  
			</header>
			<main class="main-content" style="margin-top:1%">
				<div class="container">
					<div class="page">
						<div class="row">
							<div class="col-md-12">
								<div class="slider">
									<ul class="slides">
										@foreach($movies as $movie)
										<li><a href="{{route('movies.show',['movie'=>$movie->id])}}"><img src="storage/posters/{{$movie->poster}}" alt="Slide 1"></a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div> <!-- .row -->
						<div class="breadcrumbs title" style="letter-spacing:2px" alt="Trailer">
							<h1><B>Top Rated Shows</B></h1>                        
					   </div>
						<div class="row">
							@foreach($tops as $top)
							<div class="col-sm-6 col-md-3">
								<div class="latest-movie">
								<a href="{{route('movies.show',['movie'=>$top->x])}}"><img src="storage/posters/{{$top->y}}" alt="Movie 4"></a>
								</div>
							</div>
							@endforeach
						</div> <!-- .row -->
						<div class="breadcrumbs title" style="letter-spacing:2px" alt="Trailer">
								<h1><B>People also like</B></h1>                        
						   </div>
						<div class="row">
								@foreach($hits as $hit)
								<div class="col-sm-6 col-md-3">
									<div class="latest-movie">
									<a href="{{route('movies.show',['movie'=>$hit->x])}}"><img src="storage/posters/{{$hit->y}}" alt="Movie 4"></a>
									</div>
								</div>
								@endforeach
							</div> <!-- .row -->
					</div>
				</div> <!-- .container -->
            </main>

            <footer class="site-footer"></footer>
		</div>		
	</body>
</html>