<?php
class ContactUsController extends EshopPage 
{
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="contactus";
	}
	
	public function onload()
	{
		if(!$this->IsPostBack)
		{
			$this->setTitle("Contact Us");
		}
	}
}
?>