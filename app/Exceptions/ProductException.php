<?php

namespace App\Exceptions;

use App\Http\Resources\ApiResponse;
use Exception;

class ProductException extends Exception
{
    protected $message;
    protected $code;
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null){
        $this->message =$message;
        $this->code=$code;
    }
    public function render(){
        ApiResponse::error(
            'Erreur de gestion des produits',
            $this->message,
            $this->code
        );
    }
}
