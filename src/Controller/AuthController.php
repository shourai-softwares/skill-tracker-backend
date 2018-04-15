<?php
namespace App\Controller;

use App\Builder\ApiKeyBuilder;
use App\Entity\User;
use App\Util\JSONView;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends FOSRestController
{
    /**
     * @Rest\Post("/login")
     */
    public function loginAction(JSONView $view, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $userName = $request->request->get('user_name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        if((!$userName && !$email) || !$password)
            return $view->createErrorMessage('=p', Response::HTTP_BAD_REQUEST);

        if($email)
            $user = $em->getRepository(User::class)->findOneByEmail($email);
        else
            $user = $em->getRepository(User::class)->findOneByUsername($userName);

        if(is_null($user))
            return $view->createErrorMessage('deu ruim', Response::HTTP_FORBIDDEN);

        $encoder = $this->get("security.password_encoder");
        if(!$encoder->isPasswordValid($user, $password))
            return $view->createErrorMessage('nope', Response::HTTP_FORBIDDEN);

        $activeKey = $user->getActiveKey();
        if(!is_null($activeKey))
            return $view->createDataMessage('Logado', $activeKey);

        $apiKey = (new ApiKeyBuilder())->setUser($user)->build();
        $em->persist($apiKey);
        $em->flush();

        return $view->createDataMessage('Logado', $apiKey);
    }

    /**
     * @Rest\Post("/register")
     */
    public function registerAction(JSONView $view, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $userName = $request->request->get('user_name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = (new User())
            ->setUsername($userName)
            ->setEmail($email)
            ->setPlainPassword($password)
            ->setEnabled(true)
            ->setRoles(['ROLE_USER']);

        $em->persist($user);
        $em->flush();

        return $view->createDataMessage('Cadastrado com sucesso', $user);
    }
}

