<br/>
<div align="right" style="display:inline-block; margin: 0 auto">
    
<form method="POST" action="<?php echo site_url()."search/main" ?>" style ="display:inline-block">
    <div style="margin-bottom:5px">Search for a specific keyword or phrase inside the 'doc_title, doc_desc, filename' fields of the records:</div>
    <input type="text" name="searchbox" id="searchbox" class="input-xlarge" />
    <input type="submit" value="Search" class="btn btn-primary" />
</form>
<br/>
<form method="POST" action="<?php echo site_url()."search/format" ?>" style ="display:inline-block">
    <div style="margin-bottom:5px">Search for records that relate to a certain file format:</div>
    <select name="file_format" id="file_format" class="input-small">
	<option value="text">Text</option>
	<option value="pdf">PDF</option>
	<option value="image">Image</option>
	<option value="audio">Audio</option>
	<option value="video">Video</option>
    </select>
    <input type="submit" value="Search" class="btn btn-primary" />
</form>
<br/>
<form method="POST" action="<?php echo site_url()."search/date" ?>" style ="display:inline-block">
    <div style="margin-bottom:5px">Search for records that are related to a certain time period:</div>
    From: <input type="text" name="from" id="from" />
    To: <input type="text" name="to" id="to" />
    <input type="submit" value="Search" class="btn btn-primary" />
</form>

</div>