<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

	/**
	 * @ORM\OneToMany(targetEntity="ApiKey", mappedBy="user")
	 * @JMS\Exclude()
	 */
	private $apiKeys;

	public function __construct()
	{
		parent::__construct();

		$this->apiKeys = new ArrayCollection();
	}

	public function getApiKeys(): array
	{
		return $this->apiKeys->toArray();
	}

	public function getActiveKey(): ?ApiKey
	{
		$now = new \DateTime();

		foreach($this->apiKeys as $apiKey)
			if(is_null($apiKey->getLogoutDate()) && $apiKey->getExpirationDate() > $now)
				return $apiKey;

		return null;
	}

	public function addApiKey(ApiKey $apiKey): User
	{
		if (!$this->apiKeys->contains($apiKey))
			$this->apiKeys->add($apiKey);
		return $this;
	}
}
