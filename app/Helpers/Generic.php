<?php
namespace App\Helpers;

class Generic
{
    public static function getBaseUrl()
    {
        return env('BASE_URL','http://audit.dev');
    }

}
