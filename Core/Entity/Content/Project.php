<?php
class Project extends HydraEntity 
{
	/**
	 * @var ProjectImage
	 */
	protected $images;
	
	private $title;
	private $fullText;
	private $intro;
	
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
	public function getFullText()
	{
		return $this->fullText;
	}
	
	/**
	 * setter fullText
	 *
	 * @var fullText
	 */
	public function setFullText($fullText)
	{
		$this->fullText = $fullText;
	}
	
	/**
	 * getter intro
	 *
	 * @return intro
	 */
	public function getIntro()
	{
		return $this->intro;
	}
	
	/**
	 * setter intro
	 *
	 * @var intro
	 */
	public function setIntro($intro)
	{
		$this->intro = $intro;
	}
	
	public function __toString()
	{
		return "<div class='content'><h3>{$this->gettitle()}</h3>{$this->getcontent()}</div>";
	}
	
	/**
	 * getter images
	 *
	 * @return images
	 */
	public function getImages()
	{
		$this->loadOneToMany("images");
		return $this->images;
	}
	
	/**
	 * setter images
	 *
	 * @var images
	 */
	public function setImages($images)
	{
		$this->images = $images;
	}
		
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'pro');
		
		DaoMap::setStringType('title','varchar',256);
		DaoMap::setStringType('intro','varchar',12000);
		DaoMap::setStringType("fullText",'text');
		DaoMap::setOneToMany("images","ProjectImage","pi");				
		
		DaoMap::defaultSortOrder("title");
		DaoMap::commit();
	}
}
?>