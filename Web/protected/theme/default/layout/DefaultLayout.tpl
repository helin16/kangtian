<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<link rel="stylesheet" type="text/css" href="/Theme/<%=$this->Page->getDefaultThemeName() %>/default.css" />
</com:THead>
<body>
	<center>
		<com:TForm>
			<div>
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
						<com:TImage ID="banner" />
					</div>
				</div>
				<div id="body" style="width:100%;">
					<div class="innerWrapper">
						<table width="100%">
							<tr>
								<td height="600px" valign="top">
									<com:TContentPlaceHolder ID="MainContent" />
								</td>
							</tr>
						</table>
					</div>
				</div>
				<com:TPanel ID="addsPanel" CssClass="adds"  style="width:100%;">
					<div class="innerWrapper">
						<com:TPanel ID="addsContainer" />
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