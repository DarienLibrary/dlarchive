<!-- 
We use AJAX call to handle the form submittion, in order to diplsay an upload progress bar
-->
<script>
 
        $(document).ready(function() {
        
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
			
			// Check if Server and Codeigniter responde with an error. In that case diplay the error
			if ((response.status != 200)||(response.responseText.indexOf('Fatal error') != -1)) {
			    $('body').append(response.responseText);
			} else { 
			    // Parse the response as a JSON object
			    obj = JSON && JSON.parse(response.responseText) || $.parseJSON(response.responseText);
			    // If there were validation errors, display them
			    if (obj[0] == 'false') {
				$('#title-error').append(obj[1].title);
				$('#description-error').append(obj[1].description);
				$('#datepicker-error').append(obj[1].datepicker);
				$('#from-error').append(obj[1].from);
				$('#to-error').append(obj[1].to);
				$('#itemfile-error').append(obj[1].itemfile);
			    } else {
				// If we are in debug mode, display the database record that was sent back
				if(obj[0] == 'debug'){
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
	    <input type="checkbox" name="debug" id="debug" value="aaa" />Debuging mode<br/>
	    <label for="title">Title: </label>
	    <input type="text" name="title" id="title" value="" />
	    <span class="error-field" id="title-error"></span>
	    <br/>
	    <label for="description">Description: </label><br/>
	    <textarea name="description" id="description" ></textarea>
	    <span class="error-field" id="description-error"></span>
	    <br/>
	    <div style="margin:5px">
		<input type="radio" value="single" name="dateType" id="singleDate" >Single Date</input>
		<input type="radio" value="range" name="dateType" id ="dateRange">Date Range</input>
	    </div>
	    <div id="singleDateDiv">
		<label for="datepicker">Date:</label> <input type="text" name="datepicker" id="datepicker" />
	    </div>
	    <span class="error-field" id="datepicker-error"></span>
	    <div id="dateRangeDiv" style="display:none">
		From: <input type="text" name="from" id="from" disabled="disabled" />
		To: <input type="text" name="to" id="to" disabled="disabled" />
	    </div>
	    <span class="error-field" id="from-error"></span><span id="to-error"></span>
	    <br/>
	    <label for="itemfile">File Selection: </label>
	    <input type="file" name="itemfile" id="itemfile" />
	    <span class="error-field" id="itemfile-error"></span>
	    <br/><br/>
	    <div>
		<input type="submit" value="Αποστολή" id="submitButton"/>
	    </div>
	    <div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div>
	</form>
	<br/>
	<div id="debug_area" class="debug_area_off"></div>
	<a href="<? echo base_url().'main/logout'; ?>">Logout</a>
<script type="text/javascript">$('#singleDate').prop('checked',true);</script>