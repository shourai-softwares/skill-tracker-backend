<?php
namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class DefaultController extends FOSRestController
{
    /**
     * @Rest\Get("/")
     */
    public function indexAction() {
        return $this->view('ola', 200);
    }
}
