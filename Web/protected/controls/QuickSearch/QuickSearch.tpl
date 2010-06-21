<com:TPanel ID="quickSearchPanel" DefaultButton="quickSearchBtn">
	<script type="text/javascript">
		function quickSearch()
		{
			var searchValue =$('searchText').value;
			window.location='/search/'+searchValue;
		}
	</script>
	<table width="100%">
		<tr>
			<td style="background:transparent url(/image/searchTextBg.jpg) no-repeat left top; padding:0 0 0 5px;">
				<input type="text" ID="searchText" 
					style="border:none;
						height:15px;
						width:100%;
						margin:0px;"
						 />
			</td>
			<td width="14px">
				<com:TImageButton ID="quickSearchBtn" ImageUrl="/image/searchBtn.jpg" Text="search" Attributes.OnClick="quickSearch();return false;"/>
			</td>
		</tr>
	</table>	
</com:TPanel>