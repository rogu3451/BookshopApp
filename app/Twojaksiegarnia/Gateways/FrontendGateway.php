<?php

namespace App\Twojaksiegarnia\Gateways;

use App\Twojaksiegarnia\Interfaces\FrontendRepositoryInterface;

class FrontendGateway {
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;
    
    public function __construct(FrontendRepositoryInterface $fR)
    {
        $this->fR = $fR;
    }
    
    
    public function serachTitles($request)
    {
        
        $term = $request->input('term');
        
        $result = [];
        
        $queries = $this->fR->getSearchTitles($term);
        
        foreach($queries as $query)
        {
            $result[] = ['id'=>$query->id,'value'=>$query->title];
        }
        
        return $result;
    }
    
    public function getSearchResults($request)
    {
        $request->flash();
        if($request->input('title')!=null) // sprawdzenie czy uzytkownik cos wpisal
        {
            $result = $this->fR->getSearchResults($request->input('title'));
            
            if($result)
            {
                return $result;
            }
        }
        
        
        
        return false;
    }
    
    
    public function addOpinion($opinionable_id, $type, $request)
    {
        $this->validate($request, [
              'content' => "required|string"
        ]);
        
        
        return $this->fR->addOpinion($opinionable_id, $type, $request);
    }
    
}