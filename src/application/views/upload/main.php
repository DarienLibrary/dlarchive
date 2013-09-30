<script>
 
        $(document).ready(function() {
        
	
	$('#debug').change(function(){
	    if (!$(this).is(':checked')){
		$('#debug_area').removeClass('debug_area_on');
		$('#debug_area').addClass('debug_area_off');
	    }
	});
	
        var progressbox     = $('#progressbox');
        var progressbar     = $('#progressbar');
        var statustxt       = $('#statustxt');
        var submitbutton    = $("#submitButton");
        var myform          = $("#uploadForm");
        var completed       = '0%';
	
	// Let's make the progress bar same width as the input fields'
	var fieldwidth = $('#title').width();
	progressbox.width(fieldwidth);
		// Define the AJAX call
                $(myform).ajaxForm({
                    beforeSend: function() { //actions taking place before sending the form
                        submitbutton.attr('disabled', ''); // disable upload button
                        statustxt.empty();
                        progressbox.slideDown(); //show progressbar
                        progressbar.width(completed); //initial value 0% of progressbar
                        statustxt.html(completed); //set status text
                        statustxt.css('color','#000'); //initial color of status text
			
			$('#title-error').html('');
			$('#description-error').html('');
			$('#datepicker-error').html('');
			$('#from-error').html('');
			$('#to-error').html('');
			$('#itemfile-error').html('');
			$('#debug_area').html('');
                    },
                    uploadProgress: function(event, position, total, percentComplete) { //on progress
                        progressbar.width(percentComplete + '%') //update progressbar percent complete
                        statustxt.html(percentComplete + '%'); //update status text
                        if(percentComplete>50)
                            {
                                statustxt.css('color','#fff'); //change status text to white after 50%
                            }
                        },
                    complete: function(response) { // on complete                        
                        submitbutton.removeAttr('disabled'); //enable submit button
                        progressbox.slideUp(); // hide progressbar
			//
			// Check if Server and Codeigniter responde with an error. In that case diplay the error
			if ((response.status != 200)||(response.responseText.indexOf('Fatal error') != -1)||(response.responseText.indexOf('Warning') != -1)) {
			    $('body').append(response.responseText);
			} else { 
			    // Parse the response as a JSON object
			    obj = JSON && JSON.parse(response.responseText) || $.parseJSON(response.responseText);
			    // If there were validation errors, display them
			    if (obj[0] == 'false') {
				if (typeof obj[1].title !== 'undefined'){
				    $('#title-error').append('<strong>Warning:</strong> ' + obj[1].title);
				    $('#title-error').addClass('alert alert-error');
				}
				if (typeof obj[1].description !== 'undefined'){
				    $('#description-error').append('<strong>Warning:</strong> ' + obj[1].description);
				    $('#description-error').addClass('alert alert-error');
				}
				if (typeof obj[1].datepicker !== 'undefined'){
				    $('#datepicker-error').append('<strong>Warning:</strong> ' + obj[1].datepicker);
				    $('#datepicker-error').addClass('alert alert-error');
				}
				if (typeof obj[1].from !== 'undefined'){
				    $('#from-error').append('<strong>Warning:</strong> ' + obj[1].from);
				    $('#from-error').addClass('alert alert-error');
				}
				if (typeof obj[1].to !== 'undefined'){
				    $('#to-error').append('<strong>Warning:</strong> ' + obj[1].to);
				    $('#to-error').addClass('alert alert-error');
				}
				if (typeof obj[1].itemfile !== 'undefined'){
				    $('#itemfile-error').append('<strong>Warning:</strong> ' + obj[1].itemfile);
				    $('#itemfile-error').addClass('alert alert-error');
				}
			    } else {
				// If we are in debug mode, display the database record that was sent back
				if(obj[0] == 'debug'){
				    $('#debug_area').append('<div align="center" style="font-weight:bold; font-size: 20px; margin-bottom:15px">Database record for submitted data:</div>');
				    $('#debug_area').append("<strong>Title:</strong> " + obj[1].doc_title + "<br/>");
				    $('#debug_area').append("<strong>Description:</strong> "+obj[1].doc_desc + "<br/>");
				    $('#debug_area').append("<strong>Record date:</strong> "+obj[1].record_date + "<br/>");
				    $('#debug_area').append("<strong>Datetime start:</strong> "+obj[1].datetime_start + "<br/>");
				    $('#debug_area').append("<strong>Datetime end:</strong> "+obj[1].datetime_end + "<br/>");
				    $('#debug_area').append("<strong>Filename:</strong> "+obj[1].filename + "<br/>");
				    $('#debug_area').append("<strong>Format:</strong> "+obj[1].format + "<br/>");
				    if (obj[1].format == 'pdf'){
					$('#debug_area').append("<strong>PDF Text:</strong> "+obj[1].doc_text + "<br/>");
				    }
				    $('#debug_area').removeClass('debug_area_off');
				    $('#debug_area').addClass('debug_area_on');
				} else {
				    // If file and database record were stored, reload page
				    window.location.href = obj[1];
				}
			    }
			}
                    }
            });
        });

</script>

<?	
	$attributes = array('id' => 'uploadForm', 'method' => 'POST');
	echo form_open_multipart("upload/uploading",$attributes);	
?>

<table width="100%">
    <tr>
	<td align="right" colspan="3">
	    <label class="checkboox" for="debug">
		    <input type="checkbox" name="debug" id="debug" />
		    <span>Debuging mode</span>
	    </label>
	</td>
    </tr>
    <tr>
	<td colspan="3">&nbsp;</td>
    </tr>
    <tr>
	<td width="100px"><label for="title">Title: </label></td>
	<td align="left" colspan="2">
	    <input type="text" name="title" id="title" value="" class="input-block-level" style="margin-bottom:10px" />
	</td>
    </tr>
    <tr>
	<td colspan="3"><div id="title-error"></div></td>
    </tr>
    <tr>
	<td  style="vertical-align: top"><label for="description">Description: </label></td>
	<td colspan="2">
	    <textarea name="description" id="description" class="input-block-level"  style="margin-bottom:10px"></textarea>
	</td>
    </tr>
    <tr>
	<td colspan="3"><div id="description-error"></div></td>
    </tr>
    <tr>
	<td><label>Date: </label></td>
	<td>
	    <div id="singleDateDiv">
		<input type="text" name="datepicker" id="datepicker"  style="margin-bottom:10px"/>
	    </div>
	    <div id="dateRangeDiv" style="display:none">
		From: <input type="text" name="from" id="from" disabled="disabled" class="input-medium" />
		To: <input type="text" name="to" id="to" disabled="disabled" class="input-medium" />
	    </div>
	</td>
	<td align="right" style="vertical-align: middle">
	  
		<input type="radio" value="single" name="dateType" id="singleDate" style="margin-bottom: 3px"> Single Date</input>
		&nbsp;&nbsp;&nbsp;
		<input type="radio" value="range" name="dateType" id ="dateRange" style="margin-bottom: 3px"> Date Range</input>
	  
	</td>
    </tr>
    <tr>
	<td colspan="3">
	    <div id="datepicker-error"></div><div id="from-error"></div><div id="to-error"></div>
	</td>
    </tr>
    <tr>
	<td colspan="3">&nbsp;</td>
    </tr>
    <tr>
	<td><label>Document: </label></td>
	<td colspan="2">
	    <input id="itemfile" name="itemfile" class="filestyle" type="file" data-icon="false" style="position: fixed; left: -500px;">
	</td>
    </tr>
    <tr>
	<td colspan="3"><div id="itemfile-error" style="margin-top:5px"></div></td>
    </tr>
    <tr>
	<td colspan="3"><br/><br/></td>
    </tr>
    <tr>
	<td align="center" colspan="3">
	    <input type="submit" value="Submit" id="submitButton" class="btn btn-primary"/>
	</td>
    </tr>
    <tr>
	<td colspan="3" align="center">
	    <div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div>
	</td>
    </tr>
</table>
	   
	</form>
	
	<div id="debug_area" class="debug_area_off"></div>
<script type="text/javascript">$('#singleDate').prop('checked',true);</script>