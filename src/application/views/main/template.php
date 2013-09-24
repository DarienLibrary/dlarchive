<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title; ?></title>
<?
echo link_tag('css/bootstrap.css');
echo link_tag('css/bootstrap-responsive.css');
echo link_tag('css/style.css');
?>
<script type='text/javascript' src="<? echo site_url(); ?>/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
	<div class="span2"></div>
        <div class="span8">
	    <div class="well2">
		<?php include FCPATH."application/views/".$view_name.".php"; ?>
	    </div>
	</div>
	<div class="span2"></div>
    </div>
</div>
</body>
</html>
