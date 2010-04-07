<?php

class CRUDPage extends AdminPage 
{
	public $totalRows;
	
	protected function lookupEntity($id)
	{
		return;
	}
	
    protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	return null;
    }
    
    protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	return null;
    }
    
	public function __construct()
	{
		parent::__construct();
		$this->totalRows=0;
	}

	public function onLoad($param)
    {
       	parent::onLoad($param);
       	
        $this->setInfoMessage("");
        $this->setErrorMessage("");        
		$this->PaginationPanel->Visible = false;
    }
    
    
    protected function toPerformSearch()
    {
    	return $this->SearchText->Text != "";
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

     	$size = sizeof($data);
     	$this->DataList->DataSource = $data; 
    	$totalSize = $this->howBigWasThatQuery() ;
     	$this->DataList->VirtualItemCount = (is_numeric($totalSize) && $totalSize>0) ? $totalSize : 0;
     	
     	$this->DataList->dataBind();

    	if($this->DataList->getPageCount() > 1)
	    	$this->PaginationPanel->Visible = true;	  	 
     	
     	return $data;
    }   

    protected function howBigWasThatQuery()
    {
    	return $this->totalRows;
    }
    
    
    public function cancel($sender,$param)
    {
		$this->AddPanel->Visible = false;
		$this->DataList->EditItemIndex = -1;
		$this->dataLoad();    	
    }
    
    public function search($sender,$param)
    {
     	$searchQueryString = $this->SearchText->Text;
		$this->SearchString->Value = $searchQueryString;
     	
		$this->DataList->EditItemIndex = -1;
		$this->dataLoad();
    }    

    public function pageChanged($sender, $param)
    {   	
    	$this->AddPanel->Visible = false;
    	$this->DataList->EditItemIndex = -1;
      	$this->DataList->CurrentPageIndex = $param->NewPageIndex;
      	$this->dataLoad();
    }

    protected function entitiesToArray(array $entities)
    {
		$selected = array();
		foreach($entities as $entity)
			$selected[] = $entity->getId();

		return $selected;
    }

    
    /**
     * Toggle the Active flag in DataList
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	protected function toggleActive($sender,$param)
	{
		$entity = $this->lookupEntity($sender->Parent->Parent->DataKeys[$sender->Parent->ItemIndex]);
    	$entity->setActive($sender->Parent->Active->Checked);
		$this->saveEntity($entity);
		
		$this->dataLoad();
	}
	
	/**
	 * Bind data to a DropDownList
	 *
	 * @param TDropDownList $listToBind
	 * @param array[] HydraEntity $dataSource
	 * @param HydraEntity $selectedItem
	 * @param bool $enable
	 */
	protected function bindDropDownList(&$listToBind, $dataSource, $selectedItem = null, $enable = true)
	{
		$listToBind->DataSource = $dataSource; 
        $listToBind->dataBind(); 
        
        if($selectedItem!=null)
        {
        	$listToBind->setSelectedValue($selectedItem->getId());
        }
        $listToBind->Enabled=$enable;
	}

    public function getStyle($index)
    {
    	if($index % 2 == 0)
    		return 'DataListItem';
    	else
    		return 'DataListAlterItem';
    }
}

?>