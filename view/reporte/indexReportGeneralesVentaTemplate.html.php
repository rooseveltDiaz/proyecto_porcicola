
<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content" id="reportesGenerales">
               
           
               
       <div id="chart1b" style="width:400px;height:260px;"></div>

<div><span></span><span id="info1c"></span></div>

<div id="chart1c" style="width:400px;height:260px;"></div>

<div id="chart2" style="width:800px;height:460px;"></div>

<div id="customTooltipDiv">I'm a tooltip.</div>
  


<!--<script class="code" language="javascript" type="text/javascript">
$(document).ready(function(){

    var l2 = [11, 9, 5, 12, 14];
    var l3 = [4, 8, 5, 3, 6];
    var l4 = [12, 6, 13, 11, 2];    

    
    var plot1b = $.jqplot('chart1b',[l2, l3, l4],{
       stackSeries: true,
       showMarker: false,
       seriesDefaults: {
           fill: true
       },
       axes: {
           xaxis: {
               renderer: $.jqplot.CategoryAxisRenderer,
               ticks: ["Mon", "Tue", "Wed", "Thr", "Fri"]
           }
       }
    });
    
    $('#chart1b').bind('jqplotDataHighlight', 
        function (ev, seriesIndex, pointIndex, data) {
            $('#info1b').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
        }
    );
    
    $('#chart1b').bind('jqplotDataUnhighlight', 
        function (ev) {
            $('#info1b').html('Nothing');
        }
    );
});
</script>-->
 
 
<!--<script class="code" language="javascript" type="text/javascript">
$(document).ready(function(){   
    var l5 = [4, -3, 3, 6, 2, -2];
    var plot1c = $.jqplot('chart1c',[l5],{
       stackSeries: true,
       showMarker: false,
       seriesDefaults: {
           fill: true,
           fillToZero: true,
           rendererOptions: {
               highlightMouseDown: true
           }
       }
    });

    $('#chart1c').bind('jqplotDataClick', 
        function (ev, seriesIndex, pointIndex, data) {
            $('#info1c').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
        }
    );
});
</script>-->
<h1>HOLA</h1>
<pre><?php print_r($objReporte)?></pre>
<pre><?php print_r($grafica)?></pre>
<pre><?php echo json_encode($objReporte)?></pre>
<pre><?php echo json_encode($grafica)?></pre>
<pre><?php echo json_encode($ticks)?></pre>
<script class="code" language="javascript" type="text/javascript">
$(document).ready(function(){
    var l6 = [11, 20, 5, 12, 14, 8, 30, 9, 6];
    var l8 = [2,3,5,4,8,2];
    var l7 = [11, 20, 5, 12, 14, 8, 30, 9, 6];
//    var l8 = [12, 6, 13, 11, 2, 3, 4, 2, 1, 5, 7, 4, 8];
    var intento = <?php echo json_encode($value)?>;
    var ticks = [[1,'Jan 01'], [2,'Feb 01'], [3,'Mar 15'], [4,'Apr 01'], [5,'May 15'], [6,'Jun 11'], [7,'Jul 11'], [8,'Aug 11'], [9,'Sep 17']];  

    
    plot2 = $.jqplot('chart2',[l8],{
       stackSeries: true,
       showMarker: false,
       highlighter: {
        show: true,
        showTooltip: false
       },
       seriesDefaults: {
           fill: true,
       },
       series: [
        {label: 'Hembras'},
        {label: 'Machos'},
//        {label: 'Crackers'}
       ],
       legend: {
        show: true,
        placement: 'outsideGrid'
       },
       grid: {
        drawBorder: false,
        shadow: false
       },
       axes: {
           xaxis: {
              ticks: ticks,
              tickRenderer: $.jqplot.CanvasAxisTickRenderer,
              tickOptions: {
                angle: -40 
              },
              drawMajorGridlines: false
          }           
        }
    });
    
    // capture the highlighters highlight event and show a custom tooltip.
    $('#chart2').bind('jqplotHighlighterHighlight', 
        function (ev, seriesIndex, pointIndex, data, plot) {
            // create some content for the tooltip.  Here we want the label of the tick,
            // which is not supplied to the highlighters standard tooltip.
            var content = plot.series[seriesIndex].label + ', ' + plot.series[seriesIndex]._xaxis.ticks[pointIndex][1] + ', ' + data[1];
            // get a handle on our custom tooltip element, which was previously created
            // and styled.  Be sure it is initiallly hidden!
            var elem = $('#customTooltipDiv');
            elem.html(content);
            // Figure out where to position the tooltip.
            var h = elem.outerHeight();
            var w = elem.outerWidth();
            var left = ev.pageX - w - 10;
            var top = ev.pageY - h - 10;
            // now stop any currently running animation, position the tooltip, and fade in.
            elem.stop(true, true).css({left:left, top:top}).fadeIn(200);
        }
    );
    
    // Hide the tooltip when unhighliting.
    $('#chart2').bind('jqplotHighlighterUnhighlight', 
        function (ev) {
            $('#customTooltipDiv').fadeOut(300);
        }
    );
});
</script>


<!--
<script class="code" language="javascript" type="text/javascript">
$(document).ready(function(){
    var l6 = [11, 9, 5, 12, 14, 8, 7, 9, 6, 11, 9, 3, 4];
    var l7 = [4, 8, 5, 3, 6, 5, 3, 2, 6, 7, 4, 3, 2];
    var l8 = [12, 6, 13, 11, 2, 3, 4, 2, 1, 5, 7, 4, 8];

    var ticks = [[1,'Dec 10'], [2,'Jan 11'], [3,'Feb 11'], [4,'Mar 11'], [5,'Apr 11'], [6,'May 11'], [7,'Jun 11'], [8,'Jul 11'], [9,'Aug 11'], [10,'Sep 11'], [11,'Oct 11'], [12,'Nov 11'], [13,'Dec 11']];  

    
    plot2 = $.jqplot('chart2',[l6, l7, l8],{
       stackSeries: true,
       showMarker: false,
       highlighter: {
        show: true,
        showTooltip: false
       },
       seriesDefaults: {
           fill: true,
       },
       series: [
        {label: 'Beans'},
        {label: 'Oranges'},
        {label: 'Crackers'}
       ],
       legend: {
        show: true,
        placement: 'outsideGrid'
       },
       grid: {
        drawBorder: false,
        shadow: false
       },
       axes: {
           xaxis: {
              ticks: ticks,
              tickRenderer: $.jqplot.CanvasAxisTickRenderer,
              tickOptions: {
                angle: -90 
              },
              drawMajorGridlines: false
          }           
        }
    });
    
    // capture the highlighters highlight event and show a custom tooltip.
    $('#chart2').bind('jqplotHighlighterHighlight', 
        function (ev, seriesIndex, pointIndex, data, plot) {
            // create some content for the tooltip.  Here we want the label of the tick,
            // which is not supplied to the highlighters standard tooltip.
            var content = plot.series[seriesIndex].label + ', ' + plot.series[seriesIndex]._xaxis.ticks[pointIndex][1] + ', ' + data[1];
            // get a handle on our custom tooltip element, which was previously created
            // and styled.  Be sure it is initiallly hidden!
            var elem = $('#customTooltipDiv');
            elem.html(content);
            // Figure out where to position the tooltip.
            var h = elem.outerHeight();
            var w = elem.outerWidth();
            var left = ev.pageX - w - 10;
            var top = ev.pageY - h - 10;
            // now stop any currently running animation, position the tooltip, and fade in.
            elem.stop(true, true).css({left:left, top:top}).fadeIn(200);
        }
    );
    
    // Hide the tooltip when unhighliting.
    $('#chart2').bind('jqplotHighlighterUnhighlight', 
        function (ev) {
            $('#customTooltipDiv').fadeOut(300);
        }
    );
});
</script>-->
<!--// 
//  $(document).ready(function() {
//  $.jqplot('chartdiv',  [[[1, 2],[3,5.12],[5,13.1],[7,33.6],[9,85.9],[11,219.9]]],
//{ title:'Exponential Line',
//  axes:{yaxis:{min:1, max:12}},
//  series:[{color:'#5FAB78'}]
//});
//  });-->


    </div>
</main>