<com:TPanel ID="projectImagesPanel">
	<style>
		.imageItem:hover
		{
			cursor:pointer;
			cursor:hand;
			background:#999999;
		}
	</style>
	<script type="text/javascript">
		function showFullImage_<%= $this->getClientId()%>(assetId)
		{
			var dimension = '<%= serialize($this->image_dimension) %>';
			$('projectImagesPanel_fullImageTd').innerHTML = "<img src='/asset/" + assetId + "/" + dimension + "'  />"; 
		}
	</script>
	<table width="100%">
		<tr>
			<td Id="projectImagesPanel_fullImageTd" style="width:<%= $this->image_dimension['width'] + 10 %>px; padding: 0 10px 0;">
				<com:TImage ID="projectImagesPanel_fullImage" />
			</td>
			<td valign="top">
				<com:TPanel ID="projectImagesPanel_imageList" />
			</td>
		</tr>
	</table>
</com:TPanel>