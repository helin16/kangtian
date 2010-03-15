<?php


//C:\src\hydra-web\main\protected\pages\Ajax\AjaxController.php
//C:\src\hydra-web\main\bootstrap.php

//require_once("../../../../bootstrap.php");


//error_reporting(0);

class AjaxController extends TService 
{
	// NOTE If anyone copies this controller, then you require this method to profile ajax requests
	public function __construct()
	{
		// Services dont have constructors Apparently
		//parent::__construct();
		//
		
	}
	
  	public function init($config) 
  	{
		
  	}
  	
  	public function run() 
  	{
  		
//  		if(!isset($_SESSION['hydra_user']) || !isset($_SESSION['hydra_role']))
//  			throw new Exception("No defined access.");
//  		
//  		Core::setUser($_SESSION['hydra_user'],$_SESSION['hydra_role']);
  		
  		if(sizeof($_POST) > 0)
		{
			$this->__processPostBack($_POST);
		}
		
		if(sizeof($_GET) > 0)
		{
			$this->__processPostBack($_GET);
		}
  	}	
	
	private function checkForKeys(array $post,array $values)
	{
		foreach($values as $value)
		{
			if(!isset($post[$value]))
				return false;
		}	
		return true;
	}
	
	public function __processPostBack(array $params)
	{
		if(!$this->checkForKeys($params,array('method')))
			return false;
			
		if(method_exists($this,$params['method']))	// BAD FIX
			$this->getResponse()->write($this->$params['method']($params));
			
		
	}
	
	public function getCss()
	{
		$fileContent="";
		try
		{
			$path =dirname(__FILE__)."/../../theme/default/default.css"; 
			ob_start();
				try{readfile($path);}
				catch(Exception $e){throw new Exception("Couldn't get css file");}
				$fileContent = ob_get_contents();
			ob_end_clean();
		}
		catch(Exception $e)
		{
			return "";
		}
		return $fileContent;
	}
}

?>