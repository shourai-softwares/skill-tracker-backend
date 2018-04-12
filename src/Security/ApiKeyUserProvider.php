<?php
namespace App\Security;

use App\Entity\ApiKey;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class ApiKeyUserProvider implements UserProviderInterface
{
    private $doctrine;

    public function __construct(\Doctrine\Common\Persistence\ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getUsernameForApiKey($keyValue)
    {
        $apiKey = $this->doctrine->getRepository(ApiKey::class)->findOneBy(['key' => $keyValue]);
        if(!$apiKey)
            return '';
        if(!is_null($apiKey->getLogoutDate()))
            return '';
        if($apiKey->getExpirationDate() < new \DateTime())
            return '';
        return $apiKey->getUser()->getUserEmail();
    }

    public function loadUserByUsername($email)
    {
        return $this->doctrine->getRepository(User::class)->findOneBy(['email' => $email]);
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}

