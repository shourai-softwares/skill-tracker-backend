<?php
namespace App\Builder;

use App\Entity\ApiKey;
use App\Entity\User;
//use App\Exception\BuilderMissingParameterException;
use Ramsey\Uuid\Uuid;

class ApiKeyBuilder implements BuilderInterface
{
	private $user = null;
	private $interval = null;
	private $expirationDate = null;

	public function setUser(User $user)
	{
		$this->user = $user;
		return $this;
	}

	public function setDuration(\DateInterval $interval)
	{
		$this->interval = $interval;
		return $this;
	}

	public function setExpirantionDate(\DateTime $date)
	{
		$this->expirationDate = $date;
		return $this;
	}

	public function build()
	{
		//if(is_null($this->user))
		//	throw new BuilderMissingParameterException("User");

		$now = new \DateTime();

		if(!is_null($this->expirationDate)) {
			$expirationDate = $this->expirationDate;
		} elseif(!is_null($this->interval)) {
			$expirationDate = clone($now);
			$expirationDate->add($interval);
		} else {
			$expirationDate = clone($now);
			$expirationDate->add(new \DateInterval('P7D'));
		}

		//Random uuid number
		$uuid4 = Uuid::uuid4();
		$key = $uuid4->toString();

		$apiKey = (new ApiKey())
			->setKey($key)
			->setUser($this->user)
			->setCreatedAt($now)
			->setExpirantionDate($expirationDate);

		return $apiKey;
	}
}
