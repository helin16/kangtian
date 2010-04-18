<?php
class AboutUsController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle="about us";
		$this->menuItemName="aboutus";
	}
	
	protected function getBanner()
	{
		return "<img src='/Theme/".$this->getDefaultThemeName()."/images/banner_aboutus.jpg' />";
	}
}
?>