<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<meta name="description" content="Managed by a team of expertise with over 10 years of experience in this industry, ARG has built its profile from nothing to well over thousand happy investors ever since its establishment in Oct 2008.A team that believes in customer orientated, ARG offers what is suitable investment portfolio for their customer. These services include investment strategies, market research, overseas investment and funding management.ARG has been actively promoting the importance of investment for their customers’ retirement planning through seminars and workshop">
	<meta name="keywords" content="Real,Estate,for,sale,Australia,property,real estate,for sale by owner,real estate online,Australian real estate,Property,real estate,For sale by owner,real estate in Australia,No commission,Sydney real estate,real estate in Sydney,Melbourne real estate,real estate in Melbourne,Australia Realty,Brisbane real estate,real estate in Brisbane,Adelaide real estate,real estate in Adelaide,Perth real estate,real estate for sale by owner,property,for sale by owner,real estate in Perth,Hobart real estate,real estate in Hobart,Gold coast real estate,real estate Gold Coast,real estate for sale by owner,Newcastle real estate,real estate in Newcastle,Northern Territory real estate,for sale by owner,real estate in Northern Territory,www.australiarealty.com,victoria real estate,queensland real estate, wa real estate,tasmania real estate,sa real estate,for sale by owner,www.australiarealty.com,www.australiarealty.com.au,victoria real estate,queensland real estate,real estate for sale by owner,farms for sale,properties for sale,australian properties for sale,sydney real estate,brisbane real estate, melbourne real estate,brisbane property, melbourne property,sydney property, real estate for sale,australian real estate">
	<link rel="stylesheet" type="text/css" href="/Theme/<%=$this->Page->getDefaultThemeName() %>/default.css" />
</com:THead>
<body>
	<center>
		<com:TForm>
			<script type="text/javascript">
				function loadSubscriptionMsg()
				{
					if($('<%= $this->subscripionErrorMsg->getClientId()%>').value!='')
						alert($('<%= $this->subscripionErrorMsg->getClientId()%>').value);
				}
			</script>
			<div>
				<com:TActiveHiddenField ID="subscripionErrorMsg" />
				<div id="logo" style="width:100%;">
					<div class="innerWrapper">
						<img src="/Theme/<%=$this->Page->getDefaultThemeName() %>/images/Logo2.png" Title="Logo"/>
					</div>
				</div>
				<div id="topMenu" style="width:100%;">
					<div class="innerWrapper">
						<com:Application.controls.Module.Menu.MenuModule ID="topMenu"/>
					</div>
				</div>
				<div id="banner" style="width:100%;">
					<div class="innerWrapper">
						<%= $this->Page->getBanner()%>
					</div>
				</div>
				<div id="body" style="width:100%;">
					<div class="innerWrapper">
						<table width="100%">
							<tr>
								<td valign="top">
									<com:TContentPlaceHolder ID="MainContent" />
								</td>
							</tr>
						</table>
					</div>
				</div>
				<com:TPanel ID="addsPanel" CssClass="adds"  style="width:100%;">
					<div class="innerWrapper">
						<com:TPanel ID="addsContainer">
							<table border='0' cellspacing="0" cellpadding="0" width="100%">
								<tr valign='top'>
									<td width='31%'>
										<%= $this->getSuccessStory()%>
									</td>
									<td width='3%'>&nbsp;</td>
									<td width='31%'>
										<%= $this->getWhyChooseUs()%>
									</td>
									<td width='3%'>&nbsp;</td>
									<td>
										<table border='0' cellspacing="0" cellpadding="0" width="100%">
											<tr valign='top'>
												<td>
													<%= $this->getNewsHeadLine()%>
												</td>
											</tr>
											<tr valign='top'>
												<td>
													<com:TPanel ID="newLetterPanel" DefaultButton="subscribeBtn">
														<table style='width:100%;padding:0px;margin:20px 0 0 0px;height:110px;'  border='0' cellspacing="0" cellpadding="0">
															<tr valign='top'>
																<td style="width:6px;background:transparent url(/Theme/<%=$this->Page->getDefaultThemeName()%>/images/newsletter_left.png) no-repeat right top;">&nbsp;</td>
																<td style="background:transparent url(/Theme/<%=$this->Page->getDefaultThemeName()%>/images/newsletter_mid.png) repeat-x left top;">
																	<table border='0' cellspacing="0" cellpadding="0" style='padding: 10px 0 0 20px;'>
																		<tr>
																			<td style='color:#ffffff;font-size:24px;padding: 0 0 5px 0;'><%[NewsLetter.newsletter]%></td>
																			<td>&nbsp;</td>
																		</tr>
																		<tr>
																			<td>
																				<com:TActiveTextBox ID="subscribe_email" 
																						style='border:none;height:20px;width:200px;margin:0px;padding:2px 0 2px 5px;background:transparent url(/Theme/<%=$this->Page->getDefaultThemeName()%>/images/newsletter_input.png) no-repeat left top;' />
																			</td>
																			<td>
																				<com:TActiveImageButton ID="subscribeBtn" style='padding:0 5px 2px 0;outline:none;' OnClick="subscribe" 
																						ImageUrl="/Theme/<%=$this->Page->getDefaultThemeName()%>/images/newsletter_button.png">
																					<prop:ClientSide OnLoading="$('<%= $this->subscribeBtn->getClientId()%>').hide();$('subscribe_loading').show();"
																								OnComplete="$('<%= $this->subscribeBtn->getClientId()%>').show();$('subscribe_loading').hide();loadSubscriptionMsg();" />
																				</com:TActiveImageButton>
																				<img id='subscribe_loading' src='/image/ajax-loader.gif' style='display:none;'/>
																			</td>
																		</tr>
																		<tr>
																			<td style='padding-top:5px;'>
																				<a href='/newsletter/unsubscribe.html' style='color:#ffffff;'><%[NewsLetter.unsubscribe]%></a>
																			</td>
																			<td>&nbsp;</td>
																		</tr>
																	</table>
																</td>
																<td style="width:6px;background:transparent url(/Theme/<%=$this->Page->getDefaultThemeName()%>/images/newsletter_right.png) no-repeat left top;">&nbsp;</td>
															</tr>
														</table>
													</com:TPanel>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</com:TPanel>
					</div>
				</com:TPanel>
				<com:TPanel ID="footerPanel" CssClass="footer"  style="width:100%;">
					<div class="innerWrapper">
						<com:TPanel ID="footerContainer" />
					</div>
				</com:TPanel>
				<div id="copyright" style="width:100%;">
					<div class="innerWrapper">
						Australian Realty Group (ARG) &copy; 2010 | <a href="/content/privacy_policy.html">Privacy Policy</a>
					</div>
				</div>
			</div>
		</com:TForm>
	<center>
</body>
</html>