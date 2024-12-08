<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
    public static function success($data,$message,$code){
        return response()->json([
            'status'=>true,
            'message'=>$message,
            'data'=>$data,

        ],$code);
    }
    public static function error($message,$errors,$code){
        return response()->Json([
            'status'=>false,
            'message'=>$message,
            'errors'=>$errors, 
        ],$code);
    }
}
