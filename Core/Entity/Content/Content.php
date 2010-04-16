<?php
class Content extends HydraEntity 
{
	private $title;
	private $text;
	
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
	 * getter fulltext
	 *
	 * @return fulltext
	 */
	public function getText()
	{
		return $this->text;
	}
	
	/**
	 * setter fullText
	 *
	 * @var fullText
	 */
	public function setText($fullText)
	{
		$this->text = $fullText;
	}
	
	public function __toString()
	{
		return "<div class='content'><h3>{$this->getTitle()}</h3>{$this->getText()}</div>";
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'con');
		
		DaoMap::setStringType('title','varchar',256);
		DaoMap::setStringType("text",'text');
		
		DaoMap::defaultSortOrder("title");
		
		DaoMap::commit();
	}
}
?>