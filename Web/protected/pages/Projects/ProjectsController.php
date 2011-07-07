<?php
class ProjectsController extends EshopPage  
{
	public $totalRows;
	public $searchCriteira;
	
	public function __construct()
	{
		parent::__construct();
		$this->totalRows=0;
		
		if(isset($this->Request["searchby"]) && trim($this->Request["searchby"])!="")
			$this->title = ucfirst(trim($this->Request["searchby"]));
		else
			$this->title = "Search Result";
			
		$this->searchCriteira=array(
				"propertyTypeIds"=>$this->onInitFunc("propertyTypeIds"),
				"buildingTypeIds"=>$this->onInitFunc("buildingTypeIds"),
				"buildingStatusIds"=>$this->onInitFunc("buildingStatusIds"),
				"maxPrice"=>$this->onInitFunc("maxPrice"),
				"minPrice"=>$this->onInitFunc("minPrice"),
				"suburbs"=>$this->onInitFunc("suburbs")
			);
		$this->menuItemName="projects";
		if(in_array(strtolower($this->title),array("buying","selling","renting","projects")))
		{
			$this->menuItemName=strtolower($this->title);
			switch(strtolower($this->title))
			{
				case "buying":
					{
						$this->searchCriteira["propertyTypeIds"]=array(1,2);
						break;
					}
				case "renting":
					{
						$this->searchCriteira["propertyTypeIds"]=array(3);
						break;
					}
				case "projects":
					{
						$this->searchCriteira["propertyTypeIds"]=array(4);
						break;
					}
			}
		}
			
	}
	
	public function onInitFunc($varname)
	{
		if(!isset($this->Request[$varname]))
			return "all";
		$array =  explode(",",trim($this->Request[$varname]));
		return in_array("all",$array) ? "all" : $array;
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
    	
     	$data = $this->searchEntity($pageNumber,$pageSize);

     	$this->DataList->DataSource = $data; 
    	$totalSize = $this->totalRows;
     	$this->DataList->VirtualItemCount = $totalSize;
     	
     	$this->DataList->dataBind();

    	if($this->DataList->getPageCount() > 1)
	    	$this->PaginationPanel->Visible = true;	  	
	    	 
     	return $data;
    }  
    
	protected function searchEntity($pageNumber=null,$pageSize=null)
    {
    	$propertyTypeIds = $this->searchCriteira["propertyTypeIds"];
    	$buildingTypeIds = $this->searchCriteira["buildingTypeIds"];
    	$buildingStatusIds = $this->searchCriteira["buildingStatusIds"];
    	$maxPrice = $this->searchCriteira["maxPrice"];
    	$minPrice = $this->searchCriteira["minPrice"];
    	$suburbs = $this->searchCriteira["suburbs"];    	

    	$where = "pro.active = 1";
    	
    	if($propertyTypeIds !="all" && count($propertyTypeIds)!=0)
    		$where .= " AND pro.propertyTypeId in (".implode(",",$propertyTypeIds).")";
    		
    	if($buildingTypeIds !="all" && count($buildingTypeIds)!=0)
    		$where .= " AND pro.buildingTypeId in (".implode(",",$buildingTypeIds).")";
    		
    	if($buildingStatusIds !="all" && count($buildingStatusIds)!=0)
    		$where .= " AND pro.buildingStatusIds in (".implode(",",$buildingStatusIds).")";
    		
    	if($maxPrice !="all")
    		$where .= " AND pro.price <= '$maxPrice'";
    	if($minPrice !="all")
    		$where .= " AND pro.price >= '$minPrice'";
    		
    	if($suburbs !="all" && count($suburbs)!=0)
    		$where .= " AND ucase(addr.suburb) in (ucase('".implode("'),ucase('",$suburbs)."'))";
    	
		$sql ="select distinct pro.id
				from project pro
				left join address addr on (pro.addressId = addr.id)
				where $where";
    	$ids = array();
    	foreach(Dao::getResultsNative($sql) as $row)
    	{
    		$ids[] = $row[0];
    	}
    	if(count($ids)==0)
    	{
    		$this->setInfoMsg("No Result Found!");
    		return;
    	}
    	
    	$service = new BaseService("Project");
    	$result =  $service->findByCriteria("id in (".implode(",",$ids).")",true,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function toPerformSearch()
    {
    	return false;
    }
}
?>