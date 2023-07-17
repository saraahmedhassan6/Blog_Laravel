<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiTraitResponse;
use App\Http\Controllers\Controller;
use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProjectApiController extends Controller
{
    use ApiTraitResponse;

    //Get All Project
    public function index()
    {
        $Projects=project::all();
        if($Projects)
        {
            return $this->ApiResponse($Projects, 'ok', Response::HTTP_OK);
        }

        return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
    }


    //Get specific Project by ID
    public function show($id)
    {
        $Projects=project::find($id);
        if($Projects)
        {
            return $this->ApiResponse($Projects, 'ok', Response::HTTP_OK);
        }

        return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
    }


    //Create New Project
    public function store(Request $request){

        $validator = Validator::make($request->all(),
            [
                'title'=>'required',
                'article'=>'required',
                'img_name'=>'required',
                'video_name'=>'required',
            ]
        );

        if ($validator->fails()) {
            return $this->ApiResponse(null,$validator->errors(),Response::HTTP_BAD_REQUEST);
        }


        $Projects = project::create($request->all());
        /*                 That will be uncommented when we apply JWT
                $id = team::where('user_id', Auth::user()->id)->first()->id;
                $Projects->team_id = $id;
                $Projects->save();
        */
        if($Projects){
            return $this->ApiResponse($Projects,'Project has been added successfully ',Response::HTTP_ACCEPTED);
        }

        return $this->ApiResponse(null,'The Project Not Save',Response::HTTP_BAD_REQUEST);
    }


    //Update Blog
    public function update(Request $request ,$id){

        $Projects=project::find($id);

        if(!$Projects){
            return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $Projects->update($request->all());

        if($Projects){
            return $this->ApiResponse($Projects,'Project has been Updated successfully',Response::HTTP_ACCEPTED);
        }

    }


    //Delete Blog
    public function destroy($id){

        $Projects=project::find($id);

        if(!$Projects)
        {
            return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $Projects->delete($id);

        if($Projects){
            return $this->ApiResponse(null,'Project has been Deleted successfully',Response::HTTP_ACCEPTED);
        }

    }


}
