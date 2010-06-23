<?php

class ProjectImagesControl extends TTemplateControl  
{
	public $projectId;
	
	public $thumbnail_dimension = array(
    						"height"=>90,
    						"width"=>150
    					);
	public $image_dimension = array(
    						"height"=>380,
    						"width"=>600
    					);
	
	public function onLoad($param)
	{
		if(!$this->Page->IsPostBack)
		{
			$this->loadImages($this->projectId);
		}
	}
	
	/**
	 * getter projectId
	 *
	 * @return projectId
	 */
	public function getProjectId()
	{
		return $this->projectId;
	}
	
	/**
	 * setter projectId
	 *
	 * @var projectId
	 */
	public function setProjectId($projectId)
	{
		$this->projectId = $projectId;
	}
	
	public function loadImages($projectId)
	{
		$service = new BaseService("Project");
		$project = $service->get($projectId);
		if(!$project instanceof Project)
			return;
			
		$sql ="select distinct ass.assetId
				from asset ass
				inner join projectimage pi on (pi.active = 1 and pi.assetId = ass.id and pi.projectId=$projectId)
				where ass.active = 1";
		$results = Dao::getResultsNative($sql);
		if(count($results)==0)
			return;
		
    	$this->projectImagesPanel_fullImage->ImageUrl="/asset/{$results[0][0]}/".serialize($this->image_dimension);
    					
		$html="<ul style='margin:0px;padding:0px;position:relative; list-style:none;'";
			foreach($results as $row)
			{
				$html .="<li>
							<img class='imageItem'
									src='/asset/{$row[0]}/".serialize($this->thumbnail_dimension)."' 
									OnClick=\"showFullImage_".$this->getClientId()."('{$row[0]}');\"
									style='border:1px #cccccc solid;padding:5px;'
									/>
						</li>";
			}
		$html .="</ul>";
		$this->projectImagesPanel_imageList->getControls()->add($html);
	}
}

?>