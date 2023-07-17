<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Index page of Project
    public function index()
    {
        $Projects = project::orderByDesc('id')->get();
        return view('Projects.Projects',compact('Projects'));

    }



    // Projects for Specific Member
    public function create($id)
    {
        $Projects=project::where('team_id',$id)->get();
        return view('Projects.ShowProjectMember',compact('Projects'));
    }




    // Show Specific Project
    public function show($id)
    {
        $Projects=project::where('id',$id)->get();
        return view('Projects.ShowProject',compact('Projects'));
    }


    // Index page of Project in Dashboard
    public function Dashcreate()
    {
        if(Auth::user()->role_id==1)
        {
            $Projects = project::orderByDesc('id')->get();
            return view('Dashboard/ShowProject',compact('Projects'));
        }
        else
        {
            $Teams=team::where('user_id',Auth::user()->id)->get();
            $Projects = collect();
            foreach ($Teams as $Team) {
                $Projects = $Projects->merge($Team->Project()->orderByDesc('id')->get());
            }

            return view('Dashboard/ShowProject',compact('Projects'));
        }


    }



    //Create New Projects in Dashboard
    public function store(Request $request)
    {
        $request->validate(
            [
                'title'=>'required',
                'article'=>'required',
                'img_name'=>'required',
                'video_name'=>'required',


            ],[
                'title.required'=>'title is required ',
                'article.required'=>'article is required ',
                'img_name.required'=>'Image is required ',
                'video_name.required'=>'Video is required ',

            ]
        );

        $img_name = '';
        if ($request->hasFile('img_name')) {
            $file = $request->file('img_name');
            $img_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Projects'), $img_name);
        }

        $video = '';
        if ($request->hasFile('video_name')) {
            $file = $request->file('video_name');
            $video = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Projects'), $video);
        }

        $id = team::where('user_id', Auth::user()->id)->first()->id;

        project::create(
            [
                'title'=>$request->title,
                'article'=>$request->article,
                'video_name'=>$video,
                'img_name'=>$img_name,
                'team_id'=>$id,
            ]
        );

        session()->flash('Add_Project','Project has been added successfully');
        return redirect('/DashShowProject');
    }



    //Update Projects in Dashboard
    public function update(Request $request)
    {
        $id=project::findOrFail($request->id);

        $img_name = '';
        if ($request->hasFile('img_name')) {
            $file = $request->file('img_name');
            $img_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Projects'), $img_name);
        }

        $video = '';
        if ($request->hasFile('video_name')) {
            $file = $request->file('video_name');
            $video = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Projects'), $video);
        }


        $team_id = team::where('user_id', Auth::user()->id)->first()->id;
        $id->update(
            [
                'title'=>$request->title,
                'article'=>$request->article,
                'video_name'=>$video,
                'img_name'=>$img_name,
                'team_id'=>$team_id,
            ]);

        session()->flash('Update_Project','Project has been Updated successfully');
        return redirect('/DashShowProject');
    }



    //Delete Projects in Dashboard
    public function destroy(Request $request)
    {
        $id=project::findOrFail($request->id);
        $id->delete();
        session()->flash('Delete_Project','Project has been Deleted successfully');
        return redirect('/DashShowProject');
    }


}
