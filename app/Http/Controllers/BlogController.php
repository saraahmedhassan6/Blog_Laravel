<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // Index page of Blog
    public function index()
    {
        $Blogs = Blog::where('published', 1)
            ->orderByDesc('id')
            ->get();
        return view('Blogs.Blogs',compact('Blogs'));
    }


    // Show Specific Blog
    public function show($id)
    {
        $Blogs=Blog::where('id',$id)->get();
        return view('Blogs.ShowBlog',compact('Blogs'));
    }


    // Index page of Blog in Dashboard
    public function create()
    {
        if(Auth::user()->role_id==1)
        {
            $Blogs = Blog::orderByDesc('id')->get();
            return view('Dashboard/ShowBlog',compact('Blogs'));
        }
        else
        {
           $Teams=team::where('user_id',Auth::user()->id)->get();
            $Blogs = collect();
            foreach ($Teams as $Team) {
                $Blogs = $Blogs->merge($Team->Blog()->orderByDesc('id')->get());
            }

            return view('Dashboard/ShowBlog',compact('Blogs'));
        }


    }


   // Create New Blog in Dashboard
    public function store(Request $request)
    {
        $request->validate(
            [
                'title'=>'required',
                'article'=>'required',
                'img_name'=>'required',
                'thumbnail'=>'required',


            ],[
                'title.required'=>'title is required ',
                'article.required'=>'article is required ',
                'img_name.required'=>'Image is required ',
                'thumbnail.required'=>'thumbnail is required ',

            ]
        );

        $img_name = '';
        if ($request->hasFile('img_name')) {
            $file = $request->file('img_name');
            $img_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('BlogImage'), $img_name);
        }



        $thumbnail = '';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('BlogImage'), $thumbnail);
        }

        $id = team::where('user_id', Auth::user()->id)->first()->id;

        Blog::create(
            [
                'title'=>$request->title,
                'article'=>$request->article,
                'thumbnail'=>$thumbnail,
                'img_name'=>$img_name,
                'team_id'=>$id,
                'published'=>0,
            ]
        );

        session()->flash('Add_Blog','Blog has been added successfully');
        return redirect('/DashShowBlog');
    }


    // Update Blog in Dashboard
    public function update(Request $request)
    {
        $id=Blog::findOrFail($request->id);

        $img_name = '';
        if ($request->hasFile('img_name')) {
            $file = $request->file('img_name');
            $img_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('BlogImage'), $img_name);
        }

        $thumbnail = '';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('BlogImage'), $thumbnail);
        }

        $team_id = team::where('user_id', Auth::user()->id)->first()->id;
        $id->update(
            [
                'title'=>$request->title,
                'article'=>$request->article,
                'thumbnail'=>$thumbnail,
                'img_name'=>$img_name,
                'team_id'=>$team_id,
                'published'=>1,
            ]);

        session()->flash('Update_Blog','Blog has been Updated successfully');
        return redirect('/DashShowBlog');
    }



    // Delete Blog in Dashboard
    public function destroy(Request $request)
    {
        $id=Blog::findOrFail($request->id);
        $id->delete();
        session()->flash('Delete_Blog','Blog has been Deleted successfully');
        return redirect('/DashShowBlog');
    }



    public function publish(Request $request, $id)
    {
        $Blogs = Blog::findOrFail($id);
        if($Blogs->published==1)
            $Blogs->published = 0;
        else
            $Blogs->published = 1;
        $Blogs->save();

        return redirect()->back()->with('success', 'Blog post has been published.');
    }

}
