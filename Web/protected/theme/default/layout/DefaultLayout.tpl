<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<link rel="stylesheet" type="text/css" href="/stream?method=getCss" />
</com:THead>
<body>
	<center>
		<com:TForm>
			<table ID="wrapper" border='0' cellspacing="0" cellpadding="0" >
				<tr>
					<td id="top">
						<div class="wrapper_container">
							<table id="header" border='0' cellspacing="0" cellpadding="0" width="100%">
								<tr>
									<td style="padding: 20px 0 15px 0;">
										<img src="/stream?method=getImage&imagePath=images/Logo.png" Title="Logo"/>
									</td>
								</tr>
								<tr>
									<td class="menu">
										<com:Application.controls.Module.Menu.MenuModule ID="topMenu"/>
									</td>
								</tr>
								<tr>
									<td>
										<div style="height:200px;padding:15px 0 15px 15px;">
										fdsfdsa
											<com:Application.controls.Module.WebModule ID="Banner" type="Div"/>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td id="mid">
						<div class="wrapper_container">
							<com:TContentPlaceHolder ID="MainContent" />
						</div>
					</td>
				</tr>
				<tr>
					<td  id="bottom">
						<div class="wrapper_container">
							<com:Application.controls.Module.WebModule ID="bottom" type="Div"/>
						</div>
					</td>
				</tr>
			</table>
		</com:TForm>
	<center>
</body>
</html>