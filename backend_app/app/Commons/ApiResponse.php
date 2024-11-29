<?php
namespace App\Commons;

class ApiResponse extends \stdClass{

    public static function response($error, $message, $data = []) {
        $data = json_encode([
            'code'=>$error,
            'message'=>$message,
            'data'=>empty($data) ? null : $data
        ]);

        return response($data,200);

    }
    public static function responseSuccess($message, $data = []) {

        return response(json_encode([
            'code'=>0,
            'message'=>$message,
            'data'=>empty($data) ? null : $data
        ]),200)->header('Content-Type', 'application/json; charset=utf-8');

    }
    public static function responseError($message, $data = [], $code = 1) {
        return response(json_encode([
            'code'=>$code,
            'message'=>$message,
            'data'=>empty($data) ? null : $data
        ]),200)->header('Content-Type', 'application/json; charset=utf-8');
    }
}