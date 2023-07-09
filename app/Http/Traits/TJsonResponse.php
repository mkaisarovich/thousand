<?php

namespace App\Http\Traits;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Illuminate\Http\JsonResponse;


trait TJsonResponse
{



    public function successResponse($message, $data=null): JsonResponse
    {
        throw new HttpResponseException(response()->json(['success'=> true, 'message'=> $message, 'data' => $data ],
            200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE));
    }

    public function failedResponse($message, $status, $data=null, $error_code=null){
        throw new HttpResponseException(response()->json(['success'=> false, 'message'=> $message, "errors" => $data, 'error_code' => $error_code ],
            $status, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE));
    }

 
}