<?php


//ROUTY PUBLICZNE

Route::get('/','FrontendController@index')->name('home');
Route::get(trans('routes.book').'/{id}','FrontendController@book')->name('book');
Route::get(trans('routes.person').'/{id}','FrontendController@person')->name('person');
Route::match(['GET','POST'],trans('routes.booksearch'),'FrontendController@booksearch')->name('booksearch'); // dla frontendu
Route::match(['GET','POST'],trans('routes.findbook'),'FrontendController@findbook')->name('findbook'); // dla backendu
Route::get(trans('routes.promotion'),'FrontendController@promotion')->name('promotion');
Route::get(trans('routes.bestseller'),'FrontendController@bestseller')->name('bestseller');
Route::get(trans('routes.reading'),'FrontendController@reading')->name('reading');
Route::get(trans('routes.informatics'),'FrontendController@informatics')->name('informatics');
Route::get(trans('routes.history'),'FrontendController@history')->name('history');
Route::get(trans('routes.fantasy'),'FrontendController@fantasy')->name('fantasy');
Route::get('/like/{likeable_id}/{type}', 'FrontendController@like')->name('like'); 
Route::get('/unlike/{likeable_id}/{type}', 'FrontendController@unlike')->name('unlike');
Route::post('/addOpinion/{opinionable_id}/{type}', 'FrontendController@addOpinion')->name('addOpinion'); 
Route::get(trans('/searchTitles'),'FrontendController@serachTitles');


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){ // dopisanie prefiksu do panelu admina lub czytelnika
    
    // ROUTY ADMINA
    Route::match(['GET','POST'],trans('routes.savebook').'/{id}','BackendController@savebook')->name('savebook');
    Route::match(['GET','POST'],trans('routes.addbook'),'BackendController@addbook')->name('addbook');
    Route::get('/orders','BackendController@orders')->name('orders.index');
    Route::get(trans('routes.order_details').'/{id}','BackendController@order_details')->name('order_details');// dla admina szczegoly zamowienia
    Route::get(trans('routes.deletebook').'/{id}','BackendController@deletebook')->name('deletebook');
    Route::get(trans('routes.deletebookbasket').'/{id}','BackendController@deletebookbasket')->name('deletebookbasket');
    Route::get(trans('routes.deleteorder').'/{id}','BackendController@deleteorder')->name('deleteorder');
    Route::match(['GET','POST'],trans('routes.findorder'),'BackendController@findorder')->name('findorder'); 
    Route::get('/','BackendController@index')->name('adminHome'); // dla admina wszystkie ksiazki z bazy
    
    // ROUTY READERA
    Route::get(trans('routes.mybooks'),'BackendController@mybooks')->name('mybooks'); // dla uzytkownika jego zamowienia
    Route::get(trans('routes.basket'),'BackendController@basket')->name('basket');
    Route::get('/addtobasket/{book_id}', 'BackendController@addtobasket')->name('addtobasket');
    Route::post('/addorder/{status}', 'BackendController@addorder')->name('addorder');
    Route::match(['GET','POST'],trans('routes.payment').'/{total_price}/{order_id}','BackendController@payment')->name('payment');
    Route::post('/charge-payment/{total_price}/{order_id}', 'BackendController@chargePayment')->name('charge.payment');
    Route::match(['GET','POST'],trans('/deletebasket'), 'BackendController@deletebasket')->name('deletebasket');
   
  
    // ROUTY WSPOLNE
    Route::get('/deletePhoto/{id}','BackendController@deletePhoto')->name('deletePhoto');
    Route::match(['GET','POST'],trans('routes.profile'),'BackendController@profile')->name('profile');
    
    
});


Auth::routes(); // wiersz odpowiedzialny za routy logowania rejestracji i odzyskiwania hasla

Route::match(['GET','POST'],'login/github/', 'Auth\LoginController@redirectToProvider')->name('github');
Route::match(['GET','POST'],'login/github/callback/{id}', 'Auth\LoginController@handleProviderCallback');

Route::match(['GET','POST'],'login/facebook/', 'Auth\LoginController@redirectToProvider')->name('facebook');
Route::match(['GET','POST'],'login/facebook/callback/{id}', 'Auth\LoginController@handleProviderCallback');
