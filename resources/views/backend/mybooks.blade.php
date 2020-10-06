@extends('layouts.backend')

@section('content')
<h1>Lista moich zamównień</h1>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th>Numer zamównia</th>
            <th>Zamówione ksiązki </th>
			<th>Kwota całkowita</th>
            <th>Status płatności</th>
            <th></th>
            
        </tr>
        @foreach($myorders as $myorder)
        <?php $books = $myorder->books ?> 
            <tr>
                <td>{{ $myorder->id }}</td>
                <td><?= $books?></td>
				<td>{{ $myorder->total_price }} zł</td>
                <td>{{ $myorder->status }}</td>
                <td>
                    @if(($myorder->status)=='nieopłacono')
                    <a href="{{ route('payment',['total_price'=>$myorder->total_price, 'order_id'=>$myorder->id ]) }}" class="btn btn-primary" role="button" >Zapłać</a>
                    @endif
                </td> 
            </tr>
        @endforeach
		
    </table>
</div>


@endsection







