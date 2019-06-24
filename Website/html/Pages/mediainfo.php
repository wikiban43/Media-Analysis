<!DOCTYPE html>
<?php
$event = $_GET['event'];
$np = $_GET['np'];
$eventn = $_GET['eventn'];
$npn = $_GET['npn'];
?>
<html lang="en">

<head>
    <title>Media Bias Info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
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

    <link rel="stylesheet" type="text/css" href="style.min.css">
    <link rel="stylesheet" type="text/css" href="../scripts/css/massmedia.min.css">
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
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 text-center list"><a href="#AspectCoverage" style="text-decoration:none;">Aspect
                    Coverage</a></div>
            <div class="col-sm-4 text-center list"><a href="#SentimentCoverage" style="text-decoration:none;">Sentiment
                    Coverage</a></div>
            <div class="col-sm-4 text-center list"><a href="#KL" style="text-decoration:none;">Divergence from Mean</a>
            </div>
        </div>
    </div>
    <div data-spy="scroll" data-target="#list" data-offset="50" class="CC"><br>
        <h1 style="text-align:center;color: #05386b !important;">
            Media Bias</h1>
        <div class="container-fluid">
            <div class="row">
<div class="col-sm-12">
<p
                        style="margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                        To analyse media bias, we study the coverage and sentiment with which mass media houses cover different aspects (or topics of discussion) around policies. Parallelly, we also see how much does the social media (Twitter) follower community of these mass media houses conform with the content presented by them. We analyse this conformance w.r.t. the coverage provided to different aspects, and the sentiment with which these aspects are covered. 

 </p>
</div>
            </div>
         </div>
         <h1 style="text-align:center;color: #05386b !important;">
            <?php echo $_GET['eventn']; ?>
            <span style="color: #05386b !important;font-size:50%;">
                <?php echo $_GET['npn']; ?>
            </span>
        </h1>
         <hr>
        
        <div class="container-fluid" id="AspectCoverage">
            <div class="row">

                <div class="col-sm-2 text-left">
                    <div class="linkDeco">

                        <ul class="list-group links-list">
                            <li class="list-group-item"
                                style="background:white;color: #05386b !important;font-size: 130%;border: 1px solid white; ">
                                <span style="font-family: 'Open Sans', 'serif';">Newspapers </button>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=timesofindia&npn=Times Of India">Times of India</a>'; ?>
                            </li>
                            <li class="list-group-item">
                                <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=hindustantimes&npn=Hindustan Times">Hindustan Times</a>'; ?>
                            </li>
                            <li class="list-group-item">
                                <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=thehindu&npn=Hindu">Hindu</a>'; ?>
                            </li>
                            <li class="list-group-item">
                                <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=indianexpress&npn=Indian Express">Indian Express</a>'; ?>
                            </li>
                            <li class="list-group-item">
                                <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=telegraph&npn=Telegraph">Telegraph</a>'; ?>
                            </li>
                            <li class="list-group-item">
                                <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=deccanherald&npn=Deccan Herald">Deccan Herald</a>'; ?>
                            </li>
                            <li class="list-group-item">
                                <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=newindianexpress&npn=New Indian Express">New Indian Express</a>'; ?>
                            </li>

                        </ul>
                    </div>

                </div>
                <div class="col-sm-5 text-left" style="text-align:right;">
                    <h4 style="text-align:center;">Mass Media</h4>
                    <div id="chartdiv4" style=" height: 480px;"></div>
                    <button id="myBtn" class="btn btn-success myBtn">Read more</button>
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p
                                    style="text-align:left ;margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                                    <?php include('../text data/Mass Media/' . $event . '/AC/MM/text.txt');?> </p>
                            </div>
                        </div>

                    </div>

                    <script>
                        // Get the modal
                        var modal = document.getElementById("myModal");

                        // Get the button that opens the modal
                        var btn = document.getElementById("myBtn");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];

                        // When the user clicks the button, open the modal 
                        btn.onclick = function () {
                            modal.style.display = "block";
                        }

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal.style.display = "none";
                        }

                        
                    </script>
                    <script>
                        // Themes begin
                        am4core.useTheme(am4themes_animated);
                        // Themes end

                        var chart = am4core.create("chartdiv4", am4charts.XYChart);
                        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




                        // Set up data source
                        chart.dataSource.url = '<?php echo "../api/data.php?event=$event&np=$np&coverage=aspect";?>';
                        chart.dataSource.parser = new am4core.JSONParser();
                        chart.dataSource.parser.options.emptyAs = 0;


                        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                        categoryAxis.renderer.grid.template.location = 0;
                        categoryAxis.dataFields.category = "0";
                        categoryAxis.renderer.labels.template.rotation = -90;
                        var label = categoryAxis.renderer.labels.template;
                        label.truncate = true;
                        label.maxWidth = 150;
                        label.offset = 0;
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
                        series.columns.template.tooltipText = "{0}:{valueY.value}";
                        series.columns.template.strokeOpacity = 0;

                        chart.scrollbarX = new am4core.Scrollbar();
                        chart.scrollbarY = new am4core.Scrollbar();

                        // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                    </script>


                </div>
                <div class="col-sm-5 text-left" style="text-align:right;">
                    <h4 style="text-align:center;">Social Media</h4>
                    <div id="chartdiv" style=" height: 480px;"></div>
                    <button id="myBtn2" class="btn btn-success myBtn">Read more</button>
                </div>
                <div id="myModal2" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p
                                    style="text-align:left ;margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                                    <?php include('../text data/Mass Media/' . $event . '/AC/SM/text.txt');?> </p>
                            </div>
                        </div>

                    </div>

                    <script>
                        // Get the modal
                        var modal2 = document.getElementById("myModal2");

                        // Get the button that opens the modal
                        var btn2 = document.getElementById("myBtn2");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[1];

                        // When the user clicks the button, open the modal 
                        btn2.onclick = function () {
                            modal2.style.display = "block";
                        }

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal2.style.display = "none";
                        }

                        
                    </script>

                <script>
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv", am4charts.XYChart);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




                    // Set up data source
                    chart.dataSource.url =
                        "../csv data/Mass Media/<?php echo $_GET['event']; ?>/<?php echo $_GET['np']; ?>/AspectCoverage/Social/GraphData.csv";
                    chart.dataSource.parser = new am4core.CSVParser();
                    chart.dataSource.parser.options.useColumnNames = true;


                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.dataFields.category = "tag";
                    categoryAxis.renderer.labels.template.rotation = -90;
                    var label = categoryAxis.renderer.labels.template;
                    label.truncate = true;
                    label.maxWidth = 150;
                    categoryAxis.renderer.minGridDistance = 0.1;
                    // label.maxheight = 50;
                    label.tooltipText = "{category}";
                    //   categoryAxis.renderer.minLabelPosition = 0.5;
                    //    categoryAxis.renderer.maxLabelPosition = 0.95;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    //   valueAxis.min = 0;
                    //   valueAxis.max = 0.5;
                    //
                    categoryAxis.renderer.minGridDistance = 0.1;

                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.dataFields.categoryX = "tag";
                    series.dataFields.valueY = "value";
                    series.name = "Values";
                    series.columns.template.tooltipY = 0;
                    // series.columns.template.tooltipText = "{category}";
                    series.columns.template.tooltipText = "{tag}:{valueY.value}";
                    series.columns.template.strokeOpacity = 0;

                    chart.scrollbarX = new am4core.Scrollbar();
                    chart.scrollbarY = new am4core.Scrollbar();

                    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                </script>

            </div>
            <div class="row">
                <div class="col-sm-12 text-left">
                    <h4 style="text-align:center;">What is Aspect Coverage?</h4>
                    <p
                        style="margin-inline-end: 1%;margin-inline-start: 1%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                        Aspects are topics of discussion for a policy. For example, Long queues at ATM counters leading
                        to
                        problems among people is an aspect or topic of discussion for the policy Demonetization. Aspect
                        coverage for mass media is defined as the relative number of words written about an aspect by a
                        newspaper (in other words, it measures the space provided to an aspect by a newspaper). Aspect
                        coverage for social media is the relative number of tweets provided to an aspect by the
                        followers of
                        a newspaper (in other words, it measures the attention given to an aspect by the readers of the
                        newspaper). The graph on the left shows the aspect coverage distribution for the newspaper, and
                        the
                        graph on the right shows the aspect coverage distribution for social media.

                        Please click on the bars showing aspect coverage, to get an example of an article belonging to
                        that
                        aspect.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid" id="SentimentCoverage">
        <div class="row">

            <div class="col-sm-2 text-left sec-list">
                <div class="linkDeco">

                    <ul class="list-group links-list">
                        <li class="list-group-item"
                            style="background:white;color: #05386b !important;font-size: 130%;border: 1px solid white; ">
                            <span style="font-family: 'Open Sans', 'serif';">Newspapers </button>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=timesofindia&npn=Times Of India">Times of India</a>'; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=hindustantimes&npn=Hindustan Times">Hindustan Times</a>'; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=thehindu&npn=Hindu">Hindu</a>'; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=indianexpress&npn=Indian Express">Indian Express</a>'; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=telegraph&npn=Telegraph">Telegraph</a>'; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=deccanherald&npn=Deccan Herald">Deccan Herald</a>'; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo '<a href="../Pages/mediainfo.php?event=' . $event . '&eventn=' . $eventn . '&np=newindianexpress&npn=New Indian Express">New Indian Express</a>'; ?>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="col-sm-5 text-left" style="text-align:right">
                <h4 style="text-align:center;">Mass Media</h4>
                <div id="chartdiv5" style=" height: 480px;"></div>
                <button id="myBtn3" class="btn btn-success myBtn">Read more</button>
                <div id="myModal3" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p
                                    style="text-align:left ;margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                                    <?php include('../text data/Mass Media/' . $event . '/SC/MM/text.txt');?> </p>
                            </div>
                        </div>

                    </div>

                    <script>
                        // Get the modal
                        var modal3 = document.getElementById("myModal3");

                        // Get the button that opens the modal
                        var btn3 = document.getElementById("myBtn3");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[2];

                        // When the user clicks the button, open the modal 
                        btn3.onclick = function () {
                            modal3.style.display = "block";
                        }

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal3.style.display = "none";
                        }

                        
                    </script>

                <script>
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv5", am4charts.XYChart);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




                    // Set up data source
                    chart.dataSource.url = '<?php echo "../api/data.php?event=$event&np=$np&coverage=sentiment";?>';
                    chart.dataSource.parser = new am4core.JSONParser();
                    chart.dataSource.parser.options.emptyAs = 0;


                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.dataFields.category = "0";
                    categoryAxis.renderer.labels.template.rotation = -90;
                    var label = categoryAxis.renderer.labels.template;
                    label.truncate = true;
                    label.maxWidth = 150;
                    label.offset = 0;
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
                    series.columns.template.tooltipText = "{0}:{valueY.value}";
                    series.columns.template.strokeOpacity = 0;

                    chart.scrollbarX = new am4core.Scrollbar();
                    chart.scrollbarY = new am4core.Scrollbar();

                    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                </script>


            </div>
            <div class="col-sm-5 text-left" style="text-align:right;">
                <h4 style="text-align:center;">Social Media</h4>
                <div id="chartdiv1" style=" height: 480px;"></div>
                <button id="myBtn4" class="btn btn-success myBtn">Read more</button>
                <div id="myModal4" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p
                                    style="text-align:left ;margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                                    <?php include('../text data/Mass Media/' . $event . '/SC/SM/text.txt');?> </p>
                            </div>
                        </div>

                    </div>

                    <script>
                        // Get the modal
                        var modal4 = document.getElementById("myModal4");

                        // Get the button that opens the modal
                        var btn4 = document.getElementById("myBtn4");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[3];

                        // When the user clicks the button, open the modal 
                        btn4.onclick = function () {
                            modal4.style.display = "block";
                        }

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal4.style.display = "none";
                        }

                        
                    </script>

                <script>
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv1", am4charts.XYChart);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




                    // Set up data source
                    chart.dataSource.url =
                        "../csv data/Mass Media/<?php echo $_GET['event']; ?>/<?php echo $_GET['np']; ?>/AspectSentiment/Social/GraphData.csv";
                    chart.dataSource.parser = new am4core.CSVParser();
                    chart.dataSource.parser.options.useColumnNames = true;


                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.dataFields.category = "tag";
                    categoryAxis.renderer.labels.template.rotation = -90;
                    var label = categoryAxis.renderer.labels.template;
                    label.truncate = true;
                    label.maxWidth = 150;
                    categoryAxis.renderer.minGridDistance = 0.1;
                    // label.maxheight = 50;
                    label.tooltipText = "{category}";
                    //   categoryAxis.renderer.minLabelPosition = 0.5;
                    //    categoryAxis.renderer.maxLabelPosition = 0.95;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    //   valueAxis.min = 0;
                    //   valueAxis.max = 0.5;
                    //
                    categoryAxis.renderer.minGridDistance = 0.1;

                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.dataFields.categoryX = "tag";
                    series.dataFields.valueY = "value";
                    series.name = "Values";
                    series.columns.template.tooltipY = 0;
                    // series.columns.template.tooltipText = "{category}";
                    series.columns.template.tooltipText = "{tag}:{valueY.value}";
                    series.columns.template.strokeOpacity = 0;
                    series.columns.template.fill = am4core.color("#5a5");
                    series.columns.template.adapter.add("fill", function (fill, target) {
                        if (target.dataItem && (target.dataItem.valueY < 0)) {
                            return am4core.color("#ED7B84");
                        } else {
                            return fill;
                        }
                    });

                    chart.scrollbarX = new am4core.Scrollbar();
                    chart.scrollbarY = new am4core.Scrollbar();

                    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                </script>

            </div>
            <div class="row">
                <div class="col-sm-12 text-left">
                    <h4 style="text-align:center;">What is Sentiment Coverage?</h4>
                    <p
                        style="margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                        This graph shows
                        how the aspects are being spoken about in mass media, in terms of the overall aggregate
                        sentiment of
                        all statements made on that aspect. The sentiment slant for any statement can be positive,
                        negative,
                        or neutral. For an aspect, we add up all the sentiment values of the statements belonging to the
                        aspect. These statements are commonly made by elites, which include ruling and opposition
                        politicians, influential businesspersons, social activists, academics, bureaucrats, and
                        judiciary
                        members.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid" id="KL">
        <div class="row">


            <div class="col-sm-7 text-left">
                <div id="chartdiv3" style="height: 480px;"></div>
                <script>
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv3", am4charts.XYChart);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




                    // Set up data source
                    chart.dataSource.url = '<?php echo "../api/kld_data.php?event=$event";?>';
                    chart.dataSource.parser = new am4core.JSONParser();
                    chart.dataSource.parser.options.emptyAs = 0;


                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.dataFields.category = "0";
                    categoryAxis.renderer.labels.template.rotation = -45;
                    var label = categoryAxis.renderer.labels.template;
                    label.truncate = true;
                    label.maxWidth = 150;
                    categoryAxis.renderer.minGridDistance = 0.1;
                    // label.maxheight = 50;
                    label.tooltipText = "{category}";
                    //   categoryAxis.renderer.minLabelPosition = 0.5;
                    //    categoryAxis.renderer.maxLabelPosition = 0.95;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    //   valueAxis.min = 0;
                    //   valueAxis.max = 0.5;
                    //

                    var series = chart.series.push(new am4charts.LineSeries());
                    series.dataFields.categoryX = "0";
                    series.dataFields.valueY = "1";
                    series.dataFields.value = "0";
                    series.strokeOpacity = 0;
                    series.cursorTooltipEnabled = false;
                    // series.columns.template.tooltipText = "{category}";
                    var bullet = series.bullets.push(new am4charts.CircleBullet());
                    bullet.tooltipText = "{0} : {1}";
                    series.heatRules.push({
                        target: bullet.circle,
                        min: 1,
                        max: 15,
                        property: "radius"
                    });;

                    chart.scrollbarX = new am4core.Scrollbar();
                    chart.scrollbarY = new am4core.Scrollbar();

                    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                </script>


            </div>
            <div class="col-sm-5 text-left">
                <h3 style="text-align:center">Divergence from Mean</h3>
                <p style="margin-inline-end: 1%;margin-inline-start: 1%;padding: 2.5px 2.5px 2.5px 2.5px;">
                    This plot shows how much each newspaper deviates from the mean trend of aspect coverage across all
                    newspapers (the deviation is measured by a mathematical quantity called the KL divergence). In other
                    words, it shows how non-conformist a newspaper is, in terms of its aspect coverage. For example, we
                    see that across all events, IE shows the maximum deviation from the mean trend. Thus, IE stands out
                    to be the newspaper that generally does not follow the trend that the mass media in general follows
                    in terms of aspect coverage. </p>

            </div>

        </div>
    </div>




    </div>

    <div id="footer"></div>


</body>

</html>
