<?php
namespace App\Util;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class JSONView
{
    public function createErrorMessage(string $message, $errorStatus): View
    {
        $json = new JSONMessage($message, $errorStatus);
        return $this->createView($json, $errorStatus);
    }

    public function createDataMessage(string $message, $data, $status = Response::HTTP_OK): View
    {
        $json = new JSONMessage($message, $status, $data);
        return $this->createView($json, $status);
    }


    public function createMessage(string $message, $status = Response::HTTP_OK): View
    {
        $json = new JSONMessage($message);
        return $this->createView($json, $status);
    }

    private function createView($json, $status)
    {
        return View::create($json, $status)
            ->setHeader('Access-Control-Allow-Origin', 'http://localhost:3000');
    }
}
