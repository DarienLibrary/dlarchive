<?php

if ( ! function_exists('divshot_navbar')) {
    function divshot_navbar($menu_list,$active=null){
	if ('a' == 'a') { ?>
	    <div class="navbar">
		    <div class="navbar-inner">
		    <div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		</a>
			<a class="brand" href="<? echo site_url(); ?>/main/index"><img src='<? echo base_url().'/images/archiver.png'; ?>' style="height:20px;" /></a>
			<div class="nav-collapse collapse">
			<ul class="nav pull-right">
			    <?
				foreach($menu_list as $item){
				    if ($active == $item['id'])
					echo "<li class='active'>".anchor($item['target'],$item['label'])."</li>";
				    else
					echo "<li>".anchor($item['target'],$item['label'])."</li>";
				}
			    ?>
			</ul>
			</div>
		    </div>
		    </div>
	    </div>
	<? 
	}
    }
}