<?php
 
/**
 * class DefaultLayout
 */
class DefaultLayout extends TTemplateControl
{
	public function onLoad()
	{
		$this->getFooter();
	}
	
	public function getSuccessStory()
	{
		$customer = $this->getContent(2);
		return $this->formatContent($customer[0],$customer[1],$customer[2],450,"success stories");
	}
	
	public function getWhyChooseUs()
	{
		$why = $this->getContent(2);
		return $this->formatContent($why[0],$why[1],$why[2],450,"your benefits");
	}
	
	public function getNewsHeadLine()
	{
		$list = $this->getNewsList(2);
		return $this->formatContent(null,"News Headline",$list,PHP_INT_MAX,"what's new");
	}
	
	private function getFooter()
	{
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr valign='top'>";
				$html .= "<td width='31%'>";
					$list = $this->getNewsList(2);
					$html .= $this->formatContent(null,"New Solutions",$list,PHP_INT_MAX);
				$html .= "</td>";
				$html .= "<td width='3%'>&nbsp;</td>";
				$html .= "<td width='31%'>";
					$list = $this->getNewsList(2);
					$html .= $this->formatContent(null,"Popular Services",$list,PHP_INT_MAX);
				$html .= "</td>";
				$html .= "<td width='3%'>&nbsp;</td>";
				$html .= "<td>";
					$list = $this->getNewsList(2);
					$html .= $this->formatContent(null,"Press Releases",$list,PHP_INT_MAX);
				$html .= "</td>";
			$html .= "</tr>";
		$html .= "</table>";
		$this->footerContainer->getControls()->add($html);
	}
	
	public function getContent($categoryId, $noOfItems=1)
	{
		$qry = "select c.id,c.title,c.text from content c
				inner join content_contentcategory x on (x.contentId = c.id and x.contentCategoryId = $categoryId)
				where c.active = 1
				order by c.id asc
				limit $noOfItems";
		$results = Dao::getResultsNative($qry);
		if(count($results)==0)
			return;
		return $results[0];
	}
	
	public function getNewsList($categoryId,$noOfItems=4)
	{
		$qry = "select c.id,c.title from content c
				inner join content_contentcategory x on (x.contentId = c.id and x.contentCategoryId = $categoryId)
				where c.active = 1
				order by c.id desc
				limit $noOfItems";
		$results = Dao::getResultsNative($qry);
		if(count($results)==0)
			return;
			
		$html = "<ul style='margin:0px;padding:0px 0px 0px 18px;'>";
			foreach($results as $row)
			{
				$html .= "<li style='padding:0 0 5px 0;'>";
					$title = str_replace(" ","_",trim($row[1]));
					$html .= "<a href='/content/$title.html' style=\"color:#BF3A17;\">{$row[1]}</a>";
				$html .= "</li>";
			}
		$html .= "</ul>";
		return $html;
	}
	
	private function formatContent($contentId,$title,$introText,$maxIntroLength=250,$subTitle="")
	{
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr>";
				$html .= "<td style='font-weight:bold;color:#000000;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;font-size:24px;padding: 10px 0 20px 0;'>";
					$html .=$title;
					if($subTitle!="")
						$html .="<br /><i style='color:#AC7755;font-size:16px;font-family:cursive;font-weight:normal;'>$subTitle</i>";
				$html .= "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				if($maxIntroLength!=PHP_INT_MAX)
					$introText=(strlen($introText)>$maxIntroLength ? substr($introText,0,$maxIntroLength)." ... " : $introText);
				$html .= "<td style='font-size:13px;text-align: justify;padding: 0 0 20px 0;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;'>$introText</td>";
			$html .= "</tr>";
			if($contentId!==null)
			{
				$html .= "<tr>";
					$html .= "<td>";
						$title = str_replace(" ","_",trim($title));
						$html .= "<a href='/content/$title.html' style=\"padding:5px;color:#BF3A17;font-size:12px;\">Read more</a>";
					$html .= "</td>";
				$html .= "</tr>";
			}
		$html .= "</table>";
		return $html;
	}
	
	public function subscribe($sender,$param)
	{
		$this->subscripionErrorMsg->Value="";
		$email = trim($this->subscribe_email->Text);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)===false)
		{
			$this->subscripionErrorMsg->Value="Invalid Email Address!";
			return;
		}
		
		try
		{
			$newsLetterService = new NewsLetterService();
			$newsLetterService->subscribe($email);
		}
		catch(Exception $e)
		{
			$this->subscripionErrorMsg->Value=$e->getMessage();
		}
		
		$this->subscripionErrorMsg->Value="You have successfully subscribed our news letter!";
		$this->subscribe_email->Text="";
	}
}
?>