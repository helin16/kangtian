<?php

class ProjectController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
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
    
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Project");
    	$result =  $service->findAll(false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Project");
    	$result =  $service->findByCriteria("(pro.title like '%$searchString%' or pro.intro like '%$searchString%' or pro.fullText like '%$searchString%')",false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function lookupEntity($id)
	{
		$service = new BaseService("Project");
		return $service->get($id);
	}
    
    public function shortenText($text,$maxLength=150)
    {
    	if(strlen($text)>$maxLength)
    		return substr($text,0,$maxLength)." ... ";
    	return $text;
    }
    
    protected function saveEntity(HydraEntity $entity)
    {
    	$service = new BaseService("Project");
    	$service->save($entity);
    }
}

?>
