<?php
class Subscriber extends HydraEntity 
{
	private $email;
	private $key;
	private $isConfirmed;
	
	/**
	 * getter email
	 *
	 * @return email
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * setter email
	 *
	 * @var email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	/**
	 * getter key
	 *
	 * @return key
	 */
	public function getKey()
	{
		return $this->key;
	}
	
	/**
	 * setter key
	 *
	 * @var key
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}
	
	/**
	 * getter isConfirmed
	 *
	 * @return isConfirmed
	 */
	public function getIsConfirmed()
	{
		return $this->isConfirmed;
	}
	
	/**
	 * setter isConfirmed
	 *
	 * @var isConfirmed
	 */
	public function setIsConfirmed($isConfirmed)
	{
		$this->isConfirmed = $isConfirmed;
	}
	
	public function __toString()
	{
		return $this->getEmail();
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'ss');
		
		DaoMap::setStringType('email','varchar',200);
		DaoMap::setStringType('key','varchar',200);
		DaoMap::setBoolType('isConfirmed');
		
		DaoMap::defaultSortOrder("email");
		
		DaoMap::commit();
	}
}
?>