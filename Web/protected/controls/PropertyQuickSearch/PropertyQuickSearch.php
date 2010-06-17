<?php

class PropertyQuickSearch extends TTemplateControl  
{
	public function onLoad($param)
	{
		$this->bindEntity($this->propertyTypeList,"PropertyType");
		$this->propertyTypeList->setSelectedValue(1);
		$this->bindPrice($this->minPrice);
		$this->bindPrice($this->maxPrice);
		$this->bindSuburb($this->suburbList);
		$this->bindEntity($this->buildingTypeList,"BuildingType");
	}
	
	public function bindEntity(&$list, $entityName)
	{
		$service = new BaseService($entityName);
		$list->DataSource = $service->findAll();
		$list->DataBind();
	}
	
	public function bindSuburb(&$list)
	{
		$sql="select distinct ucase(suburb) `suburb` from address where active = 1 order by suburb";
		$list->DataSource =Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
		$list->DataBind();
	}
	
	public function bindPrice(&$list)
	{
		$array=array();
		for($i=100;$i<1000;$i+=50)
		{
			
			$array[] = array($i*1000,"$$i,000");
		}
		
		for($i=1;$i<=10;$i++)
		{
			
			$array[] = array($i*1000000,"$$i,000,000");
		}
		$list->DataSource =$array;
		$list->DataBind();
	}
}

?>