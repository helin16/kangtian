<?php
class AdminPage extends TPage 
{
	public function onPreInit($param)
	{
		parent::onPreInit($param);
		$this->getPage()->setMasterClass("Application.layouts.Admin.AdminLayout");
	}
	
	public function setInfoMessage($msg)
	{
		$this->getPage()->getMaster()->infoLabel->Text = $msg;
	}
	
	public function setErrorMessage($msg)
	{
		$this->getPage()->getMaster()->errorLabel->Text = $msg;
	}
}
?>