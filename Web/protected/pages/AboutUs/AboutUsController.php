<?php
class AboutUsController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle="about us";
		$this->menuItemName="aboutus";
	}
}
?>