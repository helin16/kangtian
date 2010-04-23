<?php

class ProjectController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="projects";
		$this->entityName="Project";
	}
	
	/**
	 * onLoad method
	 *
	 * @param $param
	 */
    public function onLoad($param)
    {
        parent::onLoad($param);
        
        if(!$this->IsPostBack || $param == "reload")
        {
	        $this->dataLoad();
        }
    }
    
	protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Project");
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId()."(pro.title like '%$searchString%' or pro.intro like '%$searchString%' or pro.fullText like '%$searchString%')",false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
    public function shortenText($text,$maxLength=150)
    {
    	if(strlen($text)>$maxLength)
    		return substr($text,0,$maxLength)." ... ";
    	return $text;
    }
    
    public function listImages(Project $project)
    {
    	$service = new BaseService("Asset");
    	$images = $service->findByCriteria("id in (select distinct pi.assetId from projectimage pi where pi.active = 1 and pi.projectId=".$project->getId().")");
    	
    	$newDimension = array(
    						"height"=>50,
    						"width"=>50
    					);
    	$html="";
    	foreach($images as $image)
    	{
    		$assetId = $image->getAssetId();
    		$html .="<img src='/asset/$assetId/".serialize($newDimension)."'style='border: 1px #cccccc solid;padding:5px;margin: 5px;' />";
    	}
    	return $html;
    }
}

?>
