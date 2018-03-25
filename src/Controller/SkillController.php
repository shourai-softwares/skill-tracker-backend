<?php
namespace App\Controller;

use App\Entity\Skill;
use App\Util\JSONView;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class SkillController extends FOSRestController
{
    /**
     * @Rest\Get("/skills")
     */
    public function getAllAction(JSONView $view) {
        $d = $this->getDoctrine();

        $skills = $d->getRepository(Skill::class)->findBy(['parent' => null]);

        return $view->createDataMessage('Listado com sucesso', $skills);
    }

    /**
     * @Rest\Post("/skills/new")
     */
    public function addAction(JSONView $view, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $name = $request->request->get('name');
        $parentId = $request->request->get('parent');
        if($parentId)
            $parent = $em->getRepository(Skill::class)->findOneById($parentId);

        $skill = new Skill();
        $skill->setName($name);
        if($parent)
            $skill->setParent($parent);

        $em->persist($skill);
        $em->flush();

        return $view->createDataMessage('Cadastrado com sucesso', $skill);
    }

    /**
     * @Rest\Options("/skills/new")
     */
    public function oAddAction(JSONView $view) {
        return $view->createMessage('ok');
    }
}

