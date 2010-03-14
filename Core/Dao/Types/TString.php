<?php

class TString extends BaseDescriptor
{
	public function __construct($field,$width = 30,$default='')
	{
		parent::__construct($field,'varchar',$width,$default);
	}	

	public function makeValue($value)
	{
		return "'".(string)$value."'";
	}
}

?>