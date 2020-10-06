<?php

namespace App\Twojaksiegarnia\Repositories;
use Illuminate\Http\Request;
use App\{Book,User,Opinion,Basket};
use App\Twojaksiegarnia\Interfaces\FrontendRepositoryInterface;

class FrontendRepository implements FrontendRepositoryInterface {
    
    public function getBooksForMainPage()
    {
        return Book::with(['photos'])->orderedDescending()->paginate(8); // wywołuje poszczególne metody w obiekcie  dzieki takiej konstrukcji mamy mniej zapytan do bazy danych zamiast konstrukcji ::all() 
    }
    
    public function getBook($id)
    {
        return Book::with(['photos','users.photos','opinions.user'])->find($id); // dodanie obiektow zaleznych do with
    }
    
    public function getSearchTitles(string $term)
    {
        return Book::where('title','LIKE',$term.'%')->get();
    }
    
    public function getSearchResults(string $title)
    {
        return Book::where('title',$title)->get() ?? false;
    }
    
    public function getCategoryBooks($category)
    {
        return Book::with(['photos'])->where('category',$category)->orderedDescending()->paginate(8);      
    }
    
    public function like($likeable_id, $type, $request)
    {
        $type = 'App\\'.$type;
        
        $likeable = $type::find($likeable_id);
        //dd($likeable->users()->attach($request->user()->id));
        return $likeable->users()->attach($request->user()->id); // dołaczenie zalogowanego uzytkownika do grupy ktora lubi ten obiekt
    }
    
    public function myBasket()
    {  
        $results = Basket::orderBy('id')->get();
        return $results;
    }
    
    public function unlike($likeable_id, $type, $request)
    {
      $type = 'App\\'.$type;
      $likeable = $type::find($likeable_id);

        return $likeable->users()->detach($request->user()->id); // odłaczenie zalogowanego uzytkownika od grupy ktora lubi ten obiekt
    }
    
    public function addOpinion($opinionable_id, $type, $request)
    {
        $type = 'App\\'.$type;
        $opinionable = $type::find($opinionable_id);
        

        $opinion = new Opinion;
        $opinion->opinionable_type = $type;
        $opinion->content = $request->input('content');
        $opinion->rating = $request->input('rating');
        $opinion->user_id = $request->user()->id;
        
        return $opinionable->opinions()->save($opinion);
    }
    
    public function getPerson($id)
    {
        return User::with(['opinions.opinionable','books'])->find($id); // dodanie obiektow zaleznych do with
    }
}