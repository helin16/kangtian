<?php
require_once dirname(__FILE__).'/../ContentLoader/ContentLoaderController.php';
class AboutUsController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle="aboutus";
	}
}
?>