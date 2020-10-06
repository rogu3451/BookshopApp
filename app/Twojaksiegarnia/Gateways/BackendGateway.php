<?php

namespace App\Twojaksiegarnia\Gateways;

use App\Twojaksiegarnia\Interfaces\BackendRepositoryInterface;

class BackendGateway {
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;
    
    public function __construct(BackendRepositoryInterface $bR)
    {
        $this->bR = $bR;
    }
    
    public function saveUser($request)
    {
        $this->validate($request, [
              'name' => "required|string",
              'surname' => "required|string",
              'email' => "required|email",
        ]);
        
        if($request->hasFile('userPicture')) // spradzenie czy obrazek zostal dodany
        {
              $this->validate($request, [
              'userPicture' => 'image|max:100'  // jego walidacja
            ]);
            
        }
        
        return $this->bR->saveUser($request);
    }
    
    
    public function saveBook($id, $request) // walidacja edytowanej ksiazki
    {
        $this->validate($request, [
              'title' => "required|string",
              'author' => "required|string",
              'year' => "required|integer",
              'description' => "required|string",
              'category' => "required|string",
        ]);
        
       if($request->hasFile('bookPicture')) // spradzenie czy obrazek zostal dodany
        {
              
              $this->validate($request, [
              'bookPicture' => 'dimensions:width=300,height=400',  // jego walidacja
            ]);
           
        }
        
        return $this->bR->saveBook($id, $request);
        
        
       
    }
    
    public function addBook($request) // walidacja dodawanej ksiazki
    {
        $this->validate($request, [
              'title' => "required|string",
              'author' => "required|string",
              'year' => "required|integer",
              'description' => "required|string",
              'category' => "required|string",
        ]);
        
       if($request->hasFile('bookPicture')) // spradzenie czy obrazek zostal dodany
        {
              
              $this->validate($request, [
              'bookPicture' => 'dimensions:width=300,height=400',  // jego walidacja
            ]);
           
        }
        
        return $this->bR->addBook($request);

    }
    
    
    public function checkNotificationsStatus($request)
    {
        
        $start = microtime(true); // zabezpieczenie przed zapetleniem
        $response = [];
        
        while(1<=1) // ta petla zastąpi requesty ajaxowe w interwale 
        {
            
            if(microtime(true)-$start > 10)
                return json_encode();
            
            
            
        }
    } 
    
}