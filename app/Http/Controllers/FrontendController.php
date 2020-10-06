<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Twojaksiegarnia\Interfaces\FrontendRepositoryInterface;
use App\Twojaksiegarnia\Gateways\FrontendGateway;

class FrontendController extends Controller
{
    //Nasze repozytorium jest wykorzystywane w prawie kazdej metodzie tej klasy
    
    public function __construct(FrontendRepositoryInterface $fR, FrontendGateway $fG)
    {
        
        $this->middleware('auth')->only(['like','unlike','addOpinion']);
        
        
        
        $this->fR = $fR;
        $this->fG = $fG;
    }
    
    public function index()
    {
        $books = $this->fR->getBooksForMainPage();
        $mybasket = $this->fR->myBasket();
        //dd($books);
        return view('frontend.index',['books' => $books,'mybasket' => $mybasket]);
    }
    
    public function book($id) // wyświetla szczegóły obiektu po id
    {
        $book = $this->fR->getBook($id);
        $mybasket = $this->fR->myBasket();
        //dd($book);
        return view('frontend.book',['book' => $book,'mybasket' => $mybasket]);
    }
    
    public function person($id)
    {
        $user = $this->fR->getPerson($id);
        $mybasket = $this->fR->myBasket();
        return view('frontend.person',['user'=>$user,'mybasket' => $mybasket]);
    }
	
	
	
	// Kategorie ksiazek
	public function bestseller()
    {
        $category = 'bestseller';
        $books = $this->fR->getCategoryBooks($category);
        $mybasket = $this->fR->myBasket();
        //dd($books);
        return view('frontend.bestseller',['books' => $books,'mybasket' => $mybasket]);
    }
	
	public function promotion()
    {
        $category = 'promocja';
        $books = $this->fR->getCategoryBooks($category);
        $mybasket = $this->fR->myBasket();
        //dd($books);
        return view('frontend.promotion',['books' => $books,'mybasket' => $mybasket]); 
        
    }
	
	public function reading()
    {
        $category = 'lektura';
        $books = $this->fR->getCategoryBooks($category);
        $mybasket = $this->fR->myBasket();
        
        //dd($books);
        return view('frontend.reading',['books' => $books,'mybasket' => $mybasket]); 
    }
	
	public function informatics()
    {
        $category = 'informatyka';
        $books = $this->fR->getCategoryBooks($category);
        $mybasket = $this->fR->myBasket();
        //dd($books);
        return view('frontend.informatics',['books' => $books,'mybasket' => $mybasket]);
        
    }

	public function fantasy()
    {
        $category = 'fantastyka';
        $books = $this->fR->getCategoryBooks($category);
        $mybasket = $this->fR->myBasket();
        //dd($books);
        return view('frontend.fantasy',['books' => $books,'mybasket' => $mybasket]);
    }
	
	public function history()
    {
        $category = 'historia';
        $books = $this->fR->getCategoryBooks($category);
        $mybasket = $this->fR->myBasket();
        //dd($books);
        return view('frontend.history',['books' => $books,'mybasket' => $mybasket]);
    }
    
	
	
	
	// wyszukiwarka ksiazek
    public function booksearch(Request $request) 
    {
        $mybasket = $this->fR->myBasket();
        if($title = $this->fG->getSearchResults($request))
        {
            //dd($title);
            return view('frontend.booksearch',['title'=>$title,'mybasket' => $mybasket]);  
        }
        else
        {
           // if(!$request->ajax())
            return redirect('/')->with('nobooks','Podaj tytuł do wyszukania'); // zmienna sesyjna w laravelu
        }
       
    } 
    
    public function findbook(Request $request) 
    {
       
        if($title = $this->fG->getSearchResults($request))
        {
            //dd($title);
            return view('backend.findbook',['books'=>$title]);  
        }
        else
        {
           // if(!$request->ajax())
            return redirect('/admin'); 
        }
       
    } 
    
    public function serachTitles(Request $request) 
    {
        $results = $this->fG->serachTitles($request);
        return response()->json($results);
    }
    
    public function like($likeable_id, $type, Request $request)
    {
        $this->fR->like($likeable_id, $type, $request);
        
        return redirect()->back();
    }
    
    public function unlike($likeable_id, $type, Request $request)
    {
        $this->fR->unlike($likeable_id, $type, $request);
        
        return redirect()->back();
    }
    
    public function addOpinion($opinionable_id, $type, Request $request)
    {
       $this->fG->addOpinion($opinionable_id, $type, $request);
        
        return redirect()->back();
    }
    
    
}
