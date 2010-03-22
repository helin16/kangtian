<?php
class EshopPage extends TPage 
{
	public function onPreInit($param)
	{
		parent::onPreInit($param);
		$layout = Config::get("theme","name");
		$this->getPage()->setMasterClass("Application.theme.$layout.layout.DefaultLayout");
	}
	
	public function setTitle($value)
	{
		$temp = $this->getApplication()->getParameters();
		if($temp->contains("AppTitle"))
		{
			$param = $temp->toArray();
			parent::setTitle($param["AppTitle"]." - ".$value);
		}
		else
			parent::setTitle($value);
	}
}
?>