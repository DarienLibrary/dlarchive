<?	
	$attributes = array('id' => 'editForm', 'method' => 'POST');
	echo form_open_multipart("manage/edit/$info[doc_id]",$attributes);	
?>
	    <br/>
	    <label for="title">Title: </label>
	    <input type="text" name="title" id="title" value="<? 
		echo ( isset($info['doc_title']) ? $info['doc_title'] : set_value('title'));
	    ?>" class="input-block-level" style="margin-bottom:10px" />
	    <? echo form_error('title'); ?>
	    <label for="description">Description: </label>
	    <textarea name="description" id="description" class="input-block-level" style="margin-bottom:10px"><? 
		echo ( isset($info['doc_desc']) ? $info['doc_desc'] : set_value('description'));
	    ?></textarea>
	    <? echo form_error('description'); ?>
	    <br/>
	    <table width="100%">
		<tr>
		    <td>
			<div id="singleDateDiv" style="display:none">
			    Date:
			    <input type="text" name="datepicker" id="datepicker" disabled="disabled"/>
			</div>
			<span class="error-field" id="datepicker-error"><? echo form_error('datepicker'); ?></span>
			<div id="dateRangeDiv">
			    From: <input type="text" name="from" id="from" />
			    To: <input type="text" name="to" id="to" />
			</div>
			<span class="error-field" id="from-error"></span><? echo form_error('from'); echo form_error('to'); ?><span id="to-error"></span>
		    </td>
		    <td align="right">
			<div style="margin:5px" id="dateTypeSelection">
			    <input type="radio" value="single" name="dateType" id="singleDate">Single Date</input>
			    &nbsp;&nbsp;&nbsp;
			    <input type="radio" value="range" name="dateType" id ="dateRange">Date Range</input>
			</div>
		    </td>
		</tr>
	    </table>
	    <br/>
	    Current File: <input type="text" name="oldfile" value="<? echo $info['filename'] ?>" readonly="true">
	    <input id="itemfile" name="itemfile" class="filestyle" type="file" data-buttonText="Change File" data-icon="false" style="position: fixed; left: -500px;">
	    <span class="error-field" id="itemfile-error"></span>
	    <br/>
	    <div align="center" style="margin-top: 20px">
		<input type="submit" value="Submit" id="submitButton" class="btn btn-primary"/>
	    </div>
	    <div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div>
	</form>
	
	<div id="debug_area" class="debug_area_off"></div>
<script type="text/javascript">$('#dateRange').prop('checked',true);</script>