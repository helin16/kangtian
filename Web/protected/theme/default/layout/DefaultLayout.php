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
	
	private function getFooter()
	{
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr valign='top'>";
				$html .= "<td width='31%'>";
					$list = new ContentListControl();
					$html .= $list->getNewsList(2);
				$html .= "</td>";
				$html .= "<td width='3%'>&nbsp;</td>";
				$html .= "<td width='31%'>";
					$html .= $list->getNewsList(2);
				$html .= "</td>";
				$html .= "<td width='3%'>&nbsp;</td>";
				$html .= "<td>";
					$html .= $list->getNewsList(2);
				$html .= "</td>";
			$html .= "</tr>";
		$html .= "</table>";
		$this->footerContainer->getControls()->add($html);
	}
}
?>