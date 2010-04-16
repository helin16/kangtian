<?php
class Project extends HydraEntity 
{
	/**
	 * @var ProjectImage
	 */
	protected $images;
	
	private $title;
	private $description;
	
	private $noOfBeds;
	private $noOfBaths;
	private $noOfCars;
	
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
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * setter fullText
	 *
	 * @var fullText
	 */
	public function setDescription($fullText)
	{
		$this->description = $fullText;
	}
	
	public function __toString()
	{
		return "<div class='content'><h3>{$this->getTitle()}</h3>{$this->getDescription()}</div>";
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
	
	/**
	 * getter noOfBeds
	 *
	 * @return noOfBeds
	 */
	public function getNoOfBeds()
	{
		return $this->noOfBeds;
	}
	
	/**
	 * setter noOfBeds
	 *
	 * @var noOfBeds
	 */
	public function setNoOfBeds($noOfBeds)
	{
		$this->noOfBeds = $noOfBeds;
	}
	
	/**
	 * getter noOfBaths
	 *
	 * @return noOfBaths
	 */
	public function getNoOfBaths()
	{
		return $this->noOfBaths;
	}
	
	/**
	 * setter noOfBaths
	 *
	 * @var noOfBaths
	 */
	public function setNoOfBaths($noOfBaths)
	{
		$this->noOfBaths = $noOfBaths;
	}
	
	/**
	 * getter noOfCars
	 *
	 * @return noOfCars
	 */
	public function getNoOfCars()
	{
		return $this->noOfCars;
	}
	
	/**
	 * setter noOfCars
	 *
	 * @var noOfCars
	 */
	public function setNoOfCars($noOfCars)
	{
		$this->noOfCars = $noOfCars;
	}
	
	public function getSnapshot($showTitle=false,$cssStyle="width:100%",$cssClass="projectSnap",$maxIntroLength=150,$id="",$imageWidth="280",$imageHight="160")
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
					{
						$asset = $image->getAsset();
						if($asset instanceof Asset)
						{
							$dimension = array("height"=>$imageHight,"width"=>$imageWidth);			
							$table .="<img style='width:100%;height:100%;border:none;margin:0px;padding:0px;' src='/asset/".$asset->getAssetId()."/".serialize($dimension)."' />";
						}
					}
					else
						$table .="No Images Found!";
				$table .="<td>";
			$table .="</tr>";
			$intro = $this->getDescription();
			$table .="<tr id='proSnapIntro'>";
					$table .="<td style='text-align:justify;'>";
						$table .=(strlen($intro)>$maxIntroLength ? substr($intro,0,$maxIntroLength)." ... " : $intro);
						$table .="<a style='color:#A40404;font-size:12px;text-decoration:underline;' href='/project/".str_replace(" ","_",$this->getTitle()).".html'>More</a>";
					$table .="</td>";
				$table .="</tr>";
		$table .="</table>";
		return $table;
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
		DaoMap::setStringType("description",'text');
		DaoMap::setIntType("noOfBeds");
		DaoMap::setIntType("noOfBaths");
		DaoMap::setIntType("noOfCars");
		DaoMap::setOneToMany("images","ProjectImage","pi");				
		
		DaoMap::defaultSortOrder("title");
		DaoMap::commit();
	}
}
?>