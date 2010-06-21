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
		return "";
	}
}

?>