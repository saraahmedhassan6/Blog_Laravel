<?php

namespace App\Http\Controllers\Api\Traits;

trait ApiTraitResponse
{

    public function ApiResponse($data= null,$message = null,$status = null)
    {
        $array = [

            'message'=>$message,
            'status'=>$status,
            'data'=>$data,
        ];
        return response($array);
    }
}
