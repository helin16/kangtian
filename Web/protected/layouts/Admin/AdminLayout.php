<?php
 
/**
 * class DefaultLayout
 */
class AdminLayout extends TTemplateControl
{
	
	public function onLoad()
	{
		$this->getUsername();
	}
	

	public function getUsername()
	{
		if(!System::getUser() instanceof UserAccount)
			$this->Response->redirect("/login.html");
		$this->usernameBtn->Text = System::getUser()->getUserName();
	}
	
	public function logoutUser($sender,$param)
	{
//		$this->Application->getModule('auth')->logout();
	}
}
?>