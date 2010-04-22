<table id="topMenu" width="100%" style="height:40px;" border='0' cellspacing="0" cellpadding="0">
	<tr>
		<td class="topmenulink" width="20%" >
			<a href="/" <%= $this->changeId('home') %>><%[Menu.home]%></a>
		</td>
		<td class="topmenulink" width="20%">
			<a href="/aboutus.html" <%= $this->changeId('aboutus') %>><%[Menu.aboutus]%></a>
		</td>
		<td class="topmenulink" width="20%">
			<a href="/services.html" <%= $this->changeId('services') %>><%[Menu.services]%></a>
		</td>
		<td class="topmenulink" width="20%">
			<a href="/projects.html" <%= $this->changeId('projects') %>><%[Menu.projects]%></a>
		</td>
		<td>
			<a href="/contactus.html" <%= $this->changeId('contactus') %>><%[Menu.contactus]%></a>
		</td>
	</tr>
</table>