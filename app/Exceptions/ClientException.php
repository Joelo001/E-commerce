<?php

namespace App\Exceptions;

use App\Http\Resources\ApiResponse;
use Exception;

class ClientException extends Exception
{
    protected $message;
    protected $code;
    public function __construct(string $message = "", int $code = 0){
        $this->message = $message;
        $this->code = $code;
       
    }
    public function render($request){
        return ApiResponse::error(
            'clientexception',
            $this->message,
            $this->code
        );
    }
}
