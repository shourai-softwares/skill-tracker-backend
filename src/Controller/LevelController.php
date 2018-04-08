<?php
namespace App\Controller;

use App\Entity\Level;
use App\Util\JSONView;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class LevelController extends FOSRestController
{
    /**
     * @Rest\Get("/levels")
     */
    public function getAllAction(JSONView $view) {
        $d = $this->getDoctrine();

        $levels = $d->getRepository(Level::class)->findAll();

        return $view->createDataMessage('Listado com sucesso', $levels);
    }
}
