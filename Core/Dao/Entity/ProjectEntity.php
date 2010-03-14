<?php
class ProjectEntity extends Entity 
{
	/**
	 * getter CreatedBy
	 *
	 * @return CreatedBy
	 */
	public function getCreatedBy()
	{
		return $this->CreatedBy;
	}
	
	/**
	 * setter CreatedBy
	 *
	 * @var CreatedBy
	 */
	public function setCreatedBy($CreatedBy)
	{
		$this->CreatedBy = $CreatedBy;
	}
	
	/**
	 * getter UpdatedBy
	 *
	 * @return UpdatedBy
	 */
	public function getUpdatedBy()
	{
		return $this->UpdatedBy;
	}
	
	/**
	 * setter UpdatedBy
	 *
	 * @var UpdatedBy
	 */
	public function setUpdatedBy($UpdatedBy)
	{
		$this->UpdatedBy = $UpdatedBy;
	}
	
	protected function __meta()
	{
		parent::__meta();

		Map::setField($this,new ManyToOne("CreatedBy","UserAccount"));
		Map::setField($this,new ManyToOne("UpdatedBy","UserAccount"));
	}
}
?>