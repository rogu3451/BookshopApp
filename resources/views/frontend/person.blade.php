@extends('layouts.frontend') 

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-xs-12 col-sm-1"></div>
                            <div class="col-xs-12 col-sm-3">
                                <img src="{{ $user->photos->first()->path }}" alt="" class="img-circle img-responsive">
                            </div>
                            <div class="col-xs-12 col-sm-8">
                                <h2>{{ $user->FullName }}</h2>

                            </div>
                        </div>
                        
                        <div class="col-sm-12 pagination"> </div>
                        
                        <div class="col-xs-12 col-sm-6 ">
                            
                             <button href="#likes" data-toggle="tab" aria-expanded="true" class="btn  btn-primary btn-block"><span class="fa fa-plus-circle"></span> {{ $user->books->count()  }}  Polubionych książek </button>
                        </div>
                        <div class="col-sm-6">
                            <button href="#opinions" data-toggle="tab" aria-expanded="true" type="button" class="btn  btn-success btn-block"><span class="fa fa-gear"></span> {{ $user->opinions->count() }} Dodanych opini </button>
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 tab-pane fade" id="likes">

                            
                            <ul class="list-group">
                                
                                @foreach( $user->books as $book ) 
                                <li class="list-group-item">                              
                                    <a href="{{ route('book',['id'=>$book->id]) }}">  {{ $book->title }}</a>

                                </li>
                                @endforeach 

                            </ul>
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 tab-pane fade" id="opinions">
                            
                            <ul class="list-group">
                                
                                @foreach( $user->opinions as $opinion ) 
                                <li class="list-group-item">
                                    
                                    {{ $opinion->content }} 
                                    
                                    <br>
                                    {!!$opinion->rating!!}
                                    <a href="{{ route('book',['id'=>$opinion->book_id]) }}"> Przejdź do tej książki</a>
                                    
                                    
                                </li>
                                @endforeach 

                            </ul>
                        </div>
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection





