<?php

class QuickSearch extends TTemplateControl  
{
	public function onLoad($param)
	{
	}
	
	public function Search($sender,$param)
	{
		$searchText = trim($this->searchText->Text);
		$this->getPage()->getResponse()->redirect("/search/$searchText");
	}
}

?>