<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //

    protected $user;

    public function __construct()
    {
        // Access the authenticated user
        $this->user = auth()->user();
    }

    public function sendResponse($result, $message=false)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
        ];

        if(!empty($message)){
            $response['message']=$message;
        }
        return response()->json($response, 200);
    }
 
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
 
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
 
        return response()->json($response, $code);
    }
}
