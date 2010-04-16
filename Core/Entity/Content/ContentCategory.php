<?php
class ContentCategory extends HydraEntity 
{
	private $name;
	
	protected $contents;
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
	
	/**
	 * getter contents
	 *
	 * @return contents
	 */
	public function getContents()
	{
		return $this->contents;
	}
	
	/**
	 * setter contents
	 *
	 * @var contents
	 */
	public function setContents($content)
	{
		$this->contents = $content;
	}
	
	public function __toString()
	{
		return $this->name;
	}
	
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'concat');
		
		DaoMap::setStringType('name');
		DaoMap::setManyToMany("contents","Content",DaoMap::LEFT_SIDE,"con");
		DaoMap::commit();
	}
}
?>