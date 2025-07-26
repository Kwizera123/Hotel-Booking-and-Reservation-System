<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\BookArea;
use App\Models\RoomType;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

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
        RoomType::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

         $notification = array(
            'message' => 'Room Type Created Successfully',
            'alert-type' => 'success' 
        );
        return redirect()->route('room.type.list')->with($notification);
    }// End of Method
}
