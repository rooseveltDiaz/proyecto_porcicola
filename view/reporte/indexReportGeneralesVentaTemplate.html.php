<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content" id="reportesGenerales">
               <div id="chart1"></div>
               <?php print_r($fechaAuto[1]) ?>
<!--        <script>
            
            $(document).ready(function () {
    $.jqplot._noToImageButton = true;
var    cosPoints = <?php echo json_encode($objReportGenerales) ?>;
    console.log("prueba ", cosPoints[0].animal)
    for(var animal in cosPoints){
       console.log("" + animal  );
    }
    
    var prevYear = [["2011-08-01",398], ["2011-08-02",255.25], ["2011-08-03",263.9], ["2011-08-04",154.24], 
    ["2011-08-05",210.18], ["2011-08-06",109.73], ["2011-08-07",166.91], ["2011-08-08",330.27], ["2011-08-09",546.6], 
    ["2011-08-10",260.5], ["2011-08-11",330.34], ["2011-08-12",464.32], ["2011-08-13",432.13], ["2011-08-14",197.78], 
    ["2011-08-15",311.93], ["2011-08-16",650.02], ["2011-08-17",486.13], ["2011-08-18",330.99], ["2011-08-19",504.33], 
    ["2011-08-20",773.12], ["2011-08-21",296.5], ["2011-08-22",280.13], ["2011-08-23",428.9], ["2011-08-24",469.75], 
    ["2011-08-25",628.07], ["2011-08-26",516.5], ["2011-08-27",405.81], ["2011-08-28",367.5], ["2011-08-29",492.68], 
    ["2011-08-30",700.79], ["2011-08-31",588.5], ["2011-09-01",511.83], ["2011-09-02",721.15], ["2011-09-03",649.62], 
    ["2011-09-04",653.14], ["2011-09-06",900.31], ["2011-09-07",803.59], ["2011-09-08",851.19], ["2011-09-09",2059.24], 
    ["2011-09-10",994.05], ["2011-09-11",742.95], ["2011-09-12",1340.98], ["2011-09-13",839.78], ["2011-09-14",1769.21], 
    ["2011-09-15",1559.01], ["2011-09-16",2099.49], ["2011-09-17",1510.22], ["2011-09-18",1691.72], 
    ["2011-09-19",1074.45], ["2011-09-20",1529.41], ["2011-09-21",1876.44], ["2011-09-22",1986.02], 
    ["2011-09-23",1461.91], ["2011-09-24",1460.3], ["2011-09-25",1392.96], ["2011-09-26",2164.85], 
    ["2011-09-27",1746.86], ["2011-09-28",2220.28], ["2011-09-29",2617.91], ["2011-09-30",3236.63]];
 
 
    var plot1 = $.jqplot("chart1", [prevYear], {
        seriesColors: ["rgba(78, 135, 194, 0.7)", "rgb(211, 235, 59)"],
        title: 'Monthly TurnKey Revenue',
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 2
        },
        legend: {
            show: true,
            placement: 'outside'
        },
        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },
        series: [
            {
                fill: true,
                label: '2010'
            },
            {
                label: '2011'
            }
        ],
        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: false
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "%b %e",
                    angle: -30,
                    textColor: '#dddddd'
                },
                min: "2011-08-01",
                max: "2011-09-30",
                tickInterval: "7 days",
                drawMajorGridlines: false
            },
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 0,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                    formatString: "$%'d",
                    showMark: false
                }
            }
        }
    });
 
      $('.jqplot-highlighter-tooltip').addClass('ui-corner-all')
});
            
//            $(document).ready(function(){
//               
//  // Some simple loops to build up data arrays.
//  var cosPoints = <?php// echo json_encode($objReportGenerales) ?>;
//  for (var i=0; i<2*Math.PI; i+=1){ 
//    cosPoints.push([i, Math.cos(i)]); 
//  }
//     
//  var powPoints2 = [1, 2 , 4, 5, 2, 4, 8, 8, 8 ,9 ]; 
////  for (var i=0; i<2*Math.PI; i+=1) { 
////      powPoints2.push([i, -2.5 - Math.pow(i/4, 2)]); 
////  } 
// 
//  var plot3 = $.jqplot('chart3', [powPoints2], 
//    { 
//      title:'Line Style Options', 
//      // Set default options on all series, turn on smoothing.
//      seriesDefaults: {
//          rendererOptions: {
//              smooth: true
//          }
//      },
//      // Series options are specified as an array of objects, one object
//      // for each series.
//      series:[ 
//          {
//            // Change our line width and use a diamond shaped marker.
//            lineWidth:2, 
//            markerOptions: { style:'dimaond' }
//          }, 
//          {
//            // Don't show a line, just show markers.
//            // Make the markers 7 pixels with an 'x' style
//            showLine:false, 
//            markerOptions: { size: 7, style:"x" }
//          },
//          { 
//            // Use (open) circlular markers.
//            markerOptions: { style:"circle" }
//          }, 
//          {
//            // Use a thicker, 5 pixel line and 10 pixel
//            // filled square markers.
//            lineWidth:5, 
//            markerOptions: { style:"filledSquare", size:10 }
//          }
//      ]
//    }
//  );
//    
//});
            
            
//            $(document).ready(function(){
//  var plot1 = $.jqplot ('chart1', [[3,7,9,1,5,3,8,2,5,15]]);
//});
//         
//$(document).ready(function(){
//  var plot2 = $.jqplot ('chart2', [[3,7,9,1,5,3,8,2,5]], {
//      // Give the plot a title.
//      title: 'Plot With Options',
//      // You can specify options for all axes on the plot at once with
//      // the axesDefaults object.  Here, we're using a canvas renderer
//      // to draw the axis label which allows rotated text.
//      axesDefaults: {
//        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
//      },
//      // Likewise, seriesDefaults specifies default options for all
//      // series in a plot.  Options specified in seriesDefaults or
//      // axesDefaults can be overridden by individual series or
//      // axes options.
//      // Here we turn on smoothing for the line.
//      seriesDefaults: {
//          rendererOptions: {
//              smooth: true
//          }
//      },
//      // An axes object holds options for all axes.
//      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
//      // Up to 9 y axes are supported.
//      axes: {
//        // options for each axis are specified in seperate option objects.
//        xaxis: {
//          label: "X Axis",
//          // Turn off "padding".  This will allow data point to lie on the
//          // edges of the grid.  Default padding is 1.2 and will keep all
//          // points inside the bounds of the grid.
//          pad: 0
//        },
//        yaxis: {
//          label: "Y Axis"
//        }
//      }
//    });
//});

         
         
        </script>-->

    </div>
</main>