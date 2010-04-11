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
	
	public function getSnapshot($showTitle=false,$cssStyle="width:100%",$cssClass="projectSnap",$maxIntroLength=150,$id="")
	{
		$table = "<table ".($id=="" ? "" : " id='$id'").($cssStyle=="" ? "" : " style='$cssStyle'").($cssClass=="" ? "" : " class='$cssClass'").">";
			if($showTitle)
			{
				$table .="<tr id='proSnapTitle'>";
					$table .="<td><h3>".$this->getTitle()."<h3><td>";
				$table .="</tr>";
			}
			$table .="<tr id='proSnapImage'>";
				$table .="<td align='center'>";
					$image = $this->getDefaultImage();
					if($image instanceof ProjectImage)
						$table .="<img style='width:100%;height:100%;border:none;margin:0px;padding:0px;' src='".$image->getPath()."/".$image->getImage()."' />";
					else
						$table .="No Images Found!";
				$table .="<td>";
			$table .="</tr>";
			$intro = $this->getIntro();
			$table .="<tr id='proSnapIntro'>";
					$table .="<td>";
						$table .=(strlen($intro)>$maxIntroLength ? substr($intro,0,$maxIntroLength)." ... " : $intro);
						$table .="<a style='color:#A40404;font-size:12px;text-decoration:underline;' href='/project/{$this->getTitle()}.html'>More</a>";
					$table .="</td>";
				$table .="</tr>";
		$table .="<table>";
	}
	
	public function getDefaultImage()
	{
		$images = $this->getImages();
		if(count($images)==0)
			return null;
		foreach($images as $image)
		{
			if($image->getIsDefault()==true)
				return $image;
		}
		return $images[0];
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