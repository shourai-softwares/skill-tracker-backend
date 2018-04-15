<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 */
class ApiKey
{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="api_key", type="string", length=191, unique=true)
	 */
	private $key;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="apiKeys")
	 * @Serializer\Exclude()
	 */
	private $user;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $expirationDate;

	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $logoutDate;

	/**
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $createdAt;

	public function setKey(string $key): ApiKey
	{
		$this->key = $key;
		return $this;
	}

	public function getKey(): ?string
	{
		return $this->key;
	}

	public function setUser(User $user): ApiKey
	{
		$this->user = $user;
		return $this;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setExpirantionDate(\DateTime $date): ApiKey
	{
		$this->expirationDate = $date;
		return $this;
	}

	public function getLogoutDate(): ?\DateTime
	{
		return $this->logoutDate;
	}

	public function setLogoutDate(\DateTime $date): ApiKey
	{
		$this->logoutDate = $date;
		return $this;
	}

	public function getExpirationDate(): ?\DateTime
	{
		return $this->expirationDate;
	}

	public function setCreatedAt(\DateTime $date): ApiKey
	{
		$this->createdAt = $date;
		return $this;
	}

	public function getCreatedAt(): ?\DateTime
	{
		return $this->createdAt;
	}

	public function update(): ApiKey
	{
		$date = new \DateTime();
		$date->add(new \DateInterval("P1D"));

		if($this->expirationDate < $date)
			$this->expirationDate = $date;

		return $this;
	}
}
