<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title; ?></title>
<?php 
echo link_tag('css/bootstrap.css');
echo link_tag('css/bootstrap-responsive.css');
echo link_tag('css/style.css');
?>
<script type='text/javascript' src="<? echo base_url(); ?>/js/jquery.min.js" ></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/bootstrap.min.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/rgraph/RGraph.common.core.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/rgraph/RGraph.common.effects.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/rgraph/RGraph.common.tooltips.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/rgraph/RGraph.common.dynamic.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/rgraph/RGraph.bar.js"></script>
<script type='text/javascript' src="<? echo site_url(); ?>/js/rgraph/RGraph.pie.js"></script>
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
    
</body>
</html>