<?php

class FormValidator {

    private $rules = array();
    private $errors = array();	// This array contains the validation errors, if there is any. For each form field
				// only the first validation error is stored. After the first validation error, the
				// validation stops for that field. 
    
    function __construct($formRules) {
	if (is_array($formRules)) {
	    $this->rules = $formRules;
	} else {
	    die("FormValidator's constructor failed! Argument was not an array!");
	}
    }
    
    private function required($fieldname,$isRequired){
	
	if (isset($_POST[$fieldname]))
	    $value = $_POST[$fieldname];
	elseif (isset($_FILES[$fieldname]))
	    $value = $_FILES[$fieldname]['name'];
	
	// If the form field has been posted
	if (isset($value)) {
	    // The field value should not be empty
	    if ($value == '') {
	        if ($isRequired) 
		    $this->errors[$fieldname] = 'This field is required';
	        // Required or not, since it is empty, there is no meaning to 
		// continue testing the rest of the rules!
		return false;
	    }
	    return true;
	} // If the form field has not been posted 
	else {
	    if ($isRequired)
		$this->errors[$fieldname] = 'This field is required';
	    // Required or not, since it has not been posted, we cannot continue 
	    // testing the rest of the rules!
	    return false;
	}
    }
    
    private function required_ifnot($fieldname,$fieldname2){
	if (!isset($_POST[$fieldname2])){
	    return $this->required($fieldname,true);
	}
    }
    
    private function required_if($fieldname,$fieldname2){
	if (isset($_POST[$fieldname2])){
	    return $this->required($fieldname,true);
	}
    }
    
    private function date_range_with($fieldname,$fieldname2){
	$from = strtotime($_POST[$fieldname]);
	$to = strtotime($_POST[$fieldname2]);
	if ($from<=$to) {
	    $this->errors[$fieldname] = "The time period you submitted 'From: $_POST[$fieldname] To: $_POST[$fieldname2]' is not valid!";
	    return true;
	}
	else
	    return false;
    }
    
    public function alpha($fieldname)
    {
	$value = $_POST[$fieldname];
	if (!preg_match("/^\pL+$/u",$value)) {
	    $this->errors[$fieldname] = "This field should not contain anything other than alphabetical characters!";
	    return false;
	} else {
	    return true;
	}
	//return ( ! preg_match("/^([a-z])+$/iu", $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric($fieldname)
    {
	$value = $_POST[$fieldname];
	if ( ! preg_match("/^([a-z0-9])+$/i", $value)) {
	    $this->errors[$fieldname] = "This field should not contain anything other than alphanumeric characters!";
	    return false;
	} else {
	    return true;
	}
    }
    
    public function alpha_dash($fieldname)
    {
	$value = $_POST[$fieldname];
	if ( ! preg_match("/^([-a-z0-9_-])+$/i", $value)) {
	    $this->errors[$fieldname] = "This field should not contain anything other than alpha-numeric characters, underscores or dashes!";
	    return false;
	} else {
	    return true;
	}
    }
    
    private function numeric($fieldname){
	$value = $_POST[$fieldname];
	if ( ! preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $value)) {
	    $this->errors[$fieldname] = "This field should not contain anything other than numeric characters!";
	    return false;
	} else {
	    return true;
	}
    }
    
    private function integer($fieldname){
	$value = $_POST[$fieldname];
	if ( ! preg_match('/^[\-+]?[0-9]+$/', $value)) {
	    $this->errors[$fieldname] = "This field should not contain anything other than an integer!";
	    return false;
	} else {
	    return true;
	}
    }
    
    private function min_value($fieldname,$min){
	$value = (float)$_POST[$fieldname];
	if ($value<$min) {
	    $this->errors[$fieldname] = "The value of this field cannot be smaller than $min";
	    return false;
	} else {
	    return true;
	}
    }
    
    private function max_value($fieldname,$max){
	$value = (float)$_POST[$fieldname];
	if ($value>$max) {
	    $this->errors[$fieldname] = "The value of this field cannot be greater than $max";
	    return false;
	} else {
	    return true;
	}
    }
    
    private function valid_email($fieldname){
	$value = $_POST[$fieldname];
	if ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value)) {
	    $this->errors[$fieldname] = "This field should contain a valid email address!";
	    return false;
	} else {
	    return true;
	}
    }
    
    public function min_length($fieldname, $length)
    {
	$value = $_POST[$fieldname];
	if (preg_match("/[^0-9]/", $length))
	{
		die('Illegal argument to min_length method!');
	}

	if (function_exists('mb_strlen'))
	{
	    $valid = (mb_strlen($value) < $length) ? FALSE : TRUE;
	} else {
	    $valid = (strlen($value) < $length) ? FALSE : TRUE;
	}
	if (!$valid){
	    $this->errors[$fieldname] = "The value you have entered is shorter than required!";
	    return false;
	} else {
	    return true;
	}
    }
    
    private function max_length($fieldname, $length){
	$value = $_POST[$fieldname];
	if (preg_match("/[^0-9]/", $length))
	{
		die('Illegal argument to max_length method!');
	}

	if (function_exists('mb_strlen'))
	{
	    $valid = (mb_strlen($value) > $length) ? FALSE : TRUE;
	} else {
	    $valid = (strlen($value) > $length) ? FALSE : TRUE;
	}
	if (!$valid){
	    $this->errors[$fieldname] = "The value you have entered is longer than required!";
	    return false;
	} else {
	    return true;
	}
    }
    
    private function vocabulary($fieldname,$list_str){
	$list = explode(',',$list_str);
	$value = $_POST[$fieldname];
	if (in_array($value,$list)){
	    return true;
	} else {
	    $this->errors[$fieldname] = "This value is invalid!";
	    return false;
	}
    }
    
    private function extensions($fieldname,$ext_str){
	$filename = $_FILES[$fieldname]['name'];
	$path_parts = pathinfo($filename);
	$ext = $path_parts['extension'];
	$ext_list = explode(',',$ext_str);
	if(in_array($ext, $ext_list)){
	    return true;
	} else {
	    $this->errors[$fieldname] = "This file type is not valid!";
	    return false;
	}
    }
    
    // $max should be in MB
    private function max_filesize($fieldname,$max){
	$filesize = $_FILES[$fieldname]['size']/1000000;
	if ($filesize <= $max){
	    return true;
	} else {
	    $this->errors[$fieldname] = "This image is bigger than $max MB!";
	    return false;
	}
    }
    
    public function getErrors(){
	return $this->errors;
    }
    
    public function printErrors(){
	if (count($this->errors) == 0) 
	    echo "No errors exist!";
	else {
	    echo "<pre>";
	    var_dump($this->errors);
	}
    }
    
    // Validate a specific field
    private function validateField($fieldname,$fieldRules){
	//DEBUG echo "Field: $fieldname <br/>";
	foreach($fieldRules as $ruleName => $value){
	    if ($value === '')
		$validRule = $this->{$ruleName}($fieldname);
	    else
		$validRule = $this->{$ruleName}($fieldname,$value);
	    //DEBUG echo "-----$ruleName: ";
	    //DEBUG if ($validRule) echo "true<br/>"; else echo "false<br/>";
	    if (!$validRule)
		return false;
	}
    }
    
    // Validate all fields defined in the form structure
    public function validate(){
	foreach ($this->rules as $fieldname => $fieldRules){
	    $this->validateField($fieldname,$fieldRules);
	}
	if (count($this->errors) == 0)
	    return true;
	else 
	    return false;
    }
    
}