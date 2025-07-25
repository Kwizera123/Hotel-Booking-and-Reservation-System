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

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allData = RoomType::orderBy('id','desc')->get();
        return view('backend.allroom.roomtype.view_roomtype',compact('allData'));
    }
    //End of method

    public function AddRoomType(){
        return view('backend.allroom.roomtype.add_roomtype');
    }// End Method

    public function RoomTypeStore(Request $request){
        $roomtype_id = RoomType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'roomtype_id' => $roomtype_id,
        ]);

         $notification = array(
            'message' => 'Room Type Created Successfully',
            'alert-type' => 'success' 
        );
        return redirect()->route('room.type.list')->with($notification);
    }// End of Method
}
