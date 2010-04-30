<?php
class SearchController extends EshopPage  
{
	public $totalRows;
	public $searchText;
	
	public function __construct()
	{
		parent::__construct();
		$this->totalRows=0;
		$this->searchText = trim(isset($this->Request["searchcontent"])? $this->Request["searchcontent"] : "");
	}
	
	public function onLoad($param)
    {
        parent::onLoad($param);
        
        if(!$this->IsPostBack || $param == "reload")
        {
        	if($this->searchText=="")
        	{
        		$this->getMaster()->errorMsg->Text ="Nothing to search!";
        		return;
        	}
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
    	$sql ="select sql_calc_found_rows temp.`id`,temp.`entity` from 
    		(
    			(select distinct con.id,'Content' as `entity` from content con where con.active = 1 and con.languageId=".Core::getPageLanguage()->getId()." and (con.title like '%".$this->searchText."%' or con.text like '%".$this->searchText."%'))
    			union
    			(select distinct pro.id,'Project' as `entity` from project pro where pro.active = 1 and pro.languageId=".Core::getPageLanguage()->getId()." and (pro.title like '%".$this->searchText."%' or pro.description like '%".$this->searchText."%'))
    		) as temp
    		limit ".($pageNumber-1)*$pageSize.", $pageSize";
//    	debug::inspect($sql);die;
    	$result = Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
    	
    	$sql = "select found_rows()";
    	$count = Dao::getResultsNative($sql);
    	$this->totalFound->Text = $this->totalRows = $count[0][0];
    	return $result;
    }
    
	protected function toPerformSearch()
    {
    	return false;
    }
    
    public function getUrl($title)
    {
    	return str_replace(" ","_",strtolower(trim($title)));
    }
}
?>