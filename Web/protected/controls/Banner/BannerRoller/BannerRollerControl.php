<?php

class BannerRollerControl extends TPanel  
{
	public $noOfItems=4;
	public $timeOutSecs = 5;//the no of secs between each slide
	public $pageLanguageId = 1;	
	
	private $defaultBanner ="<img src='/Theme/default/images/banner.jpg'/>";
	
	public function __construct()
	{
		parent::__construct();
		try{
			$this->pageLanguageId = Core::getPageLanguage()->getId();
			$sql = "select count(distinct id) `count` from banner where active=1 and assetId!=0 and languageId=".$this->pageLanguageId;
			$result = Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
			$this->noOfItems = $result[0]['count'];
		}
		catch(Exception $ex)
		{
			$this->noOfItems=0;
		}
	}
	
	/**
	 * getter noOfItems
	 *
	 * @return noOfItems
	 */
	public function getNoOfItems()
	{
		return $this->noOfItems;
	}
	
	/**
	 * setter noOfItems
	 *
	 * @var noOfItems
	 */
	public function setNoOfItems($noOfItems)
	{
		//if there are less banner in the database than wantted
		//then only show the ones in D.B.
		if($this->noOfItems<$noOfItems)
			return;
		$this->noOfItems = $noOfItems;
	}
	
	/**
	 * getter timeOutSecs
	 *
	 * @return timeOutSecs
	 */
	public function getTimeOutSecs()
	{
		return $this->timeOutSecs;
	}
	
	/**
	 * setter timeOutSecs
	 *
	 * @var timeOutSecs
	 */
	public function setTimeOutSecs($timeOutSecs)
	{
		$this->timeOutSecs = $timeOutSecs;
	}
	
	/**
	 * getter pageLanguageId
	 *
	 * @return pageLanguageId
	 */
	public function getPageLanguageId()
	{
		return $this->pageLanguageId;
	}
	
	/**
	 * setter pageLanguageId
	 *
	 * @var pageLanguageId
	 */
	public function setPageLanguageId($pageLanguageId)
	{
		$this->pageLanguageId = $pageLanguageId;
	}
	
	public function renderEndTag($writer)
	{
		$writer->write($this->loadBanners($this->noOfItems,$this->getWidth(),$this->getHeight()));
		parent::renderEndTag($writer);
	}
	
	public function loadBanners($noOfItems=4,$width=685,$height=253)
	{
		$width = trim($width);
		$width = ($width=="" ? 685 : $width);
		
		$height = trim($height);
		$height = ($height=="" ? 253 : $height);
		
		if($noOfItems==0) 
			return $this->defaultBanner;
			
		$service = new BaseService("Banner");
		$banners = $service->findByCriteria("ba.assetId!=0 and ba.languageId=".$this->pageLanguageId,true,1,$noOfItems,array("Banner.updated"=>"desc"));
		if(count($banners)==0 ) 
			return $this->defaultBanner;
			
		$clientId = $this->getClientID();
		$javascript ="
					<style>
						ul#slide-images-$clientId
						{
							position:relative;
							display:block;
							margin:0px;
							padding:0px;
							width:{$width}px;
							height:{$height}px;
							overflow:hidden;
						}
						ul#slide-images-$clientId li
						{
							position:absolute;
							display:block;
							list-style-type:none;
							margin:0px;
							padding:0px;
							width:{$width}px;
							height:{$height}px;
							background-color:#FFFFFF;
							top:0px;
						}
						
						ul#slide-images-$clientId li a,
						ul#slide-images-$clientId li a img
						{
							display:block;
							background-color:#FFFFFF;
							margin:0px;
							padding:0px;
							height:{$height}px;
							width:{$width}px;
						}
						
						div.slide-images-title-$clientId
						{
							position: relative;
							top:-30px;
							-moz-opacity: 0.7;
							opacity:.70;
							filter: alpha(opacity=70);
							background-color: #eeeeee;
							color:#BF3A17;
							font-size:18px;
							font-weight:bold;
							height:20px;
							top:-33px;
							padding:5px 0 5px 20px;
							width:{$width}px;
						}
					</style>
							
					<script type='text/javascript'>
						var delay_$clientId = {$this->timeOutSecs} * 1000;
						var start_frame_$clientId = 0;
						
						function init() 
						{
							var lis = $('slide-images-$clientId').getElementsByTagName('li');
							for( i=0; i < lis.length; i++)
							{
								if(i!=0)
								{
									lis[i].style.display = 'none';
								}
							}
							end_frame = lis.length -1;
							start_slideshow(start_frame_$clientId, end_frame, delay_$clientId, lis);
						}
						function start_slideshow(start_frame, end_frame, delay, lis) 
						{
							setTimeout(fadeInOut(start_frame,start_frame,end_frame, delay, lis), delay);
						}
						
						function fadeInOut(frame, start_frame, end_frame, delay, lis) 
						{
							return (function() 
							{
								lis = $('slide-images-$clientId').getElementsByTagName('li');
								Effect.Fade(lis[frame]);
								if (frame == end_frame) { frame = start_frame; } else { frame++; }
								lisAppear = lis[frame];
								setTimeout(\"Effect.Appear(lisAppear);\", 0);
								setTimeout(fadeInOut(frame, start_frame, end_frame, delay), delay + 1850);
							})
							
						}
						
						Event.observe(window, 'load', init, false);
					</script>
					";
		
		//cavas div
		$html="$javascript
			<ul id='slide-images-$clientId'>";
			$dimenstion = array("width"=>$width,"height"=>$height);
			$index=1;
			foreach($banners as $banner)
			{
				$assetId = $banner->getAsset()->getAssetId();
				$url = $banner->getUrl();
					$html.="<li>";
						$html.="<a href='$url'>";
							$html.="<img src='/asset/$assetId/".serialize($dimenstion)."' style='border:none;margin:0px;padding:0px;'/>";
						$html.="</a>";
						$html .="<div class='slide-images-title-$clientId'>";
							$html .=$banner->getDescription();
						$html .="</div>";
						
					$html.="</li>";
				$index++;
			}
		
		$html.="</ul>";
		
		return $html;
	}
}

?>