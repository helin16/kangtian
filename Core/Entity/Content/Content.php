<?php
class Content extends ProjectEntity 
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
	 * getter fulltext
	 *
	 * @return fulltext
	 */
	public function getfFullText()
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
		
	/**
	 * getter onFrontPage
	 *
	 * @return onFrontPage
	 */
	public function getOnFrontPage()
	{
		return $this->onFrontPage;
	}
	
	/**
	 * setter onFrontPage
	 *
	 * @var onFrontPage
	 */
	public function setOnFrontPage($onFrontPage)
	{
		$this->onFrontPage = $onFrontPage;
	}
	
	
	
	public function __toString()
	{
		return "<div class='content'><h3>{$this->gettitle()}</h3>{$this->getcontent()}</div>";
	}
	
	protected function __meta()
	{
		parent::__meta();

		Map::setField($this,new TString("title"));
		Map::setField($this,new TString("intro",12000));
		Map::setField($this,new TString("fullText",255,'','text'));
		Map::setField($this,new TInt('onFrontPage',1,1));
	}
}
?>