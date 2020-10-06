@extends('layouts.backend')

@section('content')
<h2>Edycja książki </h2> 

    @if(session('edit_book'))
    <p class="text-center red bolded">{{session('edit_book')}}</p>
    @endif
    
<form method="POST" action="{{ route('savebook',['id'=>$book->id]) }}" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <div class="form-group">
            <label for="title" class="col-lg-2 control-label">Tytuł *</label>
            <div class="col-lg-10">
                <input name="title" required type="text" class="form-control" id="title" placeholder="Wprowadź tytuł książki" value="{{$book->title}}">
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="col-lg-2 control-label">Autor *</label>
            <div class="col-lg-10">
                <input name="author" required type="text" class="form-control" id="author" placeholder="Wprowadź autora książki" value="{{$book->author}}">
            </div>
        </div>
        <div class="form-group">
            <label for="year" class="col-lg-2 control-label">Rok wydania *</label>
            <div class="col-lg-10">
                <input name="year" required type="number"  class="form-control" id="year" placeholder="Podaj rok wydania" value="{{$book->year}}">
            </div>
        </div>
		 <div class="form-group">
            <label for="price" class="col-lg-2 control-label">Cena (zł) *</label>
            <div class="col-lg-10">
                <input name="price" required type="number" step="0.01" class="form-control" id="price" placeholder="Podaj cenę" value="{{$book->price}}">
            </div>
        </div>
		<div class="form-group">
            <label for="category" class="col-lg-2 control-label">Kategoria *</label>
            <div class="col-lg-10">
                
                <select name="category" class="form-control" id="category" placeholder="Wprowadź kategorię książki" 
                        >
                                <option value="{{$book->category}}">{{$book->category}} - Wybrana kategoria</option>
                                <option value="Historia">Historia</option>
                                <option value="Fantastyka">Fantastyka</option>
                                <option value="Promocja">Promocja</option>
                                <option value="Bestseller">Bestseller</option>
                                <option value="Lektura">Lektura</option>
                                <option value="Informatyka">Informatyka</option>
                            </select>
            </div>
        </div>
        <div class="form-group">
            <label for="descr" class="col-lg-2 control-label">Opis *</label>
            <div class="col-lg-10">
                <textarea rows="6"  name="description" required class="form-control" rows="3" id="description" placeholder="Dodaj opis">
                {{$book->description}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <label for="bookPicture">Dodaj zdjęcie okładki<br><p class="red">Wymiary: 300<small> x</small> 400</p></label>
                <input name="bookPicture" type="file" id="bookPicture">
            </div>
        </div>

        <div class="col-lg-10 col-lg-offset-2">

           

                <div class="row">


                   
                     @if( $book->photos()->first() )
                        <div class="col-md-3 col-sm-6">
                            <div class="thumbnail">
                                <img class="img-responsive" src="{{$book->photos()->first()->path}}" alt="...">
                                <div class="caption">
                                    <p><a href="{{ route('deletePhoto',['id'=>$book->photos()->first()->id]) }}" class="btn btn-primary btn-xs" role="button">Usuń</a></p>
                                </div>

                            </div>
                        </div>
                     @endif
                    

                </div>


            

        </div>

       

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Zapisz</button>
            </div>
        </div>

    </fieldset>
    {{csrf_field()}}
</form>



@endsection

