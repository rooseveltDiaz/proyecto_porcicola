
<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content" id="reportGenerales">
               
   
<link rel="stylesheet" type="text/css" href="jquery.jqplot.css" />
<script language="javascript" type="text/javascript" src="jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="jquery.jqplot.min.js"></script>
<script language="javascript" type="text/javascript" src="jqplot.logAxisRenderer.js"></script>
<script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.jqplot.css" />

<div id="chart1" style="width:600px;height:400px;"></div>

<div id="customTooltipDiv"></div>
  

<!--
<pre><?php print_r($objReporte)?></pre>
<!--<pre><?php echo  json_encode($grafica)?></pre
<!--<pre><?php echo  print_r($grafica)?></pre>
<!--<pre><?php print_r($objReporte)?></pre>
<pre><?php print_r($grafica)?></pre>
<pre><?php echo json_encode($objReporte)?></pre>
<pre><?php echo json_encode($grafica)?></pre>-->


<script class="code" type="text/javascript">
$(document).ready(function(){
  var texto = ["Venta por Dias"];
  var line1= <?php echo json_encode($grafica) ?>;
  var plot1 = $.jqplot('chart1', [line1], {
    title:'Ventas',
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            min:'<?php echo json_encode($fecha_inicio)?>',
            max:'<?php echo json_encode($fecha_fin)?>',
            tickInterval: "8 days",
            yaxis:{
               renderer: $.jqplot.LogAxisRenderer,
               series: [{color:'#5FAB78'}]
                
            }
            

                  },

    },
    series:[{lineWidth:4, markerOptions:{style:'circle'}}],
    legend:{show:true,labels: texto,}

//rendererOptions:{numberRows: 1, placement: "outside"}}
  });
});
</script>
<div id="chart1" style="width:600px;height:300px ;"></div>

    </div>
</main>