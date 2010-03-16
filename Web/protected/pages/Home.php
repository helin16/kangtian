<?php

class Home extends EshopPage
{
	public function onLoad($param)
	{
		if(!$this->isPostBack)
		{
			$this->getContents();
		}
	}
	
	private function getContents()
	{
		$qry = "select c.id,c.title,c.intro from content c
				inner join contentcategory_content_content_contentcategory x on (x.contentId = c.id and x.contentCategoryId = 2)
				where c.active = 1
				order by c.id asc
				limit 3";
		$dao = new Dao();
		$sql = new SqlStatement();
		$sql->setDoResults(true);
		$sql->setSQL($qry);
		$dao->execute($sql);
		$results = $sql->getResultSet();
		if(count($results)>0)
		{
			$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
				$html .= "<tr>";
					$rowNo=0;
					foreach($results as $row)
					{
							$html .= "<td width='30%' style='font-size:16px;'>";
								$html .= $this->formatContent($row['id'],$row['title'],$row['intro']);
							$html .= "</td>";
							$rowNo++;
							if($rowNo!=3)
							{
								$html .= "<td style='width:25px;'>&nbsp;</td>";
							}
					}
				$html .= "</tr>";
			$html .= "</table>";
			$this->container->getControls()->add($html);
		}
	}
	
	private function formatContent($contentId,$title,$introText)
	{
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr>";
				$html .= "<td style='color:#323230;text-transform:uppercase;font-size:18px;border-bottom:1px #000000 solid;padding: 15px 0 15px 0;'>$title</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td style='text-align: justify;padding: 35px 0 35px 0;'>$introText</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td>";
					$html .= "<a href='/' style=\"padding:5px;color:#ffffff;background:#2D3444;text-decoration: none;font-size:12px;\">Read more</a>";
				$html .= "</td>";
			$html .= "</tr>";
		$html .= "</table>";
		return $html;
	}
}

?>