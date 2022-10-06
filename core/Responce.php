<?php


namespace app\core;


class Responce
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}