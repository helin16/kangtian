<?php
class Module extends ProjectEntity 
{
	/**
	 * getter title
	 *
	 * @return title
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * setter title
	 *
	 * @var title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * getter position
	 *
	 * @return position
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	/**
	 * setter position
	 *
	 * @var position
	 */
	public function setPosition($position)
	{
		$this->position = $position;
	}
	
	/**
	 * getter content
	 *
	 * @return content
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * setter content
	 *
	 * @var content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	/**
	 * getter params
	 *
	 * @return params
	 */
	public function getParams()
	{
		return $this->params;
	}
	
	/**
	 * setter params
	 *
	 * @var params
	 */
	public function setParams($params)
	{
		$this->params = $params;
	}
	
	/**
	 * getter publish
	 *
	 * @return publish
	 */
	public function getPublish()
	{
		return $this->publish;
	}
	
	/**
	 * setter publish
	 *
	 * @var publish
	 */
	public function setPublish($publish)
	{
		$this->publish = $publish;
	}
	
	/**
	 * getter showtitle
	 *
	 * @return showtitle
	 */
	public function getShowtitle()
	{
		return $this->showtitle;
	}
	
	/**
	 * setter showtitle
	 *
	 * @var showtitle
	 */
	public function setShowtitle($showtitle)
	{
		$this->showtitle = $showtitle;
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
		return "<div class='module'><h3>{$this->gettitle()}</h3>{$this->getcontent()}</div>";
	}
	
	protected function __meta()
	{
		parent::__meta();
		
		Map::setField($this,new TString("title"));
		Map::setField($this,new TString("content",64000));
		Map::setField($this,new TString("params",64000));
		Map::setField($this,new TString("position"));
		Map::setField($this,new TString("phpClass"));
		Map::setField($this,new TInt('order',8,1));
		Map::setField($this,new TInt('showtitle',1,1));
	}
	
}
?>