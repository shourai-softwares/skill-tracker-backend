<?php
namespace App\Controller;

use App\Util\JSONView;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends FOSRestController
{
    /**
     * @Rest\Get("/login")
     */
    public function loginAction(JSONView $view) {
        return $view->createMessage('ok');
    }
}

