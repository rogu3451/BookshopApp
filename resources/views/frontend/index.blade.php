@extends('layouts.frontend') 

@section('content')
<div class="container-fluid places">
    
    @if(session('nobooks'))
    <p class="text-center red bolded">{{session('nobooks')}}</p>
    @endif
    
    <h1 class="text-center">Najnowsze książki</h1>

    @foreach($books->chunk(4) as $chunked_book)

        <div class="row">

              @foreach($chunked_book as $book)

                <div class="col-md-3 col-sm-6">

                    <div class="thumbnail">
                        <img class="img-responsive" src="{{$book->photos->first()->path ?? null}}" alt="okładka książki">
                        <div class="caption">
                            <h3>{{ $book->title }}<small> {{ $book->author }} </small> </h3>
                            <h6>Rok wydania: {{ $book->year }} </h6>
                            <h6 >Cena:  <span class="red bolded"> {{ $book->price }} </span> <small>ZŁ</small> </h6>
                            <h6 class="text-uppercase green">{{ $book->category}} </h6>
                            
                        
                            <p>{{ str_limit($book->description, 100) }}</p>
                            <p><a href="{{ route('book',['id'=>$book->id]) }}" class="btn btn-primary" role="button">Szczegóły</a></p>
                            @auth
                                @if(!Auth::user()->hasRole(['admin']))
                                    <p><a href="{{ route('addtobasket',['book_id'=>$book->id]) }}" class="btn btn-primary" role="button" >Dodaj do koszyka</a></p>
                                @endif
                            @else
                             <p><a href="{{ route('login') }}" >Zaloguj się aby dodać do koszyka</a></p>
                            
                            @endauth
                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    
    @endforeach
    
    <span class="text-center"> {{ $books->links()}} </span>
</div>

@endsection

