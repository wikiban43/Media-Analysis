<!DOCTYPE html>
<?php
$event=0;
?>
<html lang="en">

<head>
    <title>Test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="mediacss.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <style>
        body {
            font-family: 'Montserrat', 'serif';
			font-size: 14px;
			overflow: auto;
			color: #555555;
			letter-spacing: 0.15px;
			line-height: 1.5;
        }

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('../Images/page-loader.gif') 50% 50% no-repeat rgb(249, 249, 249);
        }
    </style>

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../scripts/css/massmedia.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        $(function () {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js" charset="utf-8"></script>
    <script src="../scripts/js/nv.d3.js"></script>
</head>

<body>
    <div class="loader"></div>
    <script type="text/javascript">
        $(window).load(function () {
            $(".loader").fadeOut("slow");
        })
    </script>
    <div id="header"></div>
    <br><br><br><br><br>
           <div id="chartdiv4" style="margin-inline-start: 1%;margin-inline-end: 1%; height: 480px;width:98%"></div>
                <script>
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv4", am4charts.XYChart);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




                    // Set up data source
                    chart.dataSource.url = '<?php echo "data.php?event=$event&np=thehindu&coverage=sentiment";?>';
                    chart.dataSource.parser =new am4core.JSONParser();
                    chart.dataSource.parser.options.emptyAs = 0;


                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.dataFields.category = "0";
                    categoryAxis.renderer.labels.template.rotation = -45;
                    var label = categoryAxis.renderer.labels.template;
                    label.truncate = true;
                    label.maxWidth = 100;
                    categoryAxis.renderer.minGridDistance = 0.1;
                    // label.maxheight = 50;
                    label.tooltipText = "{category}";
                    //   categoryAxis.renderer.minLabelPosition = 0.5;
                    //    categoryAxis.renderer.maxLabelPosition = 0.95;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    //   valueAxis.min = 0;
                    //   valueAxis.max = 0.5;
                    //valueAxis.strictMinMax = fasle;
                    categoryAxis.renderer.minGridDistance = 0.1;

                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.dataFields.categoryX = "0";
                    series.dataFields.valueY = "1";
                    series.name = "Values";
                    series.columns.template.tooltipY = 0;
                    // series.columns.template.tooltipText = "{category}";
                    series.columns.template.tooltipText = "{valueY.value}";
                    series.columns.template.strokeOpacity = 0;

                    chart.scrollbarX = new am4core.Scrollbar();
                    chart.scrollbarY = new am4core.Scrollbar();

                    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                </script>

    <div id="footer"></div>
</body>

</html>