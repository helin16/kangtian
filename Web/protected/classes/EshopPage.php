<?php
class EshopPage extends TPage 
{
	public $menuItemName;
	protected $title;
	
	public function __construct()
	{
		parent::__construct();
		if(isset($_SESSION["language"]))
		 $this->getApplication()->getGlobalization()->setCulture($_SESSION["language"]);
	}
	
	
	public function onPreInit($param)
	{
		parent::onPreInit($param);
		$layout = $this->getDefaultThemeName();
		$this->getPage()->setMasterClass("Application.theme.$layout.layout.DefaultLayout");
	}
	
	public function setTitle($value)
	{
		$temp = $this->getApplication()->getParameters();
		$extra =" - Australian Realty, Property and Projects, Melbourne,Brisbane,Sydney";
		if($temp->contains("AppTitle"))
		{
			$param = $temp->toArray();
			parent::setTitle($param["AppTitle"]." - ".$value.$extra);
		}
		else
			parent::setTitle($value.$extra);
			
		$this->title = $value;
	}
	
	public function getDefaultThemeName()
	{
		return Config::get("theme","name");
	}
	
	protected function getBanner()
	{
		$index = rand(1,2);
		$html ="<div style='paddding:0px; marging:0px;position:relative;height:150px;'>";
			$html .="<img src='/Theme/default/images/title_banner_bg_$index.jpg' />";
			$html .="<div style='position: relative;top:-30px;-moz-opacity: 0.7;opacity:.70;filter: alpha(opacity=70);background-color: #eeeeee;color:#BF3A17;font-size:18px;font-weight:bold;height:20px;top:-33px;padding:5px 0 5px 20px;'>";
				$html .=$this->title;
			$html .="</div>";
		$html .="</div>";
		return $html;
	}
}
?>