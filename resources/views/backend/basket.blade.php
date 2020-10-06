@extends('layouts.frontend') 

@section('content')
<?php  $total_price = 0.00; $books = ""; $title = "";  $i=0; ?>
<script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
<script type="text/javascript">
    
    var total_price = [150];
    for(var j = 0; j< 150; j++)
    {
       total_price[j]=0; 
    }
    var first=0;
    var order_info=[]; 
    
   
    function total_price_function(book_price,i,title)
    { 
        
       
        var x = 1 + parseInt($('#count').val());
        
        
        var total_price_all=0;
        if(first < x)
        {
         
        total_price[i] = Math.round((book_price)*100) / 100;
        
        $('.total_price'+i).html(total_price[i]+' ZŁ');
            
           for(var j = 0; j< total_price.length; j++)
                {
                    
                    total_price_all = Math.round((total_price_all + total_price[j])*100)/100 ;
                }
        $('.total_price_all').html(total_price_all+' ZŁ');
          
        
        order_info[i] = i+". "+title+" - "+book_price+"zł - " + 1 +"szt.<br>";
        
            
        first++;
            
        }
        
        
        
        
        
        $('.quantity'+i).on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());
            
            
            
            
         
            total_price[i] = Math.round((value * book_price)*100) / 100;
            $('.total_price'+i).html(total_price[i]+' ZŁ');
            
            
            
            for(var j = 0; j< total_price.length; j++)
                {
                    
                    total_price_all = Math.round((total_price_all + total_price[j])*100)/100 ;
                    
                }
            
            
            $('.total_price_all').html(total_price_all+' ZŁ');
            
             
             $("#total_price").val(total_price_all);
            
            order_info[i] = i+". "+title+" - "+book_price+"zł - " + value +"szt.<br>";
            
            var order_details = order_info.join('')
            $("#books").val(order_details);
            
    	});  
        
        
        
            
            
            
            
            
    	   
    }
</script>
<div class="container-fluid places">
    @if($mybasket == '[]')
    <h1 class="text-center" style="margin-bottom: 380px;">Twój koszyk jest obecnie pusty</h1>
    @endif
    @if($mybasket != '[]')
    <div class="col-md-12 col-sm-12">
        <h1 class="text-center">Twój koszyk </h1>
         <input type="hidden"  value="{{ $mybasket->count() }}" id="count">
     </div>  
     <form method="POST" action="{{ route('addorder',['status'=>'nieopłacono']) }}" enctype="multipart/form-data" class="form-horizontal">

        <div class="row" >
           <div class="col-md-3"></div>
           <div class="col-md-6">
               <table class="table table-hover table-striped" >
                   <tr> 
                        <th>Lp.</th>	<th>Tytuł książki</th> <th>Cena</th> <th>Ilość</th> <th>Razem</th> <th>Usuń</th>
                    </tr>
                     
                   
                    @foreach($mybasket as $mybasket)
                    
                    <tr>
                        <td><?php $i++; ?> <?=$i ?>.</td>	<td>{{ $mybasket->book->title }}</td> 
                        <td>
                        <?php
                            $book_price =$mybasket->book->price;
                            $title = $mybasket->book->title;
                            echo  $book_price." ZŁ";                             
                        ?>
                        </td> 
                        
                         <td>
                             <script type="text/javascript">
                                     window.onload = total_price_function(<?=$book_price?>,<?= $i; ?>,'<?= $title; ?>');
                             </script>
                             
                            <div class="quantity<?= $i; ?>" onClick="total_price_function(<?=$book_price?>,<?= $i; ?>,'<?= $title; ?>')" >
                                <input name="quantity"  value="{{old('quantity')}}"   type="number"  min="1" step="1" value="1" placeholder="1" 
                                       style="width: 40px;" >
                            </div>
                            
                        </td>
                        <td>
                            <div class="total_price<?=$i;?>">
                                
                                
                               
                                <?php
                                
                                    $book_price =$mybasket->book->price;
                                    echo  $book_price." ZŁ";                             
                                ?>
                            </div>
                        </td>
                        <td> 
                            <a class="keep_pos"  href="{{ route('deletebookbasket',['id'=>$mybasket->id]) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                        <?php
                             $books .=  $i .". ".$mybasket->book->title;
                             $books .= ' - '. $mybasket->book->price."zł - 1szt. <br>"; 
                             $total_price = $total_price + $mybasket->book->price;
                            
                        ?>
                     </tr>
                    
                    @endforeach 
                    

               </table>
               <table class="table table-hover table-striped">
                    <tr>
                        <th class="bg-info">Łącznie do zapłaty: </th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info"></th>
                        <th class="bg-info red">
                        <div class="total_price_all">
                            
                        </div>
                        </th>
                        <script type="text/javascript">
                         
                                    window.onload = total_price_function();
                           
                        </script>
                    </tr> 
               </table>
            </div> 
            <div class="col-md-3"></div>
            <div class="col-md-4"></div>
            <div class="col-md-2" >
               @if(session('order_confirm'))
                    <p class="text-center red bolded">{{session('order_confirm')}}</p>
                @endif
            </div>   
            <div class="col-md-1" >
                
                    <fieldset>
                    <input type="hidden" name="books"  value="<?=$books ?>" id="books">
                    <input type="hidden" name="total_price"  value="<?=$total_price ?>" id="total_price">
                    
                        <p><button type="submit" class="btn btn-primary" onclick="return confirm('Czy napewno chcesz zamówić te ksiązki?');" style="margin-bottom: 130px;">Złóż zamówienie</button></p>   
                    
                        </fieldset>
                    
                   
            </div>
            
                <div class="col-md-1" >
                    <p><a href="{{ route('deletebasket') }}"  onclick="return confirm('Czy napewno chcesz usunąć zawartość koszyka?');" class="btn btn-primary" role="button"  >Usuń zawartość koszyka</a></p>
                </div>
            
            <div class="col-md-4"></div>
            @endif
    </div>
    {{csrf_field()}}
</form>

@endsection
