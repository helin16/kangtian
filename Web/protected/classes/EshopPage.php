<?php
class EshopPage extends TPage 
{
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
	}
	
	public function getDefaultThemeName()
	{
		return Config::get("theme","name");
	}
	
	protected function getBanner()
	{
		return "<img src='/Theme/".$this->getDefaultThemeName()."/images/banner.jpg' />";
	}
}
?>