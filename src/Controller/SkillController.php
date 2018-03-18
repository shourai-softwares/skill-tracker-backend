<?php
namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Skill;
use App\Util\JSONView;

class SkillController extends FOSRestController
{
    /**
     * @Route("/skills")
     */
    public function getAllAction(JSONView $view) {
        $d = $this->getDoctrine();

        $skills = $d->getRepository(Skill::class)->findAll();

        return $view->createDataMessage('Listado com sucesso', $skills);
    }

    /**
     * @Route("/skills/add")
     */
    public function addAction() {
    }
}

