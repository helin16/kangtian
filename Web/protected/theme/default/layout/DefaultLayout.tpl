<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<link rel="stylesheet" type="text/css" href="http://localhost/default.css" />
</com:THead>
<body>
	<center>
		<com:TForm>
			<table ID="wrapper" border='1' cellspacing="0" cellpadding="0" >
				<tr>
					<td ID="left">
						<table width="100%" cellspacing="0" cellpadding="0">
							<tr class="header">
								<td ID="Logo"></td>
							</tr>
							<tr>
								<td> 
									<com:Application.controls.Module.WebModule ID="left" type="Div" Position="Left"/>
								</td>
							</tr>
						</table>
					</td>
					<td class="gap" />
					<td ID="mid">
						<table width="100%" cellspacing="0" cellpadding="0">
							<tr class="header">
								<td>
									<com:Application.controls.Module.WebModule ID="header" type="Div"/>
								</td>
							</tr>
							<tr>
								<td> 
									<div ID="bodyWrapper">
										<com:TContentPlaceHolder ID="MainContent" />
									</div>
								</td>
							</tr>
						</table>
					</td>
					<td class="gap" />
					<td ID="right">
						<table width="100%" cellspacing="0" cellpadding="0">
							<tr class="header">
								<td ID="contactUs"></td>
							</tr>
							<tr>
								<td> 
									<com:Application.controls.Module.WebModule ID="right" type="Div"  Position="right"/>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<com:Application.controls.Module.WebModule ID="footer" type="Div"/>
					</td>
				</tr>
			</table>
		</com:TForm>
	<center>
</body>
</html>