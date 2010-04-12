<?php
 
/**
 * class DefaultLayout
 */
class DefaultLayout extends TTemplateControl
{
	public function onLoad()
	{
		$this->getProjects();
	}
	
	public function getProjects()
	{
		$html="<div  style=\"padding: 5px 0 5px 10px;width:885px;\">";
			$html.="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"970px;\">";
				$html.="<tr>";
					$html.="<td style='color:#323230;text-transform:uppercase;font-size:18px;border-bottom:1px #000000 solid;padding: 15px 0 15px 0;'>";
						$html.="Our Projects";
					$html.="</td>";
				$html.="</tr>";
				$html.="<tr>";
					$html.="<td style='color:#A40404;text-transform:uppercase;font-size:14px;font-weight:bold;padding: 15px 0 15px 0;'>";
						$html.="iaculis, dui quis venenatis in, mauris. Nunc elementum.";
					$html.="</td>";
				$html.="</tr>";
				$html.="<tr>";
					$html.="<td style='padding: 35px 0 35px 0;'>";
					$projectService = new BaseService("Project");
					$projects = $projectService->findAll();
					if(count($projects)>0)
					{
						$html.="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
							$html.="<tr>";
								$array = array();
								for($i=0;$i<3;$i++)
								{
									$array[] ="<td width='30%' style='font-size:16px;'>".$projects[$i]->getSnapshot()."</td>";
								}
								$html.=implode("<td style='width:25px;'>&nbsp;</td>",$array);
							$html.="</tr>";
						$html.="</table>";
					}
					$html.="</td>";
				$html.="</tr>";
			$html.="</table>";
		$html.="</div>";
		$this->footerPanel->getControls()->add($html);
	}
}
?>