<?php
class ServicesController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle=Prado::localize("Menu.services");
		$this->menuItemName="services";
	}
}
?>