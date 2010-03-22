<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<link rel="stylesheet" type="text/css" href="/css/default.css" />
</com:THead>
<body>
	<center>
		<com:TForm>
			<table ID="wrapper" border='0' cellspacing="0" cellpadding="0" >
				<tr>
					<td id="top">
						<table id="header" border='0' cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<td style="padding: 20px 0 15px 0;">
									<img src="/images/Logo2.png" Title="Logo"/>
								</td>
							</tr>
							<tr>
								<td class="menu" style="background:#A40404;">
									<com:Application.controls.Module.Menu.MenuModule ID="topMenu"/>
								</td>
							</tr>
							<tr>
								<td>
									<table border='0' cellspacing="0" cellpadding="0" width="100%">
										<tr>
											<td>
												<img src="/images/banner1.jpg" />
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td id="mid">
						<div  style="padding: 40px 5px 40px 5px;width:970px;min-height:300px;">
							<com:TContentPlaceHolder ID="MainContent" />
						</div>
					</td>
				</tr>
				<tr>
					<td id="bottom">
						<table border='0' cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<td style="padding: 20px 0 15px 0;">
									<com:TPanel ID="footerPanel" />
								</td>
							</tr>
							<tr>
								<td class="menu" style="background:#B8B7B2;">
									<com:Application.controls.Module.Menu.MenuModule ID="bottomMenu"/>
								</td>
							</tr>
							<tr>
								<td>
									<div style="padding:15px 0 15px 15px;">
										Copyright &copy; Australian Realty Group (ARG) 2003 - 2012 
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</com:TForm>
	<center>
</body>
</html>