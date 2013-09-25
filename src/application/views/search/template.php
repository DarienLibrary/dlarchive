<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title; ?></title>
<?php 
echo link_tag('css/bootstrap.css');
echo link_tag('css/bootstrap-responsive.css');
echo link_tag('css/style.css');
echo link_tag('css/jquery-ui.css');
echo link_tag('css/footable.core.css');
echo link_tag('css/footable.standalone.css');
?>
<script type='text/javascript' src="<? echo base_url(); ?>/js/jquery.min.js" ></script>
<script type='text/javascript' src="<? echo base_url(); ?>/js/jquery-ui.js" ></script>
<script type="text/javascript" src="<? echo base_url();?>/js/jquery.form.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/bootstrap.min.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/footable.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/footable.sort.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/footable.filter.js"></script>
</head>
<body>
    
<div class="container">
    <div class="row">
	<div class="span2"></div>
        <div class="span8">
	    <?
	    if ($this->session->userdata('username')) {
		include(FCPATH.'application/menus/menu.php');
		if (isset($active)) 
		    divshot_navbar($menuitems,$active);
		else
		    divshot_navbar($menuitems);
	    }
	    ?>
	</div>
	<div class="span2"></div>
    </div>
    <div class="row">
	<div class="span2"></div>
        <div class="span8">
	    <div class="well2">
		<div class="page-title"><?php echo $page_title; ?></div>
		<?php include FCPATH."application/views/".$view_name.".php"; ?>
	    </div>
	</div>
	<div class="span2"></div>
    </div>
</div>
    
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
	    $("#singleDateDiv").show();
	    $("#from").attr("disabled","disabled");
	    $("#to").attr("disabled","disabled");
	    $("#datepicker").removeAttr("disabled");
	});
	$("#dateRange").click(function() {
	    $("#singleDateDiv").hide();
	    $("#dateRangeDiv").show();
	    $("#from").removeAttr("disabled");
	    $("#to").removeAttr("disabled");
	    $("#datepicker").attr("disabled","disabled");
	});
   });
</script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/bootstrap-filestyle.min.js"></script>

</body>
</html>