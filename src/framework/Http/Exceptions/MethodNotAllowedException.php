<?php

namespace Framework\Http\Exceptions;

class MethodNotAllowedException extends HttpException
{
    protected int $statusCode = 405;
}
