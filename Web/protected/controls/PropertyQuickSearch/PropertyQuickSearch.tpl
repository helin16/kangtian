<com:TPanel ID="propertyQuickSearchPanel" DefaultButton="PropertyQuickSearchBtn">
	<script type="text/javascript">
		function quickSearch_<%= $this->getClientId()%>()
		{
			var propertyTypeId =$('<%= $this->propertyTypeList->getClientId()%>').value;
			var buildingTypeId =$('<%= $this->buildingTypeList->getClientId()%>').value;
			var maxPrice =$('<%= $this->maxPrice->getClientId()%>').value;
			var minPrice =$('<%= $this->minPrice->getClientId()%>').value;
			var suburb =$('<%= $this->suburbList->getClientId()%>').value;
			window.location='project/search/'+propertyTypeId + '/' + buildingTypeId + '/all/' + maxPrice + '/' + minPrice + '/' + suburb;
		}
	</script>
	<style>
		table#propertyQuickSearch td
		{
			padding:2px;
		}
		table#propertyQuickSearch td#title
		{
			font-size:12px;
			font-weight:bold;
		}
	</style>
	<table width="100%" cellspacing="0" cellpadding="0" Id="propertyQuickSearch">
		<tr>
			<td id="title">
				<%[ propertyQuickSearch.title ]%>
			</td>
		</tr>
		<tr>
			<td>
				<com:TDropDownList Id="propertyTypeList" DataTextField="name" DataValueField="id" style="width:100%"/>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<com:TDropDownList Id="minPrice" 
								DataTextField="1" DataValueField="0" style="width:100%"
								PromptText="Min"
								PromptValue="all"
								/>
						</td>
						<td>
							<com:TDropDownList Id="maxPrice" 
								PromptText="Max"
								PromptValue="all"
								DataTextField="1" DataValueField="0" style="width:100%"/>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<com:TDropDownList Id="suburbList" 
					DataTextField="suburb" 
					DataValueField="suburb"  
					PromptText="-- All Suburbs --"
					PromptValue="all"
					style="width:100%"/>
			</td>
		</tr>
		<tr>
			<td>
				<com:TDropDownList Id="buildingTypeList"  DataTextField="name" DataValueField="id"  style="width:100%"
					PromptText="-- All Types --"
					PromptValue="all"/>
			</td>
		</tr>
		<tr>
			<td align="right">
				<com:TButton ID="PropertyQuickSearchBtn" Text="<%[propertyQuickSearch.submitBtn]%>" 
						Attributes.OnClick="quickSearch_<%= $this->getClientId()%>();return false;" 
						style="background: #BF3A17;color:white; border: 0;"/>
			</td>
		</tr>
	</table>	
</com:TPanel>