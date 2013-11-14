<br/>
<div align="right" style="display:inline-block; margin: 0 auto">
    
    <form method="POST" action="<?php echo site_url()."search/main" ?>" style ="display:inline-block">
    <table style="font-size:13px; color:grey; border-collapse: separate; border-spacing: 10px">
	<tr>
	    <td width="100px">
		Keyword: 
	    </td>
	    <td>
		    <input type="text" name="keyword" id="keyword" class="input-xlarge" />
	    </td>
	</tr>
	<tr>
	    <td>
		File format:
	    </td>
	    <td>
		<table style="font-size:13px; color:grey;" width="100%">
		    <tr><td align="left">
		    <select name="file_format" id="file_format" class="input-medium">
			<option value="all">All formats</option>
			<option value="text">Text</option>
			<option value="pdf">PDF</option>
			<option value="image">Image</option>
			<option value="audio">Audio</option>
			<option value="video">Video</option>
		    </select>
			</td><td align="right">
		Results per page: 
		    <select name="results_per_page" id="results_per_page" class="input-mini">
			<option value="10">10</option>
			<option value="20" selected="selected">20</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="all">1000</option>
		    </select>
			</td></tr>
		</table>
	    </td>
	</tr>
	<tr>
	    <td>
		Time period:
	    </td>
	    <td>
		    From: <input type="text" name="from" id="from" class="input-medium" />
		    To: <input type="text" name="to" id="to" class="input-medium" />
	    </td>
	</tr>
	<tr>
	    <td colspan="2" align="center">
		<br/><input type="submit" value="Search" class="btn btn-primary" />
	    </td>
	</tr>
    </table>
    </form>

</div>