<?php
class ServicesController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle="services";
		$this->menuItemName="services";
	}
}
?>