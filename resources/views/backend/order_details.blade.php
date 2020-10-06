@extends('layouts.backend')

@section('content')
<?php $books = $order->books ?> 
<h2>Zamówienie nr:  {{ $order->id }}</h2>
<div class="table-responsive">
    <table class="table table-hover table-striped">
         <tr>
            <th>Osoba zamawiająca:</th>
            <th>Adres E-mail:</th>
		    <td></td>
        </tr>
         <tr>
            <td>{{ $order->user->Fullname }}</td> 
            <td>{{ $order->user->email}}</td>
		    <td></td>
        </tr>
        <tr>
            <th>Zamówione książki:</th>
            <td></td>
		    <td></td>
        </tr>
       
        <tr>
            <td><?= $books?></td> 
            <td></td>
		    <td></td>
        </tr>
        
		<tr>
            <td><b>Łącznie do zapłaty:</b></td>
		    <td></td>
		    <td></td>
		</tr>
		<tr>
                <td class="red">{{ $order->total_price }} zł</td>
				<td></td>
				<td></td>
		</tr>
        
        <tr>
            <td><b>Status płatności:</b></td>
		    <td></td>
		    <td></td>
		</tr>
		<tr>
                <td>{{ $order->status }}</td>
				<td></td>
				<td></td>
		</tr>
    </table>
</div>


@endsection







