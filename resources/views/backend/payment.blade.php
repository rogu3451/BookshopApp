@extends('layouts.frontend') 

@section('content')


<div class="container-fluid places">
     <div class="col-md-12 col-sm-12">
        <h1 class="text-center">Dziękujemy za złożenie zamówienia!</h1>
     </div>  
        <div class="row" >
           <div class="col-md-3"></div>
           <div class="col-md-6">

              <h3>Kwota do zapłaty: <span class="red"><?= $total_price?> zł</span> </h3>
               
            </div> 
            <div class="col-md-3"></div>
            

        </div>

        <div class="row" >
           <div class="col-md-3"></div>
           <div class="col-md-6">
               <script src="https://js.stripe.com/v3/"></script>

                <form action="{{ route('charge.payment',['total_price'=>$total_price, 'order_id'=>$order_id]) }}" method="post" id="payment-form">
                      <div class="form-row">
                        <label for="card-element" style="margin-top: 4px; margin-bottom: 50px;">
                          Podaj dane karty kredytowej
                        </label>
                        <div id="card-element">
                          <!-- A Stripe Element will be inserted here. -->
                        </div>
                        @csrf
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                      </div>

                      <button class="btn btn-primary" style="margin-bottom: 108px; margin-top: 50px;" >Zapłać</button>
                </form>
               
            </div> 
            <div class="col-md-3"></div>
            

        </div>
    
   <script>
                     // Create a Stripe client.
            var stripe = Stripe('pk_test_k7FGB8fIznETAJ6Jwn8mILlh00P3aaePRz');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
              base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();

              stripe.createToken(card).then(function(result) {
                if (result.error) {
                  // Inform the user if there was an error.
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;
                } else {
                  // Send the token to your server.
                  stripeTokenHandler(result.token);
                }
              });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var form = document.getElementById('payment-form');
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);

              // Submit the form
              form.submit();
            }
    </script>

@endsection
