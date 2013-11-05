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
		    <select name="file_format" id="file_format" class="input-medium">
			<option value="all">All formats</option>
			<option value="text">Text</option>
			<option value="pdf">PDF</option>
			<option value="image">Image</option>
			<option value="audio">Audio</option>
			<option value="video">Video</option>
		    </select>
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