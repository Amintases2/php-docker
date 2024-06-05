<?php

namespace PFW\Framework\Http\Exceptions;

use Exception;

class HttpException extends Exception
{
    protected int $statusCode = 500;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    public function setStatusCode(int $statusCode): HttpException
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}
