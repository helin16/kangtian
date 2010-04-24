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
        if(!$this->IsPostBack)
        {
	        if(isset($this->Request["title"]) && trim($this->Request["title"])!="")
				$this->loadProject($this->Request["title"]);
        }
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
		$address =trim($project->getAddress());
		$this->address->Text = $address;
		$this->noOfBeds->Text = $project->getNoOfBeds();
		$this->noOfBaths->Text = $project->getNoOfBaths();
		$this->noOfCars->Text = $project->getNoOfCars();
		$this->description->Text = $project->getDescription();
		$this->enquiry->Title="Enquiry for $address";
		$this->enquiry->Content="I want to know a bit more about property on ($address)";
		
		if($address=="")
			$this->mapPanel->Visible=false;
		else
			$this->map->Address=$address;
   	}
}
?>