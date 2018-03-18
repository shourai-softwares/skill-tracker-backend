<?php
namespace App\Util;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class JSONMessage
{
    protected $status;
    protected $message;
    protected $data;

    public function __construct($message, $status = Response::HTTP_OK, $data = null) {
        $this->message = $message;
        $this->status = $status;
        $this->data = $data;
    }
}
