@extends('layouts.backend')

@section('content')

<h1>Lista książek<small><a class="btn btn-success" href="{{ route('addbook') }}" data-type="button"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Dodaj </a></small></h1>

<form method="POST" action="#" class="form-inline">
    <div class="form-group">
         <label class="sr-only" for="title">Tytuł</label>
         <input name="title" value="{{old('title')}}" type="text" class="form-control autocomplete" id="title" placeholder="Tytuł">
     </div>
     <button type="submit" class="btn btn-info">Wyszukaj</button>
     <p></p>
     {{ csrf_field() }}
</form>
@if($books=='[]')
        <p class="red" >Nieznaleziono książki o podanym tytule</p>
@endif
@if($books!='[]')  
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th class="bg-info ">Id</th>
            <th>Tytuł</th>
			<th>Autor</th>
            <th>Edytuj / Usuń </th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td class="bg-info red">{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
				<td>{{ $book->author }}</td>
                <td>
                    <a href="{{ route('savebook',['id'=>$book->id]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
					   
                    <a class="keep_pos" onclick="return confirm('Czy napewno chcesz usunąć tą książkę?');" href="{{ route('deletebook',['id'=>$book->id]) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
                
            </tr>
       @endforeach
    </table>
    
    
</div>
@endif

@endsection







