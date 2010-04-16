<?php
 
/**
 * class DefaultLayout
 */
class DefaultLayout extends TTemplateControl
{
	public function onLoad()
	{
		$this->getContents();
	}
	
	private function getContents()
	{
		$qry = "select c.id,c.title,c.text from content c
				inner join content_contentcategory x on (x.contentId = c.id and x.contentCategoryId = 2)
				where c.active = 1
				order by c.id asc
				limit 3";
		$results = Dao::getResultsNative($qry);
		if(count($results)>0)
		{
			$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
				$html .= "<tr>";
					$rowNo=0;
					foreach($results as $row)
					{
							$html .= "<td width='30%' style='font-size:16px;'>";
								$html .= $this->formatContent($row[0],$row[1],$row[2]);
							$html .= "</td>";
							$rowNo++;
							if($rowNo!=3)
							{
								$html .= "<td width='2%'>&nbsp;</td>";
							}
					}
				$html .= "</tr>";
			$html .= "</table>";
			$this->addsContainer->getControls()->add($html);
		}
	}
	
	private function formatContent($contentId,$title,$introText,$maxIntroLength=150)
	{
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr>";
				$html .= "<td style='color:#323230;text-transform:uppercase;font-size:18px;padding: 10px 0 0 0;'>$title</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td style='text-align: justify;padding: 0 0 20px 0;'>".(strlen($introText)>$maxIntroLength ? substr($introText,0,$maxIntroLength)." ... " : $introText)."</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td>";
					$title = str_replace(" ","_",trim($title));
					$html .= "<a href='/content/$title.html' style=\"padding:5px;color:#ffffff;background:#2D3444;text-decoration: none;font-size:12px;\">Read more</a>";
				$html .= "</td>";
			$html .= "</tr>";
		$html .= "</table>";
		return $html;
	}
}
?>