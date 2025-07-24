<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class TeamController extends Controller
{
    public function AllTeam(){
        $team = Team::latest()->get();
        return view('backend.team.all_team', compact('team'));
    }// End of Method

    public function AddTeam(){
        return view('backend.team.add_team');
    }// End of Method

    public function StoreTeam(Request $request){

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(550,670)->save('upload/team/'.$name_gen);
        $save_url = 'upload/team/'.$name_gen;

        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'tweeter' => $request->tweeter,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

            $notification = array(
            'message' => 'Team Mamber Created Successfully',
            'alert-type' => 'success' 
        );
        return redirect()->route('all.team')->with($notification);

    } // End of Method
}
