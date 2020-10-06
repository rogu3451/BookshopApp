
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>Twoja księgarnia!</title>

        
        <link rel="stylesheet" href="https://bootswatch.com/3/readable/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
        <script>
            
            var base_url = '{{ url('/')}}';
            
         $(function () {
			$(".autocomplete").autocomplete({
				source: base_url + "/searchTitles",
				minLength: 2,
				select: function (event, ui) {
					
			 //    console.log(ui.item.value);
				}


			});
		});

        </script>
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}"> <img class="img-responsive center-block" style="float: left;" src="{{ asset('images/logo.png') }}" alt="">Twoja księgarnia</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    @auth
                    <ul class="nav navbar-nav">
                        <li><p class="navbar-text">Zalogowano jako:</p></li>
                        <li><p class="navbar-text">{{ Auth::user()->name }}</p></li>
                        @if(Auth::user()->hasRole(['admin']))
                            <li><a href="{{ route('adminHome') }}">Panel Administratora</a></li>
                        @else
                            <li><a href="{{ route('adminHome') }}">Panel Czytelnika</a></li>
                            
                        
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Wyloguj się
                                 
                            </a>
                                    <form id="logout-form" action=" {{ route('logout') }} " method="POST" style="display: none;">
                                        
                                        @csrf
                                    </form>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" aria-haspopup="true"> Kategorie </a>
							<div class="dropdown-menu" aria-labelledby="submenu">
                                <a class="dropdown-item navbar-text" href="{{ route('promotion') }}">Promocje</a>
								<a class="dropdown-item navbar-text" href="{{ route('bestseller') }}">Bestsellery</a>
								<a class="dropdown-item navbar-text" href="{{ route('reading') }}">Lektury</a><br>
								<a class="dropdown-item navbar-text" href="{{ route('informatics') }}">Informatyka</a><br>
								<a class="dropdown-item navbar-text" href="{{ route('history') }}">Historia</a><br>
								<a class="dropdown-item navbar-text" href="{{ route('fantasy') }}">Fantastyka</a>
								
							</div>
                            
				     	</li>
                        @if(!Auth::user()->hasRole(['admin']))
                            <a class="navbar-brand" href="{{ route('basket') }}"> <img class="img-responsive center-block" style="float: left;" src="{{ asset('images/basket.png') }}" alt="">
                                @if( $bcounter = $mybasket->where('user_id',Auth::user()->id)->count())
                                    <span class="badge">{{ $bcounter  }}</span></a>  
                                @else
                                    <span class="badge hidden">0</span></a>  
                                @endif
                        @endif
                    </ul>
                    
                    @endauth
                    @guest
                    <ul class="nav navbar-nav navbar-right">
						<li><a href="{{ route('promotion') }}">Promocje</a></li>
						<li><a href="{{ route('bestseller') }}">Bestsellery</a></li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" aria-haspopup="true"> Kategorie </a>
							<div class="dropdown-menu" aria-labelledby="submenu">
								<a class="dropdown-item navbar-text" href="{{ route('reading') }}">Lektury</a><br>
								<a class="dropdown-item navbar-text" href="{{ route('informatics') }}">Informatyka</a><br>
								<a class="dropdown-item navbar-text" href="{{ route('history') }}">Historia</a><br>
								<a class="dropdown-item navbar-text" href="{{ route('fantasy') }}">Fantastyka</a>
							</div>
				     	</li>
						<li><a href="{{ route('login') }}">Zaloguj się</a></li>
                        <li><a href="{{ route('register') }}">Zarejestruj się</a></li>
                    </ul>
                    @endguest
                    
                </div> <!--/.nav-collapse -->
            </div>
        </nav>

        <div class="jumbotron">
            <div class="container">
                <h1>Znajdź książkę dla siebie!</h1>
                <p>Aplikacja webowa twoja księgarnia powstała z myślą o Tobie i twoich zainteresowaniach!</p>
                <p>W naszym serwisie napewno odnajdziesz to czego szukasz!</p>
                <form method="POST" action="{{ route('booksearch') }}" class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="title">Tytuł</label>
                        <input name="title" value="{{old('title')}}" type="text" class="form-control autocomplete" id="title" placeholder="Tytuł">
						<!--<input name="autor" type="text" class="form-control autocomplete" id="author" placeholder="Autor">
						<input name="rok_wydania" type="text" class="form-control autocomplete" id="year" placeholder="Rok wydania">-->
                    </div>
                   
                    <button type="submit" class="btn btn-warning">Wyszukaj</button>
                    {{ csrf_field() }}
                </form>

            </div>
        </div>

        @yield('content')

        <div class="container-fluid bg-info">

           

            <footer>

                <p class="text-center">&copy; 2019 Twoja księgarnia | Realizacja: K.Rogoziński</p>

            </footer>

        </div>

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>


