<?php
class ProjectsController extends EshopPage  
{
	public $totalRows;
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="projects";
		$this->totalRows=0;
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
    
    public function getDefaultImage(Project $project)
    {
    	$newDimension = array(
    						"height"=>164,
    						"width"=>295
    					);
    	$image =$project->getDefaultImage();
    	if(!$image instanceof ProjectImage)
    		return;
    		
    	$showingAsset = $image->getAsset();
    	if(!$showingAsset instanceof Asset)
    		return;
    	$showingAssetId = $showingAsset->getAssetId();
    	return "/asset/$showingAssetId/".serialize($newDimension);
    }
    
	public function shortenText($text,$maxLength=150)
    {
    	if(strlen($text)>$maxLength)
    		return substr($text,0,$maxLength)." ... ";
    	return $text;
    }
    
    public function getUrl($title)
    {
    	return str_replace(" ","_",strtolower(trim($title)));
    }
}
?>