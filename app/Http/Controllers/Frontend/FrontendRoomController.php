<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;
use App\Models\Book;
use App\Models\RoomType;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Room;

class FrontendRoomController extends Controller
{
    public function AllFrontendRoomList(){
        $rooms = Room::latest()->get();
        return view('frontend.room.all_rooms',compact('rooms'));
    }// End Method
}
