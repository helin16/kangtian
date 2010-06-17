<?php
class StaffProfilesController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle=Prado::localize("Menu.aboutus");
		$this->menuItemName="aboutus";
	}
	
	public function onLoad($param)
	{
		if(isset($this->Request["id"]) && $this->Request["id"]>0)
			$this->loadProfile($this->Request["id"]);
			
		else
			$this->listProfiles();
	}
	
	public function loadProfile($id)
	{
		$this->listPanel->Visible=false;
		$this->profilePanel->Visible=true;
		
		$service = new BaseService("Person");
		$person = $service->get($id);
		if(!$person instanceof Person )
			return;

		$this->title="Staff Profiles: ".$person->getFullName();
		$this->name->Text  = $person->getTitle(). " ". $person->getFullName();
		$this->position->Text  = "<b>".$person->getPosition()."</b><br />";
		
		$mobile = $person->getMobile();
		$this->contactMethods->Text  .= $mobile=="" ? "" : "<b>Mobile:</b> $mobile<br />";
		
		$phone = $person->getPhone();
		$this->contactMethods->Text  .= $phone=="" ? "" :"<b>Phone:</b> $phone<br />";
		
		$fax = $person->getFax();
		$this->contactMethods->Text  .= $fax=="" ? "" :"<b>Fax:</b> $fax<br />";
		
		$email = $person->getEmail();
		$this->contactMethods->Text  .= $email=="" ? "" :"<b>Email:</b> $email<br />";
		
		$this->descripton->Text = $person->getDescription();
		
		$asset = $person->getPersonalImage();
		if($asset instanceof Asset)
			$this->personalImage->ImageUrl = "/asset/".$asset->getAssetId()."/".serialize(array("height"=>240,"width"=>200));
	}
	
	public function listProfiles()
	{
		$this->title="Staff Profiles";
		$this->listPanel->Visible=true;
		$this->profilePanel->Visible=false;
		
		$sql = "select distinct id from person where active = 1";
		$result = Dao::getResultsNative($sql);
		$this->DataList->DataSource = $result;
		$this->DataList->DataBind();
	}
}
?>