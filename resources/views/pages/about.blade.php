<!--DOCTYPE html-->
<html lang="en">
	<head>
		<head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">		
            <title>Somalocok | About</title>
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
                        <h1> About Us </h1>
						</div>

						<div class="row">
							<div class="col-md-4">
								<figure><img src="{{URL::to('images/SUST_Logo.jpg')}}" alt="" class="logo"></figure>
							</div>
							<div class="col-md-8 text-center">
								<p class="leading text-center" style="margin-top:5%">The Somalocok Project</p>
								<p> We, Bengalis, as a tradition, are attracted to a source of entertainment that fits the whole family. Now, the most common types of entertainments that fit the above mentioned conditions are, dramas and telefilms.
                                    Throughout the year during many festive times of the year, many special dramas or telefilms are released. Not just the festival periods but at other times too. We cannot keep track of these releases as we are always busy with our lives. 
                                    We do not even know, which shows to skip and which shows not to miss. </p>
                                <p> If we take a look at IMDb, it provides ratings, reviews, suggestions for different types of movies. They even provide a forum where people can share there thought about a movie they recently or previously watched. 
                                    What if we could create something like IMDb for our dramas or telefilms? Here, people could search through various genres to find the one show they like. They could even rate the shows they watch and follow ratings 
                                    or reviews to make decision what shows to watch. This way they could potentially save a lot of their times. There will also be a forum where people can share their thoughts on these shows. At present there is no such
                                    site that can provide us with such services. So, we have planned to try and make such a website as our project.</p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-11">
								<h2 class="section-title">Vision &amp; Misssion</h2>
								<p>Our vision was to help people find quality bangla shows & movies by providing a database for bangla drama or telefilms and even movies. We hope to achieve our vision by crrying on this project as a personal interest.</p>

								<p>We plan to implement NLP in the backend of the project to categorizing the show. This can be done by implementing the corpus database of IMDB.
                                   If we can achieve that, this site could actually be really helpful in real world experience.
                                </p>
							</div>
						</div> <!-- .row -->
						
						<h2 class="section-title">Our Team</h2>
						<div class="row">

							<div class="col-md-6 col-sm-6">
								<div class="team">
									<figure class="team-image"><img src="dummy/Sakib.jpg" alt=""></figure>
									<h2 class="team-name">Nazmus Sakib</h2>
									<small class="team-title">Co-Creator</small>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="team">
									<figure class="team-image"><img src="dummy/Tapan1.jpg" alt=""></figure>
									<h2 class="team-name">Tapan Basak</h2>
									<small class="team-title">Co-Creator</small>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- .container -->
			</main>
			<footer class="site-footer"></footer>
		</div>
	</body>
</html>