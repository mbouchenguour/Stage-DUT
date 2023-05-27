<?php

namespace Firebase\JWT;

class SignatureInvalidException extends \UnexpectedValueException
{
    function __construct()
    {
        echo json_encode("erreur : Signature non valide", JSON_PRETTY_PRINT);
    }
}
