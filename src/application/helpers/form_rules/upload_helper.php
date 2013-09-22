<?php
$ci =& get_instance();	// we want to store the validation rules as a property of the controller
$ci->upload_rules = array(
    'title'	=>  array(
	'required'  =>	true,
	'max_length'=>	254,
	'min_length' =>	1,
    ),
    'description'	=>  array(
	'required'  =>	true,
	'min_length' =>	1,
    ),
    'itemfile'	=>  array(
	'required'  =>	true,
	'extensions'=>	'jpg,png,giff,bmp,tiff,pdf,txt,rtf,doc,odt,docx,mp3,mp4',
    ),
    'datepicker'=>  array(
	'required_ifnot'  =>	'from',
    ),
    'from'=>  array(
	'required_ifnot'  =>	'datepicker',
    ),
    'to'=>  array(
	'required_if'		    =>	'from',
	'date_range_with'	    =>	'from',
    ),

);