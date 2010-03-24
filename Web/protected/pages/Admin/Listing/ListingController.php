<?php
class ListingController extends AdminPage 
{
	public $entityName;
	
	public function __construct()
	{
		parent::__construct();
		if(isset($this->Request["entityName"]) && trim($this->Request["entityName"])!="")
			$this->entityName=ucwords(strtolower(trim($this->Request["entityName"])));
		else 
			$this->entityName="";
	}
	
	public function onLoad()
	{
		$this->listItems();
	}
	
	public function getEntityName()
	{
		return $this->entityName;
	}
	
	protected function listItems()
	{
		if($this->entityName=="")
		{
			$this->entityNameLabel->Text = "Nothing to find!";
			return;
		}
		
		$this->entityNameLabel->Text = "List of ".$this->entityName."(s)";
		
		$contentService = new ContentService();
		$this->DataList->DataSource = $contentService->findAll(false);
		$this->DataList->DataBind();
	}
}
?>