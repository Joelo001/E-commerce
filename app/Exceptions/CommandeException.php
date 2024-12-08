<?php

namespace App\Exceptions;

use App\Http\Resources\ApiResponse;
use Exception;

class CommandeException extends Exception
{
    
    protected $message;
    protected $code;
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null){
        $this->message=$message;
        $this->code =$code;
    }
    public function render(){
        return ApiResponse::error(
            'commandes exception',
            $this->message,
            $this->code
        );
    }
}
