<br/>
<div align="left">
Filter results: <input type="text" id="search-box" /> <span style="color:#CCCCCC">(searching through all fields)</span>
</div>
<br/>
<table border="1px solid grey" cellpadding="3px" class="footable toggle-square" data-filter="#search-box" data-filter-text-only="true">
    <thead>
	<tr>
	    <th data-sort-initial='ascennding'>Title</th>
	    <th data-sort-ignore='true' >Description</th>
	    <th data-sort-ignore='true' data-hide="all">PDF Text</th>
	    <th data-sort-ignore='true' >Last edited</th>
	    <th data-sort-ignore='true' >From</th>
	    <th data-sort-ignore='true'>To</th>
	    <th >Format</th>
	    <th data-sort-ignore='true'>Filename</th>
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
	    ?>
	</tr>
	<?
    }
    ?>
    </tbody>
</table>