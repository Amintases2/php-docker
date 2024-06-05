<?php

namespace PFW\Framework\Http\Exceptions;

class NotFoundException extends HttpException
{
    protected int $statusCode = 404;
}
