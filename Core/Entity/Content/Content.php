<?php
class Content extends ProjectEntity 
{
	/**
	 * getter Title
	 *
	 * @return Title
	 */
	public function getTitle()
	{
		return $this->Title;
	}
	
	/**
	 * setter Title
	 *
	 * @var Title
	 */
	public function setTitle($Title)
	{
		$this->Title = $Title;
	}
	
	/**
	 * getter Content
	 *
	 * @return Content
	 */
	public function getContent()
	{
		return $this->Content;
	}
	
	/**
	 * setter Content
	 *
	 * @var Content
	 */
	public function setContent($Content)
	{
		$this->Content = $Content;
	}
		
	/**
	 * getter Publish
	 *
	 * @return Publish
	 */
	public function getPublish()
	{
		return $this->Publish;
	}
	
	/**
	 * setter Publish
	 *
	 * @var Publish
	 */
	public function setPublish($Publish)
	{
		$this->Publish = $Publish;
	}
	
	/**
	 * getter OnFrontPage
	 *
	 * @return OnFrontPage
	 */
	public function getOnFrontPage()
	{
		return $this->OnFrontPage;
	}
	
	/**
	 * setter OnFrontPage
	 *
	 * @var OnFrontPage
	 */
	public function setOnFrontPage($OnFrontPage)
	{
		$this->OnFrontPage = $OnFrontPage;
	}
	
	
	
	public function __toString()
	{
		return "<div class='module'><h3>{$this->getTitle()}</h3>{$this->getContent()}</div>";
	}
	
	protected function __meta()
	{
		parent::__meta();

		Map::setField($this,new TString("Title"));
		Map::setField($this,new TString("Content"));
		Map::setField($this,new TInt('Publish',1,1));
		Map::setField($this,new TInt('OnFrontPage',1,1));
	}
}
?>