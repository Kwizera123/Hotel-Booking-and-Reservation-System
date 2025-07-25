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

    public function EditTeam($id){
        $team = Team::findOrFail($id);
        return view('backend.team.edit_team',compact('team'));
    }// End of Method

    public function UpdateTeam(Request $request){
        $team_id = $request->id;

        if($request->file('image')){
          
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(550,670)->save('upload/team/'.$name_gen);
        $save_url = 'upload/team/'.$name_gen;

        Team::findOrFail($team_id)->update([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'tweeter' => $request->tweeter,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

            $notification = array(
            'message' => 'Team Mamber Updated with Image Successfully',
            'alert-type' => 'info' 
        );
        return redirect()->route('all.team')->with($notification);

        } else {

             Team::findOrFail($team_id)->update([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'tweeter' => $request->tweeter,
            'created_at' => Carbon::now(),
        ]);

            $notification = array(
            'message' => 'Team Mamber Updated without Image Successfully',
            'alert-type' => 'success' 
        );
        return redirect()->route('all.team')->with($notification);
        }// end else condition
    }// End of Method

    public function DeleteTeam($id){
        $item = Team::findOrFail($id);
        $img = $item->image;
        unlink($img);

        Team::findOrFail($id)->delete();

            $notification = array(
            'message' => 'Team Mamber Deleted with Image Successfully',
            'alert-type' => 'error' 
        );
        return redirect()->back()->with($notification);
    }// End Method
}
