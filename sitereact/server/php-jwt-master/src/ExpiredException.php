<?php

namespace Firebase\JWT;

class ExpiredException extends \UnexpectedValueException
{
    function __construct()
    {
        echo json_encode("Token expire", JSON_PRETTY_PRINT);
    }
}
