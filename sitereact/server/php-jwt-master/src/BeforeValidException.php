<?php

namespace Firebase\JWT;

class BeforeValidException extends \UnexpectedValueException
{
    function __construct()
    {
        echo json_encode(array("erreur : parametre invalide"), JSON_PRETTY_PRINT);
    }
}
