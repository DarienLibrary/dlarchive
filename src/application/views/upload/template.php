<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title; ?></title>
<?php 
echo link_tag('css/style.css');
echo link_tag('css/jquery-ui.css');
?>
<script type='text/javascript' src="<? echo base_url(); ?>/js/jquery.min.js" ></script>
<script type='text/javascript' src="<? echo base_url(); ?>/js/jquery-ui.js" ></script>
<script type="text/javascript" src="<? echo base_url();?>/js/jquery.form.js"></script>
</head>
<body>
    
    <?php include FCPATH."application/views/".$view_name.".php"; ?>
    
<script type='text/javascript'>
 $(function() {
	$( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker("option", "dateFormat", "d MM yy");
	$( "#from" ).datepicker();
	$( "#from" ).datepicker("option", "dateFormat", "d MM yy");
	$( "#to" ).datepicker();
	$( "#to" ).datepicker("option", "dateFormat", "d MM yy");
	$("#singleDate").click(function() {
	    $("#dateRangeDiv").hide();
	    $("#from").attr("disabled","disabled");
	    $("#to").attr("disabled","disabled");
	    $("#singleDateDiv").show();
	    $("#datepicker").removeAttr("disabled");
	});
	$("#dateRange").click(function() {
	    $("#dateRangeDiv").show();
	    $("#from").removeAttr("disabled");
	    $("#to").removeAttr("disabled");
	    $("#singleDateDiv").hide();
	    $("#datepicker").attr("disabled","disabled");
	});
   });
</script>
</body>
</html>