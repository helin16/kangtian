<?php
class ProjectsController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle="Projects";
	}
}
?>