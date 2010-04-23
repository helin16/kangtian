<?php

class ProjectController extends AdminPage 
{
	public $id;
	
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->blankLayout=true;
		
		$this->id = (isset($this->Request["id"]) && is_numeric(trim($this->Request["id"])) && trim($this->Request["id"])>0) ? trim($this->Request["id"]) : null;
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
        	$this->assetIds->Value = serialize(array());
	    	if($this->id!==null)
	        {
	        	$this->loadContent($this->id);
	        }
        }
    }
    
    public function loadContent($id)
    {
    	$service = new BaseService("Project");
    	$content = $service->get($id);
    	
    	$this->title->Text = $content->getTitle();
    	$this->description->Text = $content->getDescription();
    	
    	$this->noOfBeds->Text = $content->getNoOfBeds();
    	$this->noOfBaths->Text = $content->getNoOfBaths();
    	$this->noOfCars->Text = $content->getNoOfCars();
    	
    	$address = $content->getAddress();
    	if($address instanceof Address)
    	{
    		$this->address->address->Text = $address->getLine1();
    		$this->address->suburb->Text = $address->getSuburb();
    		$state = $address->getState();
    		if($state instanceof State)
    			$this->address->stateList->setSelectedValue($state->getId());
    		$this->address->postcode->Text = $address->getPostCode();
    	}
    	
    	$assetIds = array();
    	
    	$service = new BaseService("ProjectImage");
    	$images = $service->findByCriteria("projectId=$id");
    	foreach($images as $image)
    	{
    		$assetIds[] = $image->getAsset()->getAssetId();
    	}
    	
    	$this->assetIds->Value = serialize($assetIds);
    	$this->loadImages();
    }
    
    public function save($sender,$param)
    {
    	$this->setInfoMessage("");
    	$service = new BaseService("Project");
    	$imagesService = new BaseService("ProjectImage");
    	$assetServer = new AssetServer();
    	
    	$assetIds = unserialize(trim($this->assetIds->Value));
    	
    	$msg="";
    	//editing an exsiting content
    	if($this->id!==null)
    	{
    		$content = $service->get($this->id);
    		
    		$content->setTitle(trim($this->title->Text));
    		$content->setDescription(trim($this->description->Text));
    		$service->save($content);
    		
    		//get exsiting project images
    		$e_assetIds = array();
    		foreach($imagesService->findByCriteria("projectId={$this->id}") as $image)
    		{
    			$e_assetIds[] = $image->getAsset()->getAssetId();
    		}
    		
    		foreach($assetIds as $assetId)
    		{
    			if(!in_array($assetId,$e_assetIds))
    			{
    				$projectImage = new ProjectImage();
    				$projectImage->setAsset($assetServer->getAsset($assetId));
    				$projectImage->setProject($content);
    				$projectImage->setIsDefault(count($e_assetIds)==0);
    				$imagesService->save($projectImage);
    			}
    		}
    		
    		$msg="Project Updated Successfully!";
    	}
    	else
    	{
    		$content = new Project();
    		
    		$content->setTitle(trim($this->title->Text));
    		$content->setDescription(trim($this->description->Text));
    		$content->setNoOfBeds(trim($this->noOfBeds->Text));
    		$content->setNoOfBaths(trim($this->noOfBaths->Text));
    		$content->setNoOfCars(trim($this->noOfCars->Text));
    		$content->setLanguage(Core::getPageLanguage());
    		$service->save($content);
    		
    		$firtOne=true;
    		foreach($assetIds as $assetId)
    		{
    			$projectImage = new ProjectImage();
    			$projectImage->setAsset($assetServer->getAsset($assetId));
    			$projectImage->setProject($content);
    			$projectImage->setIsDefault($firtOne);
    			$imagesService->save($projectImage);
    			$firtOne=false;
    		}
    		
    		$msg="Project Created Successfully!";
    	}
    	
    	$address = $this->getAddress(trim($this->address->address->Text),trim($this->address->suburb->Text),$this->address->stateList->getSelectedValue(),trim($this->address->postcode->Text), true);
    	$content->setAddress($address);
    	$service->save($content);
    	
    	$this->setInfoMessage($msg);
    }
    
    public function loadImages()
    {
    	$this->imageList->Text = "";
    	$assetIds = unserialize(trim($this->assetIds->Value));
    	if(!is_array($assetIds) || count($assetIds)==0)
    		return;
    	$service = new BaseService("Asset");
    	$assets = $service->findByCriteria("assetId in ('".implode("','",$assetIds)."')");
    	if(count($assets)==0)
    		return;
		
    	$service = new BaseService("Project");
    	$project = $service->get($this->id);
    	
    	$defaultImageId="";
    	$defaultAsset=null;
    	if($project instanceof Project)
    	{
    		 $defaultImage= $project->getDefaultImage();
    		 if($defaultImage instanceof ProjectImage)
    		 {
    		 	$defaultAsset = $defaultImage->getAsset();
	    	 	 if($defaultAsset instanceof Asset)
	    	 	 	$defaultImageId = $defaultAsset->getId();
    		 }
    	}
    	
    	$newDimension = array(
    						"height"=>50,
    						"width"=>50
    					);
    	if(trim($this->showingAssetId->Value)=="")
    		$this->showingAssetId->Value = $defaultAsset===null ? $assets[0]->getAssetId() : $defaultAsset->getAssetId();
    		
    	$showingAssetId = trim($this->showingAssetId->Value);
    	$html="
    		<a href='javascript:void(0);' OnClick=\"makeDefaultImage();\" ".($this->id!==null ? "" : " style='display:none;'").">Make this image default</a>
    		&nbsp;&nbsp;
    		<a href='javascript:void(0);' OnClick=\"deleteImage();\">Delete This Image</a><br />
    		<img id='previewImage' src='/asset/$showingAssetId/".serialize(array())."' style='border: 1px #cccccc solid;padding:15px;'/>
    	<br /><hr />";
    	foreach($assets as $asset)
    	{
    		$assetId = $asset->getAssetId();
			$html .="<a href='javascript:void(0);' 
						onMouseOver=\"this.style.border='1px #ff0000 solid';\" 
						onMouseOut=\"this.style.border='none';\" OnClick=\"loadPreview('$assetId');\" 
						>
						<img src='/asset/$assetId/".serialize($newDimension)."' 
							style='".($asset->getId() == $defaultImageId? "border: 6px #cccccc solid;" : "border: 1px #cccccc solid;padding:5px;" )." margin: 5px;' />
					</a>";
    	}
    	$this->imageList->Text = $html;
    }
    
	public function fileUploaded($sender,$param)
     {
     	if($sender->HasFile)
        {
			$imageFile =fopen($sender->LocalName, "r");
			$imageStream = stream_get_contents($imageFile);
			
			$contentServer = new AssetServer();
			$assetId = $contentServer->registerAsset(AssetServer::TYPE_GRAPH, $sender->FileName, $imageStream);
			
			$assetIds = unserialize(trim($this->assetIds->Value));
			$assetIds[] = $assetId;
						
			$this->assetIds->Value = serialize($assetIds);
			
			$this->loadImages();
        }
     }
     
     public function showPreview($sender, $param)
     {
     	$this->loadImages();
     }
     
     public function makeDefault($sender, $param)
     {
     	$imagesService = new BaseService("ProjectImage");
     	$assetServer = new AssetServer();
     	$asset = $assetServer->getAsset(trim($this->showingAssetId->Value));
     	
     	if($asset instanceof Asset)
     	{
     		$images = $imagesService->findByCriteria("assetId = ".$asset->getId());
     		if(count($images)==0)
     			return;
     			
     		$images[0]->setIsDefault(true);
     		
     		$sql ="update projectimage set isDefault=0, updated=NOW(),updatedById=".Core::getUser()->getId()." where projectId=".$this->id;
     		Dao::execSql($sql);
     		
     		$imagesService->save($images[0]);
     		$this->loadImages();
     	}
     }
     
	public function deleteImage($sender, $param)
     {
     	$imagesService = new BaseService("ProjectImage");
     	$assetServer = new AssetServer();
     	$showingAssetId = trim($this->showingAssetId->Value);
     	$asset = $assetServer->getAsset($showingAssetId);
     	
     	if($asset instanceof Asset)
     	{
     		$assetId = $asset->getId();
     		$images = $imagesService->findByCriteria("assetId = '$assetId'");
     		if(count($images)==0)
     			return;
     			
     		$sql ="update projectimage set active=0, updated=NOW(),updatedById=".Core::getUser()->getId()." where assetId = '$assetId' and projectId=".$this->id;
     		Dao::execSql($sql);
     			
     		
     		//if the current Image is a default image
     		if($images[0]->getIsDefault())
     		{
	     		$sql ="update projectimage set isDefault=0, updated=NOW(),updatedById=".Core::getUser()->getId()." where projectId=".$this->id;
	     		Dao::execSql($sql);
	     		
	     		$sql ="update projectimage set isDefault=1, updated=NOW(),updatedById=".Core::getUser()->getId()." where active = 1 and projectId=".$this->id." limit 1";
	     		Dao::execSql($sql);
     		}
     		
     	}
     	$this->showingAssetId->Value="";
     	
     	$assetIds = array();
     	
     	foreach(unserialize(trim($this->assetIds->Value)) as $aid)
     	{
     		if($aid!=$showingAssetId)
     			$assetIds[] = $aid;
     	}
     	$this->assetIds->Value = serialize($assetIds);
     	
     	
//     	$assetServer->removeAsset($showingAssetId);
     	$this->loadImages();
     }
     
     private function getAddress($line1,$suburb,$stateId,$postCode,$createNew=false)
     {
     	$addrService = new BaseService("Address");
     	$result = $addrService->findByCriteria("line1 like '$line1' and suburb like '$suburb' and stateId='$stateId' and postCode like '$postCode'");
     	
     	if(count($result)>0)
     		return $result[0];
     		
     	$address=null;
     	if($createNew)
     	{
     		$service = new BaseService("State");
     		$state = $service->get($stateId);
     		if(!$state instanceof State )
     			throw new Exception("Invalid State!");
     			
     		$address = new Address();
     		$address->setLine1($line1);
     		$address->setLine2("");
     		$address->setSuburb($suburb);
     		$address->setPostCode($postCode);
     		$address->setState($state);
     		$address->setCountry($state->getCountry());
     		$addrService->save($address);
     	}
     	return $address;
     }
}

?>
