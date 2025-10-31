<?php

namespace App\Exceptions;

use Exception;

class ProductQtyException extends Exception
{
    public function __construct(
        string $message = "محصولی در سبد خرید شما وجود دارد که مجود نیست",
        int    $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
