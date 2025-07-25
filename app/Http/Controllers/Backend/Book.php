<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;

class Book extends Controller
{
     public function UpdateBookarea(){
    $book = BookArea::find(1);
    return view('backend.bookarea.book_area',compact('book'));
    }// End of Method
}
