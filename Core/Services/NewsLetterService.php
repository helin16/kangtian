<?php
class NewsLetterService extends BaseService 
{
	public function __construct()
	{
		parent::__construct("Subscriber");
	}
	
	public function subscribe($email)
	{
		$subscribers = $this->findByCriteria("email like '$email'");
		if(count($subscribers)>0)
			throw new Exception("Email exists already!");
			
		$now = new HydraDate();
		$sql ="insert into subscriber(`email`,`key`,`isConfirmed`,`created`,`createdById`,`updated`,`updatedById`)
				value('$email','".md5("$email $now")."','1','$now','1','$now','1')";
		Dao::execSql($sql);
	}
	
	public function unsubscribe($key)
	{
		$subscribers = $this->findByCriteria("key ='$key'",false);
		if(count($subscribers)==0)
			throw new Exception("Email doesn't exist!");
		foreach($subscribers as $sub)
		{
			$sub->setActive(false);
			$this->save($sub);
		}
	}
}
?>