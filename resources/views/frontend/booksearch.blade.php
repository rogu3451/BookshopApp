@extends('layouts.frontend') 

@section('content')
<div class="container-fluid places">
    @if($title=='[]')
        <h1 class="text-center" style="margin-bottom: 380px;">Nieznaleziono książki o podanym tytule</h1>
    @endif
    @if($title!='[]')
    <div class="col-md-3 col-sm-6">
         
    
            
    <h1 class="text-center">Znaleziona książka:</h1>
        </div>
    

        <div class="row">
            
            @foreach($title as $title)
                <div class="col-md-3 col-sm-6"> </div>
                 <div class="col-md-3 col-sm-6">

                    <div class="thumbnail">
                        
                    <div class="caption">
                        
                         <img class="img-responsive" src="{{$title->photos->first()->path ?? null}}" alt="okładka książki">
                        <h3>{{ $title->title }}<small> {{ $title->author }} </small> </h3>
                        <h6>Rok wydania: {{ $title->year }} </h6>
                        <h6 >Cena:  <span class="red bolded"> {{ $title->price }} </span> <small>ZŁ</small> </h6>
                        <h6 class="text-uppercase green">{{ $title->category}} </h6>
                            
                        <p>{{ str_limit($title->description, 100) }}</p>
                        <p><a href="{{ route('book',['id'=>$title->id]) }}" class="btn btn-primary" role="button">Szczegóły</a></p>
				        
                    </div>
                </div>


           @endforeach


        </div>

</div>
    @endif


@endsection
