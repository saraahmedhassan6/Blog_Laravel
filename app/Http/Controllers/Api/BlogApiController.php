<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiTraitResponse;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogApiController extends Controller
{
    use ApiTraitResponse;

    //Get All Blog
    public function index()
    {
        $Blogs=Blog::all();
        if($Blogs)
        {
            return $this->ApiResponse($Blogs, 'ok', Response::HTTP_OK);
        }

        return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
    }


    //Get specific Blog by ID
    public function show($id)
    {
        $Blogs=Blog::find($id);
        if($Blogs)
        {
            return $this->ApiResponse($Blogs, 'ok', Response::HTTP_OK);
        }

        return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
    }


    //Create New Blog
    public function store(Request $request){

        $validator = Validator::make($request->all(),
            [
                'title'=>'required',
                'article'=>'required',
                'img_name'=>'required',
                'thumbnail'=>'required',
            ]
        );

        if ($validator->fails()) {
            return $this->ApiResponse(null,$validator->errors(),Response::HTTP_BAD_REQUEST);
        }


        $Blogs = Blog::create($request->all());


        $Blogs->published = 0;

        $Blogs->save();

        if($Blogs){
            return $this->ApiResponse($Blogs,'Blog has been added successfully ',Response::HTTP_ACCEPTED);
        }

        return $this->ApiResponse(null,'The Blog Not Save',Response::HTTP_BAD_REQUEST);
    }


    //Update Blog
    public function update(Request $request ,$id){

        $Blogs=Blog::find($id);

        if(!$Blogs){
            return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $Blogs->update($request->all());

        if($Blogs){
            return $this->ApiResponse($Blogs,'Blog has been Updated successfully',Response::HTTP_ACCEPTED);
        }

    }



    //Delete Blog
    public function destroy($id){

        $Blogs=Blog::find($id);

        if(!$Blogs)
        {
            return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $Blogs->delete($id);

        if($Blogs){
            return $this->ApiResponse(null,'Blog has been Deleted successfully',Response::HTTP_ACCEPTED);
        }

    }
}
