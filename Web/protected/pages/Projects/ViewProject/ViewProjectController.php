<?php
class ViewProjectController extends EshopPage  
{
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="projects";
	}
	
	public function onLoad($param)
    {
        parent::onLoad($param);
        
        if(isset($this->Request["title"]) && trim($this->Request["title"])!="")
			$this->loadProject($this->Request["title"]);
    }
    
   	public function loadProject($title)
   	{
   		$service = new ProjectService();
		$projects = $service->getProjectByTitle($title);
		if(count($projects)==0)
		{
			$this->title->Text = "No Project found for '".ucwords($title)."'!";
			$this->ListingPanel->Visible=false;
			return;
		}
		
		$project = $projects[0];
		$this->address->Text = $project->getAddress();
		$this->noOfBeds->Text = $project->getNoOfBeds();
		$this->noOfBaths->Text = $project->getNoOfBaths();
		$this->noOfCars->Text = $project->getNoOfCars();
		$this->description->Text = $project->getDescription();
   	}
}
?>