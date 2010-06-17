<?php

class Home extends EshopPage
{
	public function onLoad($param)
	{
		if(!$this->isPostBack)
		{
			$this->setTitle("Home");
		}
	}
	
	protected function getBanner()
	{
		$defaultImage = "";
//		$defaultImage = "<img src='/Theme/".$this->getDefaultThemeName()."/images/banner.jpg'/>";
		try{
			$sql = "select count(distinct id) `count` from banner where active=1 and assetId!=0 and languageId=".core::getPageLanguage()->getId();
			$result = Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
			$count=$result[0]['count'];
			if($count==0)
			{
				$this->bannerRoller->Visible=false;
				return $defaultImage;
			}
				
			return ""; 
		}
		catch(Exception $ex)
		{
			$this->bannerRoller->Visible=false;
			return $defaultImage;
		}
	}
}

?>