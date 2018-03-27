<?php
namespace App\Controller;

use App\Entity\Exercise;
use App\Entity\Skill;
use App\Util\JSONView;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ExerciseController extends FOSRestController
{
    /**
     * @Rest\Get("/exercises")
     */
    public function getAllAction(JSONView $view) {
        $d = $this->getDoctrine();

        $exercises = $d->getRepository(Exercise::class)->findAll();

        return $view->createDataMessage('Listado com sucesso', $exercises);
    }

    /**
     * @Rest\Post("/exercises/new")
     */
    public function addAction(JSONView $view, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $intensity = $request->request->get('intensity');
        $skillId = $request->request->get('skill');
        $skill = $em->getRepository(Skill::class)->findOneById($skillId);

        $exercise = (new Exercise())
            ->setIntensity($intensity)
            ->setSkill($skill);

        $em->persist($exercise);
        $em->flush();

        return $view->createDataMessage('Cadastrado com sucesso', $exercise);
    }

    /**
     * @Rest\Options("/skills/new")
     */
    public function oAddAction(JSONView $view) {
        return $view->createMessage('ok');
    }
}

