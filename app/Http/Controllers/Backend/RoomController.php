<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\BookArea;
use App\Models\RoomType;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Room;

class RoomController extends Controller
{
    public function EditRoom($id){
    $editData = Room::find($id);
    return view('backend.allroom.rooms.edit_rooms',compact('editData'));
    }// End of method
}
