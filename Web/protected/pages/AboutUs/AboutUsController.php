<?php
class AboutUsController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle="about us";
	}
	
	protected function getBannerUrl()
	{
		return "/Theme/".$this->getDefaultThemeName()."/images/banner_aboutus.jpg";
	}
}
?>