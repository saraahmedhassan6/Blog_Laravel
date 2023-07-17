<?php

namespace App\Http\Controllers;

use App\Models\team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{

    // Index page of TeamMember
    public function index()
    {
        $Teams=team::all();
        return view('TeamMembers.TeamMembers',compact('Teams'));
    }



    // Index page of TeamMember in Dashboard
    public function create()
    {
        $Teams=team::all();
        return view('Dashboard.ShowTeam',compact('Teams'));

    }



    //Create New TeamMember in Dashboard
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'position' => 'required',
                'bio' => 'required',
                'signature'=>'required',
                'img_name' => 'required',
            ], [
                'name.required' => 'Name is required ',
                'position.required' => 'Position is required ',
                'img_name.required' => 'Image is required ',
                'bio.required' => 'Bio is required ',
                'signature.required' => 'Signature is required ',

            ]
        );

        $img_name = '';
        if ($request->hasFile('img_name')) {
            $file = $request->file('img_name');
            $img_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Members/'), $img_name);
        }

        User::create(
            [
                'name' => $request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]
        );

        $user_id = User::latest()->first();
        $id = $user_id->id;
        team::create(
            [
                'name' => $request->name,
                'position' => $request->position,
                'bio' => $request->bio,
                'signature' => $request->signature,
                'img_name' => $img_name,
                'user_id'=> $id,
            ]
        );
        session()->flash('Add_Member','Member has been added successfully');
        return redirect('/DashTeam');
    }


    //Update TeamMember in Dashboard
    public function update(Request $request)
    {
        $id=team::findOrFail($request->id);

        $img_name = '';
        if ($request->hasFile('img_name')) {
            $file = $request->file('img_name');
            $img_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Members/'), $img_name);
        }

        $team_id=$id->id;
        $id->update(
            [
                'name' => $request->name,
                'position' => $request->position,
                'bio' => $request->bio,
                'signature' => $request->signature,
                'img_name' => $img_name,
                'user_id'=> $team_id,
            ]);

        session()->flash('Update_Member','Member has been Updated successfully');
        return redirect('/DashTeam');
    }



    //Delete TeamMember in Dashboard
    public function destroy(Request $request)
    {
        $id=team::findOrFail($request->id);
        $user_id=$id->user_id;
        $id->delete();
        $user_row=User::findOrFail($user_id);
        $user_row->delete();
        session()->flash('Delete_Member','Member has been Deleted successfully');
        return redirect('/DashTeam');
    }

}
