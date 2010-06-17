<?php
class BuildingType extends HydraEntity 
{
	private $name;
	
	/**
	 * getter name
	 *
	 * @return name
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * setter name
	 *
	 * @var name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'bt');
		
		DaoMap::setStringType('name','varchar',256);
		
		DaoMap::defaultSortOrder("name");
		DaoMap::commit();
	}
}
?>