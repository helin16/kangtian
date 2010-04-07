<?php

class SLARuleController extends HydraPage
{
	/**
	 * @var RuleService
	 */
	private $ruleService;
	
	/**
	 * @var WorkTypeService
	 */	
	private $workTypeService;
	
	/**
	 * @var StringParserUtils
	 */	
	private $stringParserUtils;
	
	/**
	 * @var WorkTypeWorkFlowService
	 */	
	private $workTypeWorkFlowService;
	
	/**
	 * @var WorkFlowName
	 */	
	private $workFlowName;
	
	public $menuContext;
	
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuContext = 'slarule';
		$this->roleLocks = "pages_all,pages_sla,page_sla_SLARule";
		$this->ruleService = new RuleService();
		$this->workTypeService = new WorkTypeService();
		$this->stringParserUtils = new StringParserUtils();
		$this->workTypeWorkFlowService = new WorkTypeWorkFlowService();
	}
	
	/**
	 * onInit method
	 *
	 * @param $param
	 */
	public function onInit($param)
	{
		parent::onInit($param);
	}
	
	/**
	 * onLoad method
	 *
	 * @param $param
	 */
    public function onLoad($param)
    {
        parent::onLoad($param);
        $this->PaginationPanel->Visible = false;
        $this->setInfoMessage("");
        $this->setErrorMessage("");
        
        if(!$this->IsPostBack || $param == "reload")
        {
			if ($this->Request['searchby'] == 'worktype' && $this->Request['id'] != null)
	    	{
	    		$this->WorkType->Value = $this->Request['id'];
	    		$workType = $this->workTypeService->getWorkType($this->WorkType->Value);
	    		
	
	    		if ($workType instanceof WorkType) 
    			{
		    		if($workType->isActive())
		    			$this->VersionActive->Value = true;
		    		else
		    			$this->VersionActive->Value = false;
	    		}
	    		else
	    		{
	    			throw new Exception("WorkType doesnt exist in the system.");
	    		}
	    		
	    		$this->WorkTypeLabel->Text = "For " . $workType->getContract()->getContractName() . " ( ". $workType->getTypeName() ." )";
	    	}
	    	
	        $this->clearSLARuleValues();
	    	$this->getSLARuleList();
	    	
	    	// Sets url for sla test page
	    	$url = "/slaruletest/worktype/".$this->WorkType->Value."/";
	    	$atttributes = "window.open('$url', 'Tests_All_Rules', 'height=600, width=800, resizable=yes, scrollbars=no, toolbar=no, status=no, menubar=no, addressbar=no, left=200, top=100, screenX=200, screenY=100');";
	    	$this->TestButton->setAttribute('OnClick', $atttributes);
	    	
	    	// sets url for sla help page
	    	$atttributes1 = "window.open('/slarulehelp/', 'Help', 'height=600, width=700, resizable=yes, scrollbars=no, toolbar=no, status=no, menubar=no, addressbar=no, left=300, top=100, screenX=300, screenY=100')";
	    	$this->HelpButton->setAttribute('OnClick', $atttributes1);	    	
        }

        if($this->workFlowName == "" || $this->workFlowName == null)
        	$this->workFlowName = $this->workTypeWorkFlowService->getWorkFlowNameForAWorkType($this->WorkType->Value);
        
    	if($this->VersionActive->Value == true)
    	{
    		$this->AddButton->Enabled = true;

    		$this->JobPriorityEditor->setWorkType($this->WorkType->Value);
			$this->JobPriorityEditor->setFilterLabel($this->JobPriorityFilterText);
			$this->SiteClassificationEditor->setWorkType($this->WorkType->Value);
			$this->SiteClassificationEditor->setFilterLabel($this->SiteClassificationFilterText);		    		
    	}
    	else
    	{
			$this->setInfoMessage("SLA Rules For This Version Details Are Not Edditable");
    		$this->AddButton->Enabled = false;
    	}
    	
    	if($param != "reload")$this->createMenu();
    }
    
    /**
     * binds list sla rules to data list
     *
     * @param int $pageNumber
     */
    public function getSLARuleList($pageNumber=1)
    {
		$rules = $this->workTypeService->getWorkType($this->WorkType->Value)->getRules();
		
		$this->SLARuleDataList->DataSource = $this->ruleService->getFormattedArrayOfRules($rules);
        $this->ItemCountValue->Value = count($this->SLARuleDataList->DataSource);
        $this->SLARuleDataList->dataBind();

        if($this->ItemCountValue->Value > $this->SLARuleDataList->PageSize)
        	$this->PaginationPanel->Visible = true;	        
    }    
    
    /**
     * sets every field of sla rule for edit and clone functionality in sla add panel
     *
     * @param $sender
     * @param $param
     */
    public function setSLARuleValues($sender, $param)
    {
		$this->clearSLARuleValues();
		
    	if($param != null)
			$this->SelectedItem->Value = $param->Item->ItemIndex;
		else
			$this->SelectedItem->Value = 0;

		$this->SLAAddPanel->Visible = true;
		$this->getSLARuleList();

		$ruleId =  $this->SLARuleDataList->DataSource[$this->SLARuleDataList->PageSize*$this->SLARuleDataList->CurrentPageIndex+(int)$this->SelectedItem->Value]['id'];
		$rule = $this->ruleService->getRule($ruleId);

		$this->RuleName->Text = $rule->getRuleName();
		
		$filterArray = $this->ruleService->explodeFilters($rule->getFilters());
		
		$this->JobPriorityEditor->bindJobPriorityFilter($this->WorkType->Value,$filterArray['JobPriority']);
		$this->JobPriorityFilterText->Text = $filterArray['JobPriority'];
		
		$this->SiteClassificationEditor->bindSiteClassificationFilter($this->WorkType->Value, explode(', ', $filterArray['SiteClassification']));
		$this->SiteClassificationFilterText->Text = $filterArray['SiteClassification'];

		$coverageArray = $this->ruleService->explodeCoverages($rule->getCoverage());
		$this->CoverageEditor->bindCoverages($coverageArray);
		
		$targetArray = $this->ruleService->explodeTargets($rule->getTargets());
		$this->TargetEditor->bindTargetList($targetArray);
    }
    
    /**
     * clears every field in sla add panel
     *
     */
    public function clearSLARuleValues()
    {
		$this->RuleName->Text = "";
		$this->JobPriorityEditor->clearAll();
		$this->SiteClassificationEditor->clearAll();
    	$this->CoverageEditor->clearAll();
		$this->TargetEditor->ClearAll();
		
    	$this->OtherComments->Text = '';
    	$this->SelectedItem->Value = '';
    	$this->SLAAddPanel->Visible = false;
    }
    
    /**
     * activates the sla add panel with no values in all fields
     *
     * @param $sender
     * @param $param
     */
	public function addSLARule($sender, $param)
	{
		$this->clearSLARuleValues();
		$this->SLAAddPanel->Visible = true;
		$this->OtherComments->Text = "Adding New SLA Rule";
		$this->getSLARuleList();
	}    
	    
	/**
	 * pre fills the sla rule values in sla add panel, depending on selected sla rule
	 * for editting it
	 *
	 * @param $sender
	 * @param $param
	 */
	public function editSLARule($sender, $param)
    {
    	$this->setSLARuleValues($sender, $param);
    	$this->OtherComments->Text = "Editing SLA Rule";
    }   
    
	/**
	 * pre fills the sla rule values in sla add panel, depending on selected sla rule
	 * and clones it
	 *
	 * @param $sender
	 * @param $param
	 */    
 	public function cloneSLARule($sender, $param)
    {
    	$this->setSLARuleValues($sender, $param);

    	// This is because we are cloning sla rule and not editting it.
		$this->SelectedItem->Value = "";
		
		$this->OtherComments->Text = "Cloned SLA Rule To Add As New SLA Rule";
    }    

    /**
     * Saves the sla rule after validating all parameters
     *
     * @param $sender
     * @param $param
     */
    public function saveSLARule($sender, $param)
    {
		$slaRule = new Rule();
		$workType = new WorkType();
		$saveSLARuleValidationCheck = true;
		$isValidRule = false;
		
		//This is to populate the data list again, after postbacks.
		$this->getSLARuleList();
		
		if($this->SelectedItem->Value != '' && (int)$this->SelectedItem->Value >= 0)
    	{    		
			$ruleId =  $this->SLARuleDataList->DataKeys[(int)$this->SelectedItem->Value];
			$slaRule = $this->ruleService->getRule($ruleId);    		
    	}
		
    	$workType = $this->workTypeService->getWorkType($this->WorkType->Value);
    	$ruleName = $this->RuleName->Text;
    	
    	// Validating And Setting Filter Values
    	$filters = array(
    		'SiteClassification|' . $this->SiteClassificationEditor->__toString(),
    		'JobPriority|' . $this->JobPriorityEditor->__toString()
    	);
    	$filters = '[' . implode('][', $filters) . ']';

    	// Validating And Setting Coverage Values    	
    	if($this->isNullCoverage($this->CoverageEditor))
    	{
    		$this->CoverageEditor->showHideValidationLabels("AllValidation", "Atleast One Day In Week Must Have Valid Coverage Time", "visible");
    		$saveSLARuleValidationCheck = false;
    	}
    	else
    	{
    		$this->CoverageEditor->showHideValidationLabels("AllValidation");
        	foreach($this->CoverageEditor->findControlsByType("TActiveLabel") as $validateCoverage)
	    	{
	    		if($validateCoverage->Text != "" && $validateCoverage->getId() != "LessCoverageRangeFlag")
	    		{
	    			$saveSLARuleValidationCheck = false;
					break;	    			
	    		}
	    	}    		
	    	$coverage = $this->CoverageEditor->__toString();
    	}
    	
    	if($this->CurrentTargetCount->Value == "" || (int)$this->CurrentTargetCount->Value <= 0)
    	{
    		$this->TargetEditor->showHideValidationLabels("AllValidation", "Atleast One Target Must Be Entered", "visible");
    		$saveSLARuleValidationCheck = false;
    	}
    	else if(!$this->isTimeConditionCovering24HrsPeriodForTargetsOfEOBDType())
    	{
    		$this->TargetEditor->showHideValidationLabels("AllValidation", "Targets of EOBD Type must have Time Conditions covering 24 Hrs period. Refer to Help For More Details", "visible");
    		$saveSLARuleValidationCheck = false;
    	}
    	else if(!$this->isAfterEventSelectedForTargetExceptNewHasAtleastOneAndOnlyOneTargetEventDefinition())
    	{
    		$this->TargetEditor->showHideValidationLabels("AllValidation", "Targets having Trigger except 'New' should have atleast one and unique definition of that event as Target. Refer to Help For More Details", "visible");
    		$saveSLARuleValidationCheck = false;
    	}
    	else
    	{
    		$this->TargetEditor->showHideValidationLabels("AllValidation");
	    	foreach($this->TargetEditor->findControlsByType("TActiveLabel") as $validateTarget)
	    	{
	    		if($validateTarget->Text != "")
	    		{
	    			$saveSLARuleValidationCheck = false;
					break;	    			
	    		}
	    	}
	    	$targets = $this->TargetEditor->saveString();
    	}

    	if($saveSLARuleValidationCheck)
    	{
    		$slaRule->setRuleName($ruleName);
			$slaRule->setWorkType($workType);
	    	$slaRule->setFilters($filters);
	    	$slaRule->setCoverage($coverage);
	    	$slaRule->setTargets($targets);
	    	$slaRule->setWorkFlowName($this->workFlowName);
	
    		$isValidRule = $this->ruleService->isSimilarRulesHavingCoverageTimesOverlapping($slaRule);
    		$slaRule->setValidRule($isValidRule);

    		$this->ruleService->saveRule($slaRule);
    		
	    	$this->clearSLARuleValues();

	    	if($isValidRule)
		    	$this->setInfoMessage("SLA Rule Added Successfully");    	
			else
	    		$this->setErrorMessage("SLA Rule Added Successfully, But is Conflicting With Other SLA Rule");
			
    		$this->getSLARuleList();    	
    	}
    	else
    		$this->setErrorMessage("Unable To Add SLA");
    }    
    
    /**
     * deletes the selected sla rule 
     *
     * @param $sender
     * @param $param
     */
 	public function deleteSLARule($sender, $param)
    {
		$this->SelectedItem->Value = $param->Item->ItemIndex;
		$this->getSLARuleList();
		
		$ruleId =  $this->SLARuleDataList->DataSource[$this->SLARuleDataList->PageSize*$this->SLARuleDataList->CurrentPageIndex+(int)$this->SelectedItem->Value]['id'];
		$rule = $this->ruleService->getRule($ruleId);

		if($rule != null)
		{
			$this->ruleService->deleteRule($rule);
			$this->setInfoMessage("SLA Rule Deleted Successfully");
		}
		else
			$this->setErrorMessage("Unable To Delete SLA Rule");

		$this->SelectedItem->Value = "";
		$this->getSLARuleList();
    }

    /**
     * cancels the saving of sla rule and reloads the page
     */
	public function cancelSave()
	{
		$this->onLoad("reload");
	}        
    
	/**
	 * checks for null coverage (i.e. checks whether coverage has atleast one day with coverage time)
	 *
	 * @param string $coverage
	 * @return bool
	 */
	public function isNullCoverage($coverage=null)
	{
		if($coverage != null)
		{
			if(trim($coverage->getMon()->Text) == "" && trim($coverage->getTue()->Text) == "" && trim($coverage->getWed()->Text) == "" && trim($coverage->getThu()->Text) == "" 
				&& trim($coverage->getFri()->Text) == "" && trim($coverage->getSat()->Text) == "" && trim($coverage->getSun()->Text) == "" && trim($coverage->getHol()->Text) == "")
			{
				 return true;
			}
		}
		
		return false;
	}    
    
	/**
	 * checks whether the time range for coverage days is valid or not 
	 *
	 * @param string $timeString
	 * @param string $day
	 * @return bool
	 */	
	public function isValidCoverageTimeRange($timeString, $day)
	{
		$textString = trim($timeString);
		$this->CoverageEditor->showHideValidationLabels("LessCoverageRangeFlag");
		
		if(!$this->stringParserUtils->isValidTimeRange($textString) && $textString != "")
			return false;			
		else if($textString != "")
		{
			$diffInTime = $this->stringParserUtils->getTimeDifference($textString);
			if($diffInTime < 8)
				$this->CoverageEditor->showHideValidationLabels("LessCoverageRangeFlag", "Coverage is Less than 8 Hrs (". $diffInTime. " Hr(s)) For ".$day, "visible");
		}

		return true;
	}
	
	/**
	 * checks whether the start time and stop time for coverage days makes a valid time range or not 
	 *
	 * @param $startTimeControl
	 * @param $stopTimeControl
	 * @param $dayRangeControl
	 * @param $startTimeValidatorName
	 * @param $stopTimeValidatorName
	 */		
	public function isValidCoverageTimes($startTimeControl, $stopTimeControl, $dayRangeControl, $startTimeValidatorName, $stopTimeValidatorName)
	{
		$this->CoverageEditor->showHideValidationLabels("AllValidation");
		$this->CoverageEditor->showHideValidationLabels($startTimeValidatorName);
		$this->CoverageEditor->showHideValidationLabels($stopTimeValidatorName);
		
		$startTimeControlText = trim($startTimeControl->Text);
		if($startTimeControlText != "")
			$startTimeControl->setText($startTimeControlText);
		
		$stopTimeControlText = trim($stopTimeControl->Text);
		if($stopTimeControlText != "")
			$stopTimeControl->setText($stopTimeControlText);	
				
		// Validate Start Time
		if($startTimeControlText != "")
		{
			if(!$this->stringParserUtils->isTime($startTimeControlText))
				$this->CoverageEditor->showHideValidationLabels($startTimeValidatorName, "Invalid Start Time", "visible");
		}
		else
		{
			if($stopTimeControlText != "")
				$this->CoverageEditor->showHideValidationLabels($startTimeValidatorName, "Mandatory Start Time", "visible");
		}				
		
		// Validate Stop Time
		if($stopTimeControlText != "")
		{
			if(!$this->stringParserUtils->isTime($stopTimeControlText))
				$this->CoverageEditor->showHideValidationLabels($stopTimeValidatorName, "Invalid Stop Time", "visible");
		}
		else
		{
			if($startTimeControlText != "")
				$this->CoverageEditor->showHideValidationLabels($stopTimeValidatorName, "Mandatory Stop Time", "visible");
		}
		
		// Validate Time Range when start time and stop time is not null and valid times
		if($startTimeControlText != "" && $stopTimeControlText != "")
		{
			if($this->stringParserUtils->isTime($startTimeControlText) && $this->stringParserUtils->isTime($stopTimeControlText))
			{
				if((!$this->stringParserUtils->isZeroTime($startTimeControlText, $stopTimeControlText)) && (!$this->stringParserUtils->isLessThanTime($startTimeControlText, $stopTimeControlText)))
					$this->CoverageEditor->showHideValidationLabels($stopTimeValidatorName, "Stop Time should be Greater Than Start Time", "visible");
				
				$dayRangeControl->Text = $startTimeControlText." to ".$stopTimeControlText;
				if(!$this->isValidCoverageTimeRange($dayRangeControl->Text, $dayRangeControl->getID()))
					$this->CoverageEditor->showHideValidationLabels("AllValidation", "Invalid Time - Please Enter in 09:00 to 17:00 Format For ". $dayRangeControl->getID(), "visible");
			}
		}
		else if($startTimeControlText == "" && $stopTimeControlText == "")
		{
			$dayRangeControl->Text = "";
		}
	}
	
	/**
	 * checks whether the time for target is valid or not 
	 *
	 * @param $sender
	 * @param $param
	 */	
	public function isValidTimeForTarget($sender, $param)
	{
		$this->TargetEditor->showHideValidationLabels("TimeValidation");
		$this->TargetEditor->showHideValidationLabels("TimeConditionEO1BDAndNoneValidation");
		$this->TargetEditor->showHideValidationLabels("GreaterEOBDRangeFlag");

		$eobdType = false;
		$hrOrMinType = false;
		
		$textString = strtoupper(trim($this->TargetEditor->time->getText()));
		
		if($this->isRiskTarget($textString, $this->TargetEditor->timecondition->getText()))
			$this->TargetEditor->showHideValidationLabels("TimeConditionEO1BDAndNoneValidation", "Risk Target", "visible");
		
		$eobdType = $this->stringParserUtils->isValidTimeEOBDFormat($textString);
		$hrOrMinType = $this->stringParserUtils->isValidTimeHrOrMinFormat($textString);
		
		if(!$hrOrMinType && !$eobdType)
			$this->TargetEditor->showHideValidationLabels("TimeValidation", "Invalid Time Format", "visible");
		
		$this->TargetEditor->timecondition->Text = "NONE";
		if($hrOrMinType)
			$this->TargetEditor->timecondition->Enabled = "false";
		
		if($eobdType)
		{
			$this->TargetEditor->timecondition->Enabled = "true";
			$dayNumber = $this->stringParserUtils->getEOBDDayNumber($textString);
			if($dayNumber >= 10)
				$this->TargetEditor->showHideValidationLabels("GreaterEOBDRangeFlag", "EOBD is Greater Than 10 Days (".$dayNumber." Day(s)).", "visible");
		}
		$this->isValidTimeConditionForTarget(null,null);
		
		$this->TargetEditor->time->setText($textString);
		$this->TargetEditor->showHideValidationLabels("DuplicateTargetValidation");
	}	    
    
	/**
	 * checks whether the time condition for target is valid or not 
	 * it checks based on EOBD or HR or MIN Type
	 *
	 * @param $sender
	 * @param $param
	 */	
	public function isValidTimeConditionForTarget($sender, $param)
	{
		$this->TargetEditor->showHideValidationLabels("TimeConditionValidation");
		$this->TargetEditor->showHideValidationLabels("TimeConditionEO1BDAndNoneValidation");		

		$textString = strtoupper(trim($this->TargetEditor->timecondition->getText()));
	
		if($textString != "NONE" && substr($textString,0,6) != "BEFORE")
			$textString = "BEFORE ".$textString;
		
		if($this->isRiskTarget($this->TargetEditor->time->getText(), $textString))
			$this->TargetEditor->showHideValidationLabels("TimeConditionEO1BDAndNoneValidation", "Risk Target", "visible");
		
		if(!$this->stringParserUtils->isTimeConditionValidForEOBDType($textString))
			$this->TargetEditor->showHideValidationLabels("TimeConditionValidation", "Invalid Condition (Can Be NONE or Like 11:00)", "visible");
		else
			$this->TargetEditor->timecondition->setText($textString);
			
		$this->TargetEditor->showHideValidationLabels("DuplicateTargetValidation");
	}	    
	
    /**
     * Checks whether it is a risk target or not
     *
     * @param string $targetTime
     * @param string $targetTimeCondition
     * @return bool
     */
    public function isRiskTarget($targetTime, $targetTimeCondition)
    {
    	return ($this->stringParserUtils->isEO1BD(strtoupper(trim($targetTime))) && strtoupper(trim($targetTimeCondition)) == "NONE");
    }

	/**
	 * checks whether new Target entered is unique or not 
	 * this looks into all the existing targets to find whether the new target entered is unique or not
	 * for that sla rule
	 *
	 * @return bool
	 */		
	public function isUniqueTarget()
	{
		$notDuplicateTarget = true;
		$targetArray = array();
		
		foreach ($this->TargetEditor->TargetList->Items as $item)
		{
			if(($this->TargetEditor->event->Items[$this->TargetEditor->event->SelectedIndex]->Text == $item->event->Text) && ($this->TargetEditor->targetfor->Checked == $item->targetfor->Checked))			
				array_push($targetArray, array('event'=>$item->event->Text, 'time'=>$item->time->Text, 'timecondition'=>$item->timecondition->Text, 'afterevent'=>$item->afterevent->Text, 'targetfor'=>$item->targetfor->Checked));
		}
	
		if(sizeof($targetArray) > 0)
		{
			foreach ($targetArray as $target)
			{
				$eobdTypeTimeText = $this->stringParserUtils->isValidTimeEOBDFormat($this->TargetEditor->time->Text);
				$eobdTypeTargetArrayTimeText = $this->stringParserUtils->isValidTimeEOBDFormat($target['time']);
				
				if(($eobdTypeTimeText && !$eobdTypeTargetArrayTimeText) || ($eobdTypeTargetArrayTimeText && !$eobdTypeTimeText))
				{
					$notDuplicateTarget = false;
				}
				else if(!$eobdTypeTimeText)
				{
					if($target['event'] == $this->TargetEditor->event->Items[$this->TargetEditor->event->SelectedIndex]->Text)
						$notDuplicateTarget = false;
				}
				else
				{
					if(!$this->isUniqueTimeAndConditionForTargetOfEOBDType())
						$notDuplicateTarget = false;
				}
			}
		}
		return $notDuplicateTarget;		
	}
	
	/**
	 * checks whether Target Time and Time Condition are unique for Target of EOBD Type 
	 * this looks into all the existing targets time and condition to find whether 
	 * the new target entered has unique time and condition or not
	 * for that sla rule
	 *
	 * @return bool
	 */	
	public function isUniqueTimeAndConditionForTargetOfEOBDType()
	{
		$targetArray = array();
		$notDuplicateTarget = true;
		
		$event = $this->TargetEditor->event->Items[$this->TargetEditor->event->SelectedIndex]->Text;
		$time = $this->TargetEditor->time->Text;
		$timecondition = $this->TargetEditor->timecondition->Text;
		$afterevent = $this->TargetEditor->afterevent->Items[$this->TargetEditor->afterevent->SelectedIndex]->Text;
		$targetfor = $this->TargetEditor->targetfor->Checked;
		$timeInMins = 0;
		
		$timeConditionArray = $this->stringParserUtils->splitTimeCondition($timecondition);
		if(sizeof($timeConditionArray) > 1)
			$timeInMins = $this->stringParserUtils->convertToMins($timeConditionArray[1]);
		
		foreach ($this->TargetEditor->TargetList->Items as $item)
		{
			if($this->stringParserUtils->isValidTimeEOBDFormat($item->time->Text) && ($event == $item->event->Text) && ($targetfor == $item->targetfor->Checked))
				array_push($targetArray,array('timecondition'=>$item->timecondition->Text, 'time'=>$item->time->Text, 'event'=>$item->event->Text, 'afterevent'=>$item->afterevent->Text, 'targetfor'=>$item->targetfor->Checked));
		}		
		array_multisort($targetArray, SORT_ASC);
		
		if(sizeof($targetArray) > 0)
		{
			foreach ($targetArray as $target)
			{
				if($target['event'] == $event && $target['time'] == $time && $target['timecondition'] == $timecondition && $target['afterevent'] == $afterevent && $target['targetfor'] == $targetfor)
					$notDuplicateTarget = false;
				else
				{
					if(($target['timecondition'] == "NONE" && $timecondition == "NONE") && ($target['targetfor'] == $targetfor))
						$notDuplicateTarget = false;
					else if($target['targetfor'] == $targetfor)
					{
						$targetTimeConditionArray = $this->stringParserUtils->splitTimeCondition($target['timecondition']);
						
						if(sizeof($targetTimeConditionArray) > 1)
						{
							$targetTimeInMins = $this->stringParserUtils->convertToMins($targetTimeConditionArray[1]);
							
//							if(($timeInMins == $targetTimeInMins) || ($timeInMins == 0 && $timecondition != "NONE"))
							if($timeInMins == $targetTimeInMins)
								$notDuplicateTarget = false;
						}
					}
				}
			}
		}
		return $notDuplicateTarget;
	}		
		
	/**
	 * Gets all the available action nodes from the workflow for a field task, which is linked to worktype
	 * this action nodes are basically the valid events for a target.
	 *
	 * @return array $events
	 */
 	public function getAvailableEvents()
    {
    	if($this->WorkType->Value != null && $this->workFlowName != "")
    	{
	    	$workFlowId = $this->workTypeWorkFlowService->getWorkFlowId($this->WorkType->Value, $this->workFlowName);
			return $this->workTypeWorkFlowService->getAllStateNodes($workFlowId, "name");
    	}
    	else
    		return array();
    }
	
	/**
	 * Gets all the previous available action nodes based on selected event (which is selected action node) 
	 * from the workflow for a field task, which is linked to worktype
	 *
	 * @return array $previousevents
	 */    
 	public function getPreviousAvailableEvents($currentStateId)
    {
        if($this->WorkType->Value != null && $this->workFlowName != "" && $currentStateId > 0)
    	{
	    	$workFlowId = $this->workTypeWorkFlowService->getWorkFlowId($this->WorkType->Value, $this->workFlowName);
			return $this->workTypeWorkFlowService->getAllPreviousStateNodes($currentStateId, $workFlowId, "name");
    	}
    	else
    		return array();
    }
    
	/**
	 * checks whether the time condition for EOBD Type Target is covering 24 hr period
	 * eg:
	 * target1 can have time as eobd and condition as before 11:00, this means (00:00 to 11:00)
	 * target2 can have time as eo2bd and condition as before 17:00, this means (11:00 to 17:00)
	 * target3 can have time as eo3bd and condition as none, this means (17:00 to 24:00)
	 *
	 * @return bool
	 */
	public function isTimeConditionCovering24HrsPeriodForTargetsOfEOBDType()
	{
		return $this->ruleService->isTimeConditionCovering24HrsPeriodForTargetsOfEOBDType($this->TargetEditor->TargetList->Items);
	}	
	
	/**
	 * checks whether the Targets having After Event except 'New' has atleast one and unique definition of that event as Target
	 * eg:
	 * all targets have after event as "New" (i.e. firstnode than this function will return true), because its fixed target
	 * if target1 has after event except "New", 
	 * this function would check to see whether the targetlist has any target with event same as after event of target1 and is unique.
	 * this is required because target1 is dependent on the time of the after event, and if we dont have it, we cant calculate the time for target1.
	 * also if it has more than one definition of target1 i.e. byt / client sla definition for same event, than which time to select for calculation could not be decided.
	 * so we need atleast one and only one definition of that target after event.
	 *
	 * @return bool
	 */	    
    public function isAfterEventSelectedForTargetExceptNewHasAtleastOneAndOnlyOneTargetEventDefinition()
    {
    	$workFlowId = $this->workTypeWorkFlowService->getWorkFlowId($this->WorkType->Value, $this->workFlowName);
    	$firstNodeName = $this->workTypeWorkFlowService->getFirstStateNode($workFlowId, "name");
    	
    	return $this->ruleService->isAfterEventSelectedForTargetExceptNewHasAtleastOneAndOnlyOneTargetEventDefinition($this->TargetEditor->TargetList->Items,$firstNodeName);
    }
	    
    /**
     * handles the pagination of sla rule data list 
     *
     * @param $sender
     * @param $param
     */
    public function pageChanged($sender, $param)
    {
    	$this->SLARuleDataList->CurrentPageIndex = $param->NewPageIndex;
    	$this->getSLARuleList();
    }
    
	public function createMenu(&$focusObject=null,$focusArgument="")
    {
	    $clientService = new EntityService('Client');
	    $workType = null;
    	if($this->WorkType->Value!="")
	    {
		    $focusObject = $this->workTypeService->getWorkType($this->WorkType->Value);
		    if($focusObject instanceof WorkType)
		    {
		   	 	$workType = $focusObject;
		    }
		    else
		    {
			    $workType = $this->workTypeService->getWorkType($this->WorkType->Value);
	    	}
	    	$contract = $workType->getContract();
		    $contractGroup = $contract->getContractGroup();
	    	$client = $contractGroup->getClient();
	    	
	    	$menu = $this->page->findControlsById('menu');
	    	$mainmenu = new GenericMenu($this,'Please Select...','/client/');
			$mainmenu->addNode(new EntityMenu($this,'/contractgroup/client/%d',$clientService->findAll(),$client));
			$mainmenu->render($menu[0]);
			
			$submenu1 = new GenericMenu($this,'Please Select...','/contractgroup/client/'.$client->getId());
			$submenu1->addNode(new EntityMenu($this,'/contract/contractgroup/%d',$client->getContractGroups(),$contractGroup));	
			$submenu1->render($menu[0]);
			
			$submenu2 = new GenericMenu($this,'Please Select...','/contract/contractgroup/'.$contractGroup->getId());
			$submenu2->addNode(new EntityMenu($this,'/contract/%d',$contractGroup->getContracts(),$contract));	
			$submenu2->render($menu[0]);
			
			$submenu3 = new GenericMenu($this,'Please Select...','/contract/'.$contract->getId());
			$submenu3->addNode(new GenericMenu($this,'All WorkTypes','/worktype/contract/'.$contract->getId()));
			$submenu3->addNode(new EntityMenu($this,'/worktype/%d',$contract->getWorkTypes(),$workType));
			$submenu3->addNode(new GenericMenu($this,'All Classifications','/siteclassification/contract/'.$contract->getId()));	
			$submenu3->addNode(new EntityMenu($this,'/siteclassification/%d',$contract->getClassifications(),null));	
			$submenu3->render($menu[0]);
			
			$submenu4 = new GenericMenu($this,'Please Select...','/worktype/'.$workType->getId());
			$submenu4->addNode(new GenericMenu($this,'Sites','/site/worktype/'.$workType->getId(),null));
			$submenu4->addNode(new GenericMenu($this,'Preferences','/contractworktypepreference/worktype/'.$workType->getId(),null));
			$submenu4->addNode(new GenericMenu($this,'Problems','/problem/worktype/'.$workType->getId(),null));	
			$submenu4->addNode(new GenericMenu($this,'SLAs','/slarule/worktype/'.$workType->getId(),true));	
			$submenu4->addNode(new GenericMenu($this,'Task Priorities','/jobpriority/worktype/'.$workType->getId(),null));	
			$submenu4->render($menu[0]);
	    }
    }
}

?>
