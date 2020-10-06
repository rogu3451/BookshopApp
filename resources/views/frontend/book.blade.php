@extends('layouts.frontend') 

@section('content')
<div class="container-fluid places">

    <h1 class="text-center">{{$book->title}} <br><small>{{$book->author}}</small></h1>
	<div class="col-md-4" >
                        <img class="img-responsive" src="{{$book->photos->first()->path ?? null}}" alt="book-photo">
    </div>
        <h6>Rok wydania: {{ $book->year }} </h6>
        <h6 >Cena:  <span class="red bolded"> {{ $book->price }} </span> <small>ZŁ</small> </h6>
        <h6 class="text-uppercase green">{{ $book->category}} </h6>
        <p>{{$book->description}}</p>
	

    <ul class="nav nav-tabs">
        <li><a href="#opinions" data-toggle="tab" aria-expanded="true">Opinie czytelników </a></li>
        <li><a href="#likes" data-toggle="tab" aria-expanded="true">Lubią tą książkę <span class="badge">{{ $book->users->count() }}</span></a></li>
		 @auth
            @if(!Auth::user()->hasRole(['admin']))
                <p><a href="{{ route('addtobasket',['book_id'=>$book->id]) }}" class="btn btn-primary" role="button" >Dodaj do koszyka</a></p>
            @endif
            @else
                <p><a href="{{ route('login') }}" >Zaloguj się aby dodać do koszyka</a></p>                  
         @endauth
    </ul>
    
    
    @auth
    
         @if($book->isLiked())
            @if(!Auth::user()->hasRole(['admin']))
            <a href="{{ route('unlike',['id'=>$book->id,'type'=>'Book']) }}" class="btn btn-primary btn-xs top-buffer">Odlub tą książkę</a>
            @endif
        @else
            @if(!Auth::user()->hasRole(['admin']))
            <a href="{{ route('like',['id'=>$book->id,'type'=>'Book']) }}" class="btn btn-primary btn-xs top-buffer">Polub tą książkę</a>
            @endif
        @endif
                 
   
    
    @else
    <p><a href="{{ route('login') }}" >Zaloguj się aby polubić tą książkę</a></p>
    
    @endauth
    
    
    <div id="myTabContent" class="tab-content">
 
    <div class="tab-pane fade" id="opinions">

            <section>
        <h2 class="green">Opinie</h2>
                
         @foreach($book->opinions as $opinion)
                
            <div class="media">
                <div class="media-left media-top">
                    <a title="{{$opinion->user->FullName}}" href="{{ route('person',['id'=>$opinion->user->id]) }}">
                       
                        <img class="media-object img-circle" width="50" height="50" src="{{$opinion->user->photos->first()->path}}" alt="BRAK ZDJECIA">
                       
                    </a>
                </div>
                <div class="media-body">
                    {{$opinion->content}}
                        

                    <br>
                    {!!$opinion->rating!!}
                    

                </div>
            </div>
            <hr>
            
        @endforeach
		      
        
        
        
        
     @auth
        @if(!Auth::user()->hasRole(['admin']))  
          <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Dodaj własną opinie
         </a>
        @endif        
    @else
          
    <p><a href="{{ route('login') }}" >Zaloguj się aby dodać opinie</a></p>
     
    @endauth  
                
      </section>
    </div>           
        
    <div class="tab-pane fade" id="likes">
  
        <section>
         <ul class="list-inline">
             @foreach($book->users as $user)
                <li><a href="{{ route('person',['id'=>$user->id]) }}"> <img class="img-circle" height="50px" width="50px" title="{{$user->FullName}}" class="media-object img-responsive" src="{{$user->photos->first()->path}}" alt=".."> </a> </li>
             @endforeach
         </ul>
        </section>

    </div>
        
    </div>

    

    

    
    <div class="collapse" id="collapseExample">
        <div class="well">


            <form method="POST" action="{{ route('addOpinion',['opinionable_id'=>$book->id,'type'=>'Book']) }}" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Komentarz</label>
                        <div class="col-lg-10">
                            <textarea  required name="content" class=" form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block">Dodaj opinie o tej książce!</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Ocena</label>
                        <div class="col-lg-10">
                            <select name="rating" class="form-control" id="select">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Dodaj</button>
                        </div>
                    </div>
                </fieldset>
                {{ csrf_field() }}
            </form>

        </div>
    </div>

   

    
</div>

@endsection
