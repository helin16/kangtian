<?php
class Content extends HydraEntity 
{
	private $title;
	private $text;
	
	/**
	 * @var PageLanguage
	 */
	protected $language;
	
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
	
	/**
	 * getter language
	 *
	 * @return language
	 */
	public function getLanguage()
	{
		$this->loadManyToOne("language");
		return $this->language;
	}
	
	/**
	 * setter language
	 *
	 * @var language
	 */
	public function setLanguage($language)
	{
		$this->language = $language;
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
		
		DaoMap::setManyToOne("language","PageLanguage","pl");
		
		DaoMap::defaultSortOrder("title");
		
		DaoMap::commit();
	}
}
?>