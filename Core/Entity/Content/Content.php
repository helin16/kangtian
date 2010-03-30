<?php
class Content extends ProjectEntity 
{
	/**
	 * getter title
	 *
	 * @return title
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * setter title
	 *
	 * @var title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * getter fulltext
	 *
	 * @return fulltext
	 */
	public function getFullText()
	{
		return $this->fullText;
	}
	
	/**
	 * setter fullText
	 *
	 * @var fullText
	 */
	public function setFullText($fullText)
	{
		$this->fullText = $fullText;
	}
	
	/**
	 * getter intro
	 *
	 * @return intro
	 */
	public function getIntro()
	{
		return $this->intro;
	}
	
	/**
	 * setter intro
	 *
	 * @var intro
	 */
	public function setIntro($intro)
	{
		$this->intro = $intro;
	}
		
	/**
	 * getter onFrontPage
	 *
	 * @return onFrontPage
	 */
	public function getOnFrontPage()
	{
		return $this->onFrontPage;
	}
	
	/**
	 * setter onFrontPage
	 *
	 * @var onFrontPage
	 */
	public function setOnFrontPage($onFrontPage)
	{
		$this->onFrontPage = $onFrontPage;
	}
	
	
	
	public function __toString()
	{
		return "<div class='content'><h3>{$this->gettitle()}</h3>{$this->getcontent()}</div>";
	}
	
	public function getListViewHeader()
	{
		return '<table width="100%" border=\'0\' cellspacing="1" cellpadding="1" >
						<tr font-weight:bold;height:25px;">
							  <th width="25%">Title</th>
							  <th>Full Text</th>
							  <th width="12%">Created</th>
							  <th width="12%">Updated</th>
							  <th width="5%">Active</th>
							  <th width="5%">&nbsp;</th>
						</tr>
					</table>';
	}
	
	public function getListView()
	{
		return "<table width=\"100%\" border='0' cellspacing=\"1\" cellpadding=\"1\" >
			<tr valign=\"top\">
				<td width=\"25%\">
					<b>".$this->getTitle()."</b>
				</td>
				<td>
					<div style='font-size:10px;padding: 0 0 10px 0;'>
						".substr($this->getIntro(),0,100)."...
					</div>
					". substr($this->getFullText(),0,200)."
				</td>
				<td style=\"font-size:12px;width:12%;\">
					<b>By</b> ". $this->getCreatedBy()->getPerson()."
					<br />
					<b>@</b> ". $this->getCreated() ."
				</td>
				<td style=\"font-size:12px;width:12%;\">
					<b>By</b> ". $this->getUpdatedBy()->getPerson()."
					<br />
					<b>@</b> ". $this->getUpdated() ."
				</td>
				<td  width=\"5%\">
					&nbsp;
				</td>
				<td  width=\"5%\">
				</td>
			</tr>
		</table>";
	}
	
	protected function __meta()
	{
		parent::__meta();

		Map::setField($this,new TString("title"));
		Map::setField($this,new TString("intro",12000));
		Map::setField($this,new TString("fullText",255,'','text'));
		Map::setField($this,new TInt('onFrontPage',1,1));
	}
}
?>