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
        	if($this->id!==null)
        	{
        		$this->loadContent($this->id);
        	}
        	else
        		$this->imageUploadPanel->Visible=false;
        }
    }
    
    public function loadContent($id)
    {
    	$service = new BaseService("Project");
    	$content = $service->get($id);
    	
    	$this->title->Text = $content->getTitle();
    	$this->intro->Text = $content->getIntro();
    	$this->fullText->Text = $content->getFullText();
    }
    
    public function save($sender,$param)
    {
    	$this->setInfoMessage("");
    	$service = new BaseService("Project");
    	
    	//editing an exsiting content
    	if($this->id!==null)
    	{
    		$content = $service->get($this->id);
    		
    		$content->setTitle(trim($this->title->Text));
    		$content->setIntro(trim($this->intro->Text));
    		$content->setFullText(trim($this->fullText->Text));
    		$service->save($content);
    		
    		$this->setInfoMessage("Project Updated Successfully!");
    	}
    	else
    	{
    		$content = new Project();
    		
    		$content->setTitle(trim($this->title->Text));
    		$content->setIntro(trim($this->intro->Text));
    		$content->setFullText(trim($this->fullText->Text));
    		$service->save($content);
    		
//    		$this->setInfoMessage("Project Created Successfully!");
    		$this->Response->redirect("/admin/edit/project/".$content->getId().".html");
    	}
    }
    
    public function loadImages($id)
    {
    	$service = new BaseService("Project");
    	$content = $service->get($id);
    	
    	$this->title->Text = $content->getTitle();
    	$this->intro->Text = $content->getIntro();
    	$this->fullText->Text = $content->getFullText();
    }
}

?>
