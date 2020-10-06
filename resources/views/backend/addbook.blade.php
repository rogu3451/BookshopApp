@extends('layouts.backend')

@section('content')
<h2>Dodawanie nowej książki </h2>
    @if(session('add_book'))
        <p class="text-center red bolded">{{session('add_book')}}</p>
    @endif
<form method="POST"  action="{{ route('addbook') }}" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <div class="form-group">
            <label for="title" class="col-lg-2 control-label">Tytuł *</label>
            <div class="col-lg-10">
                <input name="title" value="{{old('title')}}" required type="text" class="form-control" id="title" placeholder="Wprowadź tytuł książki">
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="col-lg-2 control-label">Autor *</label>
            <div class="col-lg-10">
                <input name="author" value="{{old('author')}}" required type="text" class="form-control" id="author" placeholder="Wprowadź autora książki">
            </div>
        </div>
        <div class="form-group">
            <label for="year" class="col-lg-2 control-label">Rok wydania *</label>
            <div class="col-lg-10">
                <input name="year" value="{{old('year')}}" required type="number" class="form-control" id="year" placeholder="Podaj rok wydania">
            </div>
        </div>
		 <div class="form-group">
            <label for="price" class="col-lg-2 control-label">Cena (zł) *</label>
            <div class="col-lg-10">
                <input name="price" value="{{old('price')}}" required type="number"  step="0.01" class="form-control" id="price" placeholder="Podaj cenę">
            </div>
        </div>
		<div class="form-group">
            <label for="category" class="col-lg-2 control-label">Kategoria *</label>
            <div class="col-lg-10">
                
                <select name="category"  class="form-control" id="category" placeholder="Wprowadź kategorię książki" 
                        >
                                <option value="Wybierz kategorie">Wybierz kategorie</option>
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
                <textarea name="description"  required class="form-control" rows="3" id="descr" placeholder="Dodaj opis"></textarea>
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

