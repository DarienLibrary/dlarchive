<br/>
<div align="left">
Filter results: <input type="text" id="search-box" /> <span style="color:#CCCCCC">(searching through all fields)</span>
</div>
<br/>
<table border="1px solid grey" style="empty-cells:hide" cellpadding="3px" class="footable toggle-square" data-filter="#search-box" data-filter-text-only="true">
    <thead>
	<tr>
	    <th data-sort-ignore='true' data-hide='all' data-ignore='true'>ID</th>
	    <th data-sort-initial='ascennding' data-toggle='true'>Title</th>
	    <th data-sort-ignore='true' data-hide="all">Description</th>
	    <th data-sort-ignore='true' data-hide="all">PDF Text</th>
	    <th data-sort-ignore='true' data-hide='all'>Last edited</th>
	    <th data-sort-ignore='true' data-hide='phone'>From</th>
	    <th data-sort-ignore='true' data-hide='phone'>To</th>
	    <th data-sort-ignore='true'>Filename</th>
	    <th data-hide='phone,tablet'>Format</th>
	    <th data-hide='phone,tablet'>File size (KB)</th>
	    <th data-hide='all'>Duration (sec)</th>
	    <th data-hide='all'>x Resolution (pixel)</th>
	    <th data-hide='all'>y Resolution (pixel)</th>
	    <th data-sort-ignore='true' style="min-width:50px">Actions</th>
	</tr>
    </thead>
    <tbody>
    <?php
    foreach($list as $record){
	?>
	<tr>
	    <?
	    foreach ($record as $field) {
		echo "<td>$field</td>";
	    }
	    echo "<td>";
		echo "<a href='".  site_url()."manage/edit/$record[doc_id]'><img src='".  site_url()."/images/edit.png' style='height:20px' /></a> ";
		echo "<a href='".  site_url()."manage/delete/$record[doc_id]'><img src='".  site_url()."/images/delete.png' style='height:20px' /></a>";
	    echo "</td>";
	    ?>
	</tr>
	<?
    }
    ?>
    </tbody>
</table>