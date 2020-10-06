<?php


namespace App\Twojaksiegarnia\Repositories; 
use Illuminate\Http\Request;
use App\Twojaksiegarnia\Interfaces\BackendRepositoryInterface;  
use App\{Book,User,Photo,Order,Basket};


class BackendRepository implements BackendRepositoryInterface  {   
    
    
    public function changeOrderStatus($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 'opłacono';
        $order->save();
    }
    
    public function getBooksForMainPage()
    {
        return Book::with(['photos'])->orderedDescending()->paginate(16);
    }
    
    public function getOrder($id)
    {
        return Order::with(['user'])->find($id); 
    } 
    
    public function myOrders($request)
    {  
        return Order::all()->where('user_id',$request->user()->id);
    }
    
    public function myBasket($request)
    {  
        $user_id = $request->user()->id;
        $results = Basket::orderBy('id')->where('user_id',$user_id)->get();
        return $results;
    }
    
    public function addtobasket($book_id, $request)
    {
        $basket = new Basket;
        $user_id = $request->user()->id;
        $check_if_exist = Basket::where('user_id',$user_id)->where('book_id',$book_id)->get();
        
        if($check_if_exist =="[]")
        {
             $basket->user_id = $request->user()->id;
             $basket->book_id = $book_id;
             $basket->save();
        }
        
       
    }
    
    public function addorder($status,$request)
    {
        $total_price = $request->input('total_price');
        
        $order = new Order;
        
        $order->user_id = $request->user()->id;
        $order->books = $request->input('books');
        $order->total_price = $request->input('total_price');
        $order->status = $status;
        $order->save();
        
        $order_id = $order->id;
       
        $user_id = $request->user()->id;
        Basket::whereNotNull('id')->where('user_id',$user_id)->delete();
        
        return $order_id;
        
    }
    
    public function getSearchResults($request)
    {
        $id = $request->input('id');
        return Order::where('id',$id)->get() ?? false;
    }
    
    public function deletebasket($request)
    {
        $user_id = $request->user()->id;
        Basket::whereNotNull('id')->where('user_id',$user_id)->delete();
    }
    
    
    public function getAllOrders()
    {
        return Order::with(['user'])->orderedDescending()->paginate(16);
    }
    
    public function saveUser($request)
    {
        $user = User::find($request->user()->id);
        
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->save();

        return $user;
    }
    
    public function saveBook($id, $request) 
    {
        
        $book = Book::find($id);
        
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->year = $request->input('year');
        $book->price = $request->input('price');
        $book->category = $request->input('category');
        $book->description = $request->input('description');
        
        $book->save();

        return $book;
        
    }
    
    public function deleteBook($id) 
    {
        
        $book_to_delete = Book::find($id);
        $book_tmp = Book::find($id);
        $book_to_delete->delete();

        return $book_tmp;
    }
    
    
    public function deleteOrder($id) 
    {
        
        $order = Order::find($id);
        $order->delete();
    }
    
    public function deletebookbasket($id,$request) 
    {
        $user_id = $request->user()->id;
        $book = Basket::where('user_id',$user_id)->where('id',$id)->delete();
       
    }
     
    public function addBook($request) 
    {
        
        $book = new Book;
        
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->year = $request->input('year');
        $book->price = $request->input('price');
        $book->category = $request->input('category');
        $book->description = $request->input('description');
        
        $book->save();

        return $book;
        
    }
    
    public function getPhoto($id)
    {
        return Photo::find($id);
    }
    
    public function updateUserPhoto($user,$photo)
    {
        return $user->photos()->save($photo);
    }
    
    public function updateBookPhoto($book,$photo)
    {
        return $book->photos()->save($photo);
    }
  
    public function createUserPhoto($user,$path)
    {
        $photo = new Photo;
        $photo->path = $path;
        return $user->photos()->save($photo);
    }
    
    public function createBookPhoto($book,$path)
    {
        $photo = new Photo;
        $photo->path = $path;
        return $book->photos()->save($photo);
    }
    
    public function deletePhoto(Photo $photo)
    {
        $path = $photo->storagepath;
        $photo->delete();
        return $path; // sciezka jest zwrocona po to aby usunac uploadowany obrazek z serwera
    }
    
    public function getBook($id)
    {
        return Book::with(['photos','users.photos','opinions.user'])->find($id); // dodanie obiektow zaleznych do with
    }
    
    
}


