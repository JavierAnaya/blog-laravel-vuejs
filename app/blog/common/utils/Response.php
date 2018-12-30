<?php


namespace App\blog\common\utils;


class Response
{
    public $status = true;
    public $args = null;

    /**
     * Response constructor.
     * @param bool $status
     * @param $args
     */
    public function __construct($status, $args)
    {
        $this->status = $status;
        $this->args = $args;
    }

}