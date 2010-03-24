<?php
class ContentLoaderController extends EshopPage 
{
	protected $preloadTitle;
	
	
	public function onLoad()
	{
		if($this->preloadTitle!="")
			$this->loadContent($this->preloadTitle);
		else if(isset($this->Request["title"]) && trim($this->Request["title"])!="")
			$this->loadContent($this->Request["title"]);
	}
	
	public function loadContent($title)
	{
		$contentService = new ContentService();
		$contents = $contentService->getContentByTitle($title);
		if(count($contents)==0)
		{
			$this->title->Text = "Page is not found for '$title'!";
			return;
		}
		
		$content = $contents[0];
		$this->title->Text =$content->getTitle();
		$this->text->Text =$content->getFullText();
	}
}
?>