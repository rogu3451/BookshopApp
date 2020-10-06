<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Twojaksiegarnia\Interfaces\BackendRepositoryInterface;
use App\Twojaksiegarnia\Gateways\BackendGateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BackendController extends Controller
{
    
    
    
    public function __construct(BackendRepositoryInterface $bR, BackendGateway $bG)
    {
        $this->middleware('CheckUser')->only(['index','savebook','deletebook','orders','order_details','addbook']);
        
        $this->bR = $bR;
        $this->bG = $bG;
    }
    
    
    
    
    public function index()
    {
        $books = $this->bR->getBooksForMainPage();
        return view('backend.index',['books' => $books]);
    }
    
    
    
    public function orders()
    {
        $orders = $this->bR->getAllOrders();
        return view('backend.orders',['orders' => $orders]);
    }
    
    
    
    public function mybooks(Request $request)
    { 
        $myorders = $this->bR->myOrders($request);
        $mybasket = $this->bR->myBasket($request);
        return view('backend.mybooks',['myorders' => $myorders,'mybasket' => $mybasket]);
    }
    
    public function addtobasket($book_id, Request $request)
    {
        
        $this->bR->addtobasket($book_id, $request);
        
        return redirect()->back();
    }
    
    public function addorder($status, Request $request)
    {  
        
        if($request->isMethod('post'))
        {
        $total_price = $request->input('total_price');
        $order_id = $this->bR->addorder($status,$request);
        }
        $mybasket = $this->bR->myBasket($request);
        return view('backend.payment',['mybasket' => $mybasket, 'total_price'=>$total_price, 'order_id'=> $order_id]);
    }
    
    
    public function payment($total_price,$order_id, Request $request)
    {
        $mybasket = $this->bR->myBasket($request);
        return view('backend.payment',['mybasket' => $mybasket, 'total_price'=>$total_price, 'order_id'=>$order_id]);
    }
    
    public function chargepayment($total_price, $order_id, Request $request)
    {
       $Fullname = $request->user()->FullName;
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_b1dkN5lWkvtxqm6F50jOzQlz00kLH3GaJ7');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $total_price*100,
            'currency' => 'pln',
            'description' => 'Twoja księgarnia, '.$Fullname,
            'source' => $token,
        ]);
        
        
        $this->bR->changeOrderStatus($order_id);
        
        return redirect('/')->with('nobooks','Twoje zamówienie zostało opłacone. Dziękujemy!');
    }
    
    public function deletebasket(Request $request)
    {
        $this->bR->deletebasket($request);
        
        return redirect()->back();
    }
    
    
    
    public function profile(Request $request)
    {
        
        
        if($request->isMethod('post'))
        {
            $user = $this->bG->saveUser($request);
            
            if($request->hasFile('userPicture')) // spradzenie czy obrazek zostal dodany
            {
                $path = $request->file('userPicture')->store('users','public'); // upload obrazka uzytkownika

                if(count($user->photos)!=0) // jesli uzytkownik ma juz foto nalezy je update'owac
                {
                    $photo = $this->bR->getPhoto($user->photos->first()->id);
                    
                    Storage::disk('public')->delete($photo->storagepath);
                    
                    $photo->path = $path;
                    
                    $this->bR->updateUserPhoto($user,$photo);
                }
                else // jesli nie to stworzyc
                {
                    $this->bR->createUserPhoto($user,$path);
                }
                
            }
            return redirect()->back();
        }
        
        $mybasket = $this->bR->myBasket($request);
        return view('backend.profile',['user' =>Auth::user(),'mybasket' => $mybasket]);
    }
    
    public function basket(Request $request)
    {
        $mybasket = $this->bR->myBasket($request);
        return view('backend.basket',['mybasket' => $mybasket]);
    }
    
    
   
    public function  deletebookbasket($id, Request $request)
    {
        $book = $this->bR->deletebookbasket($id, $request);
 
        return redirect()->back();
    }
    
    
    public function savebook($id, Request $request)
    {
        
        if($request->isMethod('post'))
        {
            
            $book = $this->bG->saveBook($id, $request);
            
             if($request->hasFile('bookPicture')) // spradzenie czy obrazek zostal dodany
             {
                $path = $request->file('bookPicture')->store('books','public'); // upload obrazka ksiazki

                if(count($book->photos)!=0) // jesli ksiazka ma juz foto
                {
                    
                    $photo = $this->bR->getPhoto($book->photos->first()->id);
                    
                    Storage::disk('public')->delete($photo->storagepath);
                    
                    $photo->path = $path;
                    
                    $this->bR->updateBookPhoto($book,$photo);
                }
                else // jesli nie to stworzyc
                {
                    $this->bR->createBookPhoto($book,$path);
                }
                
             }
            
            return redirect()->back()->with('edit_book','Książka została edytowana');
        }
        
        $book = $this->bR->getBook($id);
        return view('backend.savebook',['book' => $book]);
    }
    
    
    
    
    
    public function addbook(Request $request)
    {
        if($request->isMethod('post'))
        {
            
            $book = $this->bG->addBook($request);
             
            if($request->hasFile('bookPicture')) // spradzenie czy obrazek zostal dodany
             {
                $path = $request->file('bookPicture')->store('books','public'); // upload obrazka ksiazki

                if(count($book->photos)!=0) // jesli ksiazka ma juz foto
                {
                    
                    $photo = $this->bR->getPhoto($book->photos->first()->id);
                    
                    Storage::disk('public')->delete($photo->storagepath);
                    
                    $photo->path = $path;
                    
                    $this->bR->updateBookPhoto($book,$photo);
                }
                else // jesli nie to stworzyc
                {
                    $this->bR->createBookPhoto($book,$path);
                }
             }
             
            
            return redirect()->back()->with('add_book','Książka została dodana');
        }
        return view('backend.addbook');
    }
    
    
    
    
    
    
    
    public function deletePhoto($id)
    {
        
        $photo = $this->bR->getPhoto($id);
        
        if($photo->photoable_type == 'App\User')
        {
        $this->authorize('checkOwner',$photo);
        }

        $path = $this->bR->deletePhoto($photo);
        
        Storage::disk('public')->delete($path);
        
        return redirect()->back();
    }
    
    
    public function deletebook($id)
    {
        $book = $this->bR->deleteBook($id);
        
        if(count($book->photos)!=0) // jesli ksiazka do usuniecia ma zdjecie
                {
                    
                    $photo = $this->bR->getPhoto($book->photos->first()->id);
                    
                    Storage::disk('public')->delete($photo->storagepath);

                }
        
        return redirect()->back()->with('delete_book','Książka została usunięta');
    }
    
    public function findorder(Request $request) 
    {
        
        if($orders = $this->bR->getSearchResults($request))
        {
            //dd($title);
            return view('backend.findorder',['orders'=>$orders]);  
        }
        else
        {
           // if(!$request->ajax())
            return redirect('/admin/orders'); 
        }
       
    } 
    
    
    public function deleteorder($id)
    {
        $order = $this->bR->deleteOrder($id);

        return redirect()->back();
    
    }
    
	public function order_details($id)
    {
        $order = $this->bR->getOrder($id);
        return view('backend.order_details',['order' => $order]);
    }
	
    public function saveroom()
    {
        return view('backend.saveroom');
    }
    
   
    
}
