<?php
class ProjectsController extends EshopPage  
{
	public $totalRows;
	public function __construct()
	{
		parent::__construct();
		$this->totalRows=0;
		
		if(isset($this->Request["searchby"]) && trim($this->Request["searchby"])!="")
			$this->title = ucfirst(trim($this->Request["searchby"]));
		else
			$this->title = "Search Result";
			
		$this->menuItemName="projects";
		if(in_array(strtolower($this->title),array("buying","selling","renting","projects")))
			$this->menuItemName=strtolower($this->title);
	}
	
	public function onLoad($param)
    {
        parent::onLoad($param);
        
        if(!$this->IsPostBack || $param == "reload")
        {
        	$this->PaginationPanel->Visible = false;
			$this->dataLoad();    	
        }
    }
    
    public function dataLoad($pageNumber=null,$pageSize=null)
    {
    	if($pageNumber == null)
    		$pageNumber = $this->DataList->CurrentPageIndex + 1;
    	
    	if($pageSize == null)
    		$pageSize = $this->DataList->pageSize;   	
    	
     	if(!$this->toPerformSearch())
     		$data = $this->getAllOfEntity($focusObject,$pageNumber,$pageSize);    
     	else
     		$data = $this->searchEntity($this->SearchString->Value,$focusObject,$pageNumber,$pageSize);

     	$this->DataList->DataSource = $data; 
    	$totalSize = $this->totalRows;
     	$this->DataList->VirtualItemCount = $totalSize;
     	
     	$this->DataList->dataBind();

    	if($this->DataList->getPageCount() > 1)
	    	$this->PaginationPanel->Visible = true;	  	
	    	 
     	return $data;
    }  
    
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Project");
    	$result =  $service->findByCriteria("languageId=".Core::getPageLanguage()->getId(),true,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function toPerformSearch()
    {
    	return false;
    }
}
?>