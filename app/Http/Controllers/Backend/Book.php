<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class Book extends Controller
{
     public function UpdateBookarea(){
    $book = BookArea::find(1);
    return view('backend.bookarea.book_area',compact('book'));
    }// End of Method

    public function BookAreaUpdate(Request $request){
        $book_id = $request->id;

        if($request->file('image')){
          
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(1000,1000)->save('upload/bookarea/'.$name_gen);
        $save_url = 'upload/bookarea/'.$name_gen;

        BookArea::findOrFail($book_id)->update([
            'short_title' => $request->short_title,
            'main_title' => $request->main_title,
            'short_desc' => $request->short_desc,
            'link_url' => $request->link_url,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

            $notification = array(
            'message' => 'Book Area Updated with Image Successfully',
            'alert-type' => 'info' 
        );
        return redirect()->back()->with($notification);

        } else {

             BookArea::findOrFail($book_id)->update([
            'short_title' => $request->short_title,
            'main_title' => $request->main_title,
            'short_desc' => $request->short_desc,
            'link_url' => $request->link_url,
            'created_at' => Carbon::now(),
        ]);

            $notification = array(
            'message' => 'Book Area Updated without Image Successfully',
            'alert-type' => 'success' 
        );
        return redirect()->back()->with($notification);
        }// end else condition
    }// End of Method
}
