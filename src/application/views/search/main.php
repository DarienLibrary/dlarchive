<br/>
<div align="right" style="display:inline-block; margin: 0 auto">
    
    <table style="font-size:13px; text-align: justify">
	<tr>
	    <td width="30%">
		<div style="margin-bottom:5px; color:grey">Search for a specific keyword or phrase inside the 'doc_title, doc_desc, filename' fields of the records:</div>
	    </td>
	    <td align="right">
		<form method="POST" action="<?php echo site_url()."search/main" ?>" style ="display:inline-block">
		    <input type="text" name="searchbox" id="searchbox" class="input-xlarge" />
		    <input type="submit" value="Keyword Search" class="btn btn-primary" />
		</form>
	    </td>
	</tr>
	<tr>
	    <td>
		<div style="margin-bottom:5px; color:grey"><br/>Search for records that relate to a certain file format:<br/></div>
	    </td>
	    <td align="right">
		<form method="POST" action="<?php echo site_url()."search/format" ?>" style ="display:inline-block">
		    <select name="file_format" id="file_format" class="input-small">
			<option value="text">Text</option>
			<option value="pdf">PDF</option>
			<option value="image">Image</option>
			<option value="audio">Audio</option>
			<option value="video">Video</option>
		    </select>
		    <input type="submit" value="Filetype Search" class="btn btn-primary" />
		</form>
	    </td>
	</tr>
	<tr>
	    <td>
		<div style="margin-bottom:5px; color:grey"><br/>Search for records that are related to a certain time period:<br/></div>
	    </td>
	    <td align="right">
		<form method="POST" action="<?php echo site_url()."search/date" ?>" style ="display:inline-block">
		    From: <input type="text" name="from" id="from" class="input-medium" />
		    To: <input type="text" name="to" id="to" class="input-medium" />
		    <input type="submit" value="Date Search" class="btn btn-primary" />
		</form>
	    </td>
	</tr>
    </table>

</div>