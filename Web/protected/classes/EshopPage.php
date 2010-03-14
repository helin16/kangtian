<?php
class EshopPage extends TPage 
{
	public function onPreInit($param)
	{
		parent::onPreInit($param);
		$layout = Config::get("theme","name");
		$this->getPage()->setMasterClass("Application.theme.$layout.layout.DefaultLayout");
	}
}
?>