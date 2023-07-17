<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiTraitResponse;
use App\Http\Controllers\Controller;
use App\Models\team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeamApiController extends Controller
{
    use ApiTraitResponse;

    //Get All Team Members
    public function index()
    {
        $Team=team::all();
        if($Team)
        {
            return $this->ApiResponse($Team, 'ok', Response::HTTP_OK);
        }

        return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
    }


    //Get specific Team Member by ID
    public function show($id)
    {
        $Teams=team::find($id);
        if($Teams)
        {
            return $this->ApiResponse($Teams, 'ok', Response::HTTP_OK);
        }

        return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
    }


    //Create New Team Member
    public function store(Request $request){

        $validator = Validator::make($request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'position' => 'required',
                'bio' => 'required',
                'signature'=>'required',
                'img_name' => 'required',
            ]
        );

        if ($validator->fails()) {
            return $this->ApiResponse(null,$validator->errors(),Response::HTTP_BAD_REQUEST);
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
        $Teams=team::create(
            [
                'name' => $request->name,
                'position' => $request->position,
                'bio' => $request->bio,
                'signature' => $request->signature,
                'img_name' => $request->img_name,
                'user_id'=> $id,
            ]
        );

        if($Teams){
            return $this->ApiResponse($Teams,'Member has been added successfully ',Response::HTTP_ACCEPTED);
        }

        return $this->ApiResponse(null,'The Member Not Save',Response::HTTP_BAD_REQUEST);
    }


    //Update Team Member
    public function update(Request $request ,$id){

        $Teams=team::find($id);

        if(!$Teams){
            return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $Teams->update($request->all());

        if($Teams){
            return $this->ApiResponse($Teams,'Member has been Updated successfully',Response::HTTP_ACCEPTED);
        }

    }


    //Delete Blog
    public function destroy($id){

        $Teams=team::find($id);

        if(!$Teams)
        {
            return $this->ApiResponse(null, 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $Teams->delete($id);

        if($Teams){
            return $this->ApiResponse(null,'Member has been Deleted successfully',Response::HTTP_ACCEPTED);
        }

    }


}
