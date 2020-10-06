@extends('layouts.backend')

@section('content')
<h1>Zamówienia<small></small></h1>
<form method="POST" action="{{ route('findorder') }}" class="form-inline">
    <div class="form-group">
         <label class="sr-only" for="id">id</label>
         <input name="id" value="{{old('id')}}" type="text" class="form-control autocomplete" id="id" placeholder="Id">
     </div>
     <button type="submit" class="btn btn-info">Wyszukaj</button>
     <p></p>
     {{ csrf_field() }}
</form>  


<div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th class="bg-info">Id </th>
            <th>Imię</th>
            <th>Nazwisko</th>
			<th>Email</th>
            <th>Łącznie do zapłaty</th>
            <th>Status płatności</th>
            <th>Szczegóły / Usuń </th>
        </tr>
         @foreach($orders as $order)
            <tr>
                <td class="bg-info red">{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->surname }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ $order->total_price }} zł</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('order_details',['id'=>$order->id]) }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
					   
                    <a onclick="return confirm('Czy napewno chcesz usunąć te zamówienie?');" href="{{ route('deleteorder',['id'=>$order->id]) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </tr>
         @endforeach
		
    </table>
    <span class="text-center"> {{ $orders->links()}} </span>
</div>


@endsection







