<?php

class Menu extends TTemplateControl
{
	public $cssClass="";
	
	public function onLoad($param)
	{
		if($this->cssClass!="")
			$this->menu->setCssClass($this->cssClass);
	}
	
	/**
	 * getter cssClass
	 *
	 * @return cssClass
	 */
	public function getcssClass()
	{
		return $this->cssClass;
	}
	
	/**
	 * setter cssClass
	 *
	 * @var cssClass
	 */
	public function setcssClass($cssClass)
	{
		$this->cssClass = $cssClass;
	}
	
	
}

?>