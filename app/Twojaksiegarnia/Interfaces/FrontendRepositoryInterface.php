<?php

namespace App\Twojaksiegarnia\Interfaces;

interface FrontendRepositoryInterface {
    
    public function getBooksForMainPage();
    public function getCategoryBooks($category);
    public function getBook($id);
}