<?php
    // Preparing the data for the bar chart
    $max = max($ffcount)*1.1; // We set the chart's height according to the maximum value
    $count_data_string = implode(',',$ffcount);
    $count_labels_string = implode("','",array_keys($ffcount));
    $count_tooltip_string = implode("','",$ffcount);
    
    // Preparing the data for the pie chart
    $size_data_string = implode(',',$ffsize);
    $size_labels_string = implode("','",array_keys($ffsize));
    $size_tooltip_string = null;
    foreach($ffsize as $value){
	if ($value<1000)
	    $size_tooltip_string .= "'".number_format($value,1)." KB',";
	elseif($value<1000000)
	    $size_tooltip_string .= "'".number_format(($value/1000),1)." MB',";
	else
	    $size_tooltip_string .= "'".number_format(($value/1000000),1)." GB',";
    }
?>
<br><br>
<!-- Each chart on its own canvas -->
<canvas id="bar_chart" width="600" height="250">[No canvas support]</canvas>
<br><br><br><br><br>
<canvas id="pie_chart" width="500" height="340" !style="border:1px solid #ccc">[No canvas support]</canvas>
<br>

    <script>
	// If you accidentaly use two "window.onload = function() {..." the second one will overwrite the first ;-)
        window.onload = function ()
        {
	 
            var bar = new RGraph.Bar('bar_chart', [<?=$count_data_string ?>])
                .Set('labels', ['<?=$count_labels_string ?>'])
                .Set('tooltips', ['<?=$count_tooltip_string ?>'])
                .Set('tooltips.event', 'onmousemove')
                .Set('ymax', <?=$max ?>)
                .Set('strokestyle', 'white')
                .Set('linewidth', 2)
                .Set('shadow', true)
                .Set('shadow.offsetx', 0)
                .Set('shadow.offsety', 0)
                .Set('shadow.blur', 10)
                .Set('hmargin.grouped', 2)
                .Set('units.pre', '')
                .Set('title', 'Number of archived items (by type)')
                .Set('gutter.bottom', 20)
                .Set('gutter.left', 40)
                .Set('gutter.right', 15)
                .Set('colors', ['Gradient(#fe783e:#EC561B:#F59F7D)'])
                .Set('background.grid.autofit.numhlines', 5)
                .Set('background.grid.autofit.numvlines', 4)
            
            // This draws the chart
            RGraph.Effects.Fade.In(bar, {'duration': 250});        
 
            var pie = new RGraph.Pie('pie_chart', [<?=$size_data_string?>])
                .Set('origin', 0)
		.Set('strokestyle', 'white')
                .Set('colors', ['#DDDF0D','#7798BF','#EE591E','#54B736','#FF4A4A'])
                .Set('linewidth', 3)
                .Set('exploded', [5,5,5,5,5])
                .Set('shadow', true)
                .Set('shadow.offsetx', 0)
                .Set('shadow.offsety', 0)
                .Set('shadow.blur', 20)
		.Set('gutter.top', 80)
		.Set('gutter.bottom', 40)
		.Set('title', 'Size of archived items (by type)')
                .Set('labels', ['<?=$size_labels_string?>'])
                .Set('labels.sticks', [true])
                .Set('labels.sticks.length', 20)
		.Set('tooltips', [<?=$size_tooltip_string ?>])
                .Set('tooltips.event', 'onmousemove')
            
            RGraph.Effects.Pie.RoundRobin(pie)
        }
    </script>