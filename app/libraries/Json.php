<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');



class Json
{

    /**
     * Expects json request body.
     * @return array An associative array.
     */
    public function read() : array
    {
        $raw = file_get_contents('php://input');
        return json_decode($raw, true) ?? [];
    }

    /**
     * Sets status code and sends your message.
     */
    public function error($msg, $code = 400) : void
    {
        http_response_code($code);
        echo $msg;
    }

    /**
     * Sets header and sends your json encoded data.
     */
    public function send($data) : void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }

}