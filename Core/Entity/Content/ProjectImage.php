<?php
class ProjectImage extends HydraEntity 
{
	/**
	 * @var String
	 */
	private $path;
	/**
	 * @var String
	 */
	private $image;
	
	private $isDefault;
	
	/**
	 * @var Project
	 */
	protected $project;
	
	/**
	 * getter path
	 *
	 * @return path
	 */
	public function getPath()
	{
		return $this->path;
	}
	
	/**
	 * setter path
	 *
	 * @var path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}
	
	/**
	 * getter image
	 *
	 * @return image
	 */
	public function getImage()
	{
		return $this->image;
	}
	
	/**
	 * setter image
	 *
	 * @var image
	 */
	public function setImage($image)
	{
		$this->image = $image;
	}
	
	/**
	 * getter isDefault
	 *
	 * @return isDefault
	 */
	public function getIsDefault()
	{
		return $this->isDefault;
	}
	
	/**
	 * setter isDefault
	 *
	 * @var isDefault
	 */
	public function setIsDefault($isDefault)
	{
		$this->isDefault = $isDefault;
	}
	
	
	/**
	 * getter project
	 *
	 * @return project
	 */
	public function getProject()
	{
		$this->loadManyToOne("project");
		return $this->project;
	}
	
	/**
	 * setter project
	 *
	 * @var project
	 */
	public function setProject($project)
	{
		$this->project = $project;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'pi');
		
		DaoMap::setStringType('path','varchar',256);
		DaoMap::setStringType('image','varchar',256);
		DaoMap::setBoolType("isDefault");
		DaoMap::setManyToOne("project","Project");
		
		DaoMap::commit();
	}
}
?>