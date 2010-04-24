<?php

class ContentListControl extends TPanel  
{
	public $categoryId=1;
	public $noOfItems=4;
	public $subTitle="";
	
	/**
	 * getter categoryId
	 *
	 * @return categoryId
	 */
	public function getCategoryId()
	{
		return $this->categoryId;
	}
	
	/**
	 * setter categoryId
	 *
	 * @var categoryId
	 */
	public function setCategoryId($categoryId)
	{
		$this->categoryId = $categoryId;
	}
	
	/**
	 * getter subTitle
	 *
	 * @return subTitle
	 */
	public function getSubTitle()
	{
		return $this->subTitle;
	}
	
	/**
	 * setter subTitle
	 *
	 * @var subTitle
	 */
	public function setSubTitle($subTitle)
	{
		$this->subTitle = $subTitle;
	}
	
	public function getNewsList($categoryId,$noOfItems=4,$subtitle="")
	{
		$service = new BaseService("ContentCategory");
		$category = $service->get($categoryId);
		if(!$category instanceof ContentCategory)
			return;
		
		$qry = "select c.id,c.title from content c
				inner join content_contentcategory x on (x.contentId = c.id and x.contentCategoryId = $categoryId)
				where c.active = 1
				order by c.id desc
				limit $noOfItems";
		$results = Dao::getResultsNative($qry,array(),PDO::FETCH_ASSOC);
		if(count($results)==0)
			return;
			
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr>";
				$html .= "<td style='font-weight:bold;color:#000000;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;font-size:24px;padding: 10px 0 20px 0;'>";
					$html .=$category->getName();
					if($subtitle!="")
						$html .="<br /><i style='color:#AC7755;font-size:16px;font-family:cursive;font-weight:normal;'>$subtitle</i>";
				$html .= "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td style='font-size:13px;text-align: justify;padding: 0 0 20px 0;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;'>";
					$html .= "<ul style='margin:0px;padding:0px 0px 0px 18px;'>";
						foreach($results as $row)
						{
							$html .= "<li style='padding:0 0 5px 0;'>";
								$title = str_replace(" ","_",trim($row["title"]));
								$html .= "<a href='/content/$title.html' style=\"color:#BF3A17;\">{$row["title"]}</a>";
							$html .= "</li>";
						}
					$html .= "</ul>";
				$html .= "</td>";
			$html .= "</tr>";
		$html .= "</table>";
		return $html;
	}
	
	/**
	 * Renders the closing tag for the control
	 * @param THtmlWriter the writer used for the rendering purpose
	 */
	public function renderEndTag($writer)
	{
		$writer->write($this->getNewsList($this->categoryId,$this->noOfItems,$this->subTitle));
		parent::renderEndTag($writer);
	}
}

?>