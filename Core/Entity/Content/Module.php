<?php
class Module extends ProjectEntity 
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
	 * getter Position
	 *
	 * @return Position
	 */
	public function getPosition()
	{
		return $this->Position;
	}
	
	/**
	 * setter Position
	 *
	 * @var Position
	 */
	public function setPosition($Position)
	{
		$this->Position = $Position;
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
	 * getter Params
	 *
	 * @return Params
	 */
	public function getParams()
	{
		return $this->Params;
	}
	
	/**
	 * setter Params
	 *
	 * @var Params
	 */
	public function setParams($Params)
	{
		$this->Params = $Params;
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
	 * getter ShowTitle
	 *
	 * @return ShowTitle
	 */
	public function getShowTitle()
	{
		return $this->ShowTitle;
	}
	
	/**
	 * setter ShowTitle
	 *
	 * @var ShowTitle
	 */
	public function setShowTitle($ShowTitle)
	{
		$this->ShowTitle = $ShowTitle;
	}
		
	/**
	 * getter phpClass
	 *
	 * @return phpClass
	 */
	public function getPhpClass()
	{
		return $this->phpClass;
	}
	
	/**
	 * setter phpClass
	 *
	 * @var phpClass
	 */
	public function setPhpClass($phpClass)
	{
		$this->phpClass = $phpClass;
	}
	
	
	public function __toString()
	{
		return "<div class='module'><h3>{$this->getTitle()}</h3>{$this->getContent()}</div>";
	}
	
	protected function __meta()
	{
		parent::__meta();
		
		Map::setField($this,new TString("Title"));
		Map::setField($this,new TString("Content",64000));
		Map::setField($this,new TString("Params",64000));
		Map::setField($this,new TString("Position"));
		Map::setField($this,new TString("phpClass"));
		Map::setField($this,new TInt('order',8,1));
		Map::setField($this,new TInt('ShowTitle',1,1));
		Map::setField($this,new TInt('Publish',1,1));
	}
	
}
?>