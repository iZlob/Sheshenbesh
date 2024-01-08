<?php

namespace  Classes\Exceptions;

use Exception;


class DieValueIsNotInitialisedException extends Exception
{

    public function __construct()
    {
        parent::__construct("Die value is not initialized. (Maybe die not throw yet)");
    }
}