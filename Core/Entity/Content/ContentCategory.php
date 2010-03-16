<?php
class ContentCategory extends ProjectEntity 
{
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
		return $this->content;
	}
	
	/**
	 * setter contents
	 *
	 * @var contents
	 */
	public function setContents($content)
	{
		$this->content = $content;
	}
	
	public function __toString()
	{
		return $this->name;
	}
	
	protected function __meta()
	{
		parent::__meta();

		Map::setField($this,new TString("name"));
		Map::setField($this,new ManyToMany("content","Content","contentCategory"));
	}
}
?>