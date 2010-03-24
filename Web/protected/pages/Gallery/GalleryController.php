<?php
class GalleryController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle="gallery";
	}
}
?>