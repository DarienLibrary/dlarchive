<?php
$ci =& get_instance();
$ci->edit_rules = array(
                array(
                     'field'	=> 'title', 
                     'label'	=> 'Title', 
		     'rules'	=> 'required|min_length[1]|max_length[254]'
                  ),
		array(
                     'field'	=> 'description', 
                     'label'	=> 'Description',  
		     'rules'	=> 'required|min_length[1]'
                  ),
		array(
                     'field'	=> 'datepicker', 
                     'label'	=> 'Date', 
		     'rules'	=> 'callback_requiredDatepicker'
                  ),
		array(
                     'field'	=> 'from',  
		     'label'	=> 'From',
		     'value'	=> 'callback_requiredFrom'
                  ),
		array(
                     'field'	=> 'to',  
		     'type'	=> 'To',
		     'value'	=> 'callback_requiredTo'
                  )
            );

?>
