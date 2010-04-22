<?php

class LanguageChanger extends TTemplateControl  
{
	public function onLoad($param)
	{
	}
	
	public function changeLanguage($sender,$param)
	{
		$lang = $param->CommandParameter;
//		$info = new CultureInfo();
//        if($info->validCulture($lang)) //only valid lang is permitted
            $this->getApplication()->getGlobalization()->setCulture($lang);
         $_SESSION["language"] = $lang;
	}
}

?>