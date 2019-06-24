<!DOCTYPE html>
<?php
$event = $_GET['event'];
$eventn = $_GET['eventn'];
if (!empty($event)) {
} else {
    header("Location:../Entities/POLITICALECONOMY.htm");
}?>
<html lang="en">

<head>
    <title>Political Economy Info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="politicalcss.min.css">

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
            <div class="col-sm-6 text-center list"><a href="#AspectCoverage" style="text-decoration:none;">Entity
                    Coverage</a></div>
            <div class="col-sm-6 text-center list"><a href="#SentimentCoverage" style="text-decoration:none;">Entity
                    Sentiment</a></div>
        </div>
    </div>
    <div data-spy="scroll" data-target="#list" data-offset="50" class="CC"><br>
        <h1 style="text-align:center;color: #05386b !important;">
            Political Economy
        </h1>
        <div class="container-fluid">
            <div class="row">
<div class="col-sm-12">
<p
                        style="margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                        In this page, we show the coverage and sentiment slant of various highly covered entities in mass media. By ‘entities’, we refer to people like politicians, business persons (directors or managers of companies), judiciary members, IAS officers, social activists, etc. that are covered by mass media with respect to a policy. Two of the important aspects of understanding the political economy around policies are: (a) which entities are the most vocal on policy issues in mass media, and (b) how do these entities speak on the policies. We try to answer these two research questions in this page. </p>
</div>
            </div>
         </div>
         <h1 style="text-align:center;color: #05386b !important;">
            <?php echo $_GET['eventn']; ?>

        </h1>
        <hr>

        <div class="container-fluid" id="AspectCoverage">
            <div class="row">

                <div class="col-sm-12 text-left" style="text-align:right;">
                <h2 style="text-align: center;">Entity Coverage</h2>


<div id="chartdiv" style="height: 480px;"></div>
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
                                    <?php include('../text data/Political/' . $event . '/text1.txt');?> </p>
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

    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




    // Set up data source
    chart.dataSource.url =
        "../csv data/Political Economy/<?php echo $_GET['event']; ?>/EntityCoverage/GraphData.csv";
    chart.dataSource.parser = new am4core.CSVParser();
    chart.dataSource.parser.options.useColumnNames = true;


    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.dataFields.category = "tag";
    categoryAxis.renderer.labels.template.rotation = -90;
    var label = categoryAxis.renderer.labels.template;
    label.truncate = true;
    label.maxWidth = 200;
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
                    <h4 style="text-align:center;">What is Entity Coverage?</h4>
                    <p
                        style="margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                The above figure shows the coverage provided to the top 20 highest covered entities in mass media.<br><br>
		
		We measure coverage using relative coverage, which basically is the proportion of times an entity is mentioned in mass media, 
		given the mentions of all entities.From the above figure, we can see that most of the top 20 highest covered entities are politicians. 
		This is followed by business persons, bureaucrats (IAS officers), and judiciary members.  
		Academicians and social development experts from the civil society 
		(including social activists and researchers documenting successes and failures of these policies) are provided negligible coverage by mass media.<br><br>
		
		For Aadhaar: Aadhaar sees the coverage of non-politicians like D.Y. Chandrachud, K.K. Venugopal, A.K. Sikri, and Rakesh Dwivedi, who are all judiciary members of the Supreme Court of India, which can be explained by the fact that a lot of debates took place in the judiciary around the Aadhaar policy, although it revolved around the constitutional legitimacy of the policy. We also find the presence of Ajay Bhushan Pandey, a bureaucrat in Aadhaar and currently the CEO of UIDAI. The only social development expert getting mentioned among the top 20 entities in mass media is Jean Dreze, who has been vocal against the policy on the failure of Aadhaar implementation leading to denial of ration to the poor.
<br><br>


		For Cashless Economy: The policy push towards Cashless Payments shows the presence of business-persons like Mukesh Ambani and Vijay Shekhar Sharma, judiciary members like Bhim Sen Sehgal, and economic advisors like Urjit Patel and Nandan Nilekani because
it is an economic policy issue. It is noteworthy that Vijay Shekhar Sharma is the founder of PayTM, which gained immediate leverage in the wake of Cashless Economy.
<br><br>

		For Digital India: Digital India policy contains Mukesh Ambani and Nandan Nilekani among the top covered entities. This is because Ambani brought out the Jio network, which has disrupted the telecom space by providing very low-cost 4G connectivity.
<br><br>

		For E-Gov: For eGov policy priority, we have business persons like Mukesh Ambani, Anil Ambani, and M.N. Vidyashankar among the top covered entities, who were expectedly supporters of the
move.
<br>	
                    </p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid" id="SentimentCoverage">
        <div class="row">

            <div class="col-sm-12 text-left" style="text-align:right;">
            <h2 style="text-align: center;">Entity Sentiment</h2>



<div id="chartdiv1" style="width: 98%;margin-inline-start: 1%;margin-inline-end: 1%; height: 480px;"></div>
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
                                    <?php include('../text data/Political/' . $event . '/text2.txt');?> </p>
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

    var chart = am4core.create("chartdiv1", am4charts.XYChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in




    // Set up data source
    chart.dataSource.url =
        "../csv data/Political Economy/<?php echo $_GET['event']; ?>/EntitySentiment/GraphData.csv";
    chart.dataSource.parser = new am4core.CSVParser();
    chart.dataSource.parser.options.useColumnNames = true;


    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.dataFields.category = "tag";
    categoryAxis.renderer.labels.template.rotation = -90;
    var label = categoryAxis.renderer.labels.template;
    label.truncate = true;
    label.maxWidth = 200;
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
    series.name = "Sentiment";
    series.columns.template.tooltipY = 0;
    // series.columns.template.tooltipText = "{category}";
    series.columns.template.tooltipText = "{tag}:{valueY.value}";
    series.columns.template.strokeOpacity = 0;
    series.columns.template.fill = am4core.color("#5a5");
         series.columns.template.adapter.add("fill", function(fill, target) {
         if (target.dataItem && (target.dataItem.valueY < 0)) {
           return am4core.color("#ED7B84");
             }
         else {
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
                    <h4 style="text-align:center;">What is Entity Sentiment?</h4>
                    <p
                        style="margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; margin-block-start:2%;">
                        In this figure, we see how the highest covered entities (politicians, business persons, IAS officers, judiciary members, etc.) speak on a particular policy.<br>
			In other words, the sentiment slant of the statements made by them on the policy. The green coloured bars denote an aggregate positive sentiment, 
			and the red coloured bars denote an aggregate negative sentiment.<br><br>

			We can see an expected trend from this plot the ruling party members (politicians) who are instrumental in the formulation 
			and implementation of a policy speak positively on the policy, whereas the opposition members are either less positive 
			(in cases where the policy was ideated when they were in power) or negative on the policy.<br><br>

			Another interesting finding is that although the  business persons get much less coverage in mass media compared to the politicians, 
			they generally speak positively about the policies.<br><br> 
			
                For Aadhaar: Nandan Nilekani spoke most positively about Aadhaar, which is expected as he
was the chairman of UIDAI (the organization that issues Aadhaar numbers to citizens) and the founder of Aadhaar project.  The negative stance of academicians like Jean Dreze can be attributed to issues raised by him of starvation leading to deaths, which originated from a denial of food grains in the PDS system from a malfunctioning Aadhaar linkage of the beneficiary family.
<br><br>


                For Cashless Economy: Cashless Economy was initiated by the current ruling party BJP, and saw the opposition having more negative comments, which is an exception to their otherwise mostly positive coverage. Some judiciary members, opposition party politicians, and bureaucrats do have a slightly negative slant, but since the coverage given to them is much less than that given to politicians, these views are hardly able to become mainstream. Among business persons, Mukesh Ambani is seen to speak positively on Cashless Payments.
<br><br>

                For Digital India: Similar to most of the other policies, both the ruling party and opposition members are seen to speak positively on Digital India. The opposition members are of course less positive, but are not completely negative about the policy as it was ideated when they (INC) were in power. Among business persons, Mukesh Ambani is seen to speak positively on Digital India . This is obvious as Reliance’s Jio catalyzed the digital revolution in India and disrupted the digital market, especially during the formulation of the policy.<br><br>

                For E-Gov: Both the ruling party and opposition members are seen to speak mostly positively on E-Governance. The opposition members are of course less positive, but are not completely negative about the policy as it was ideated when they (INC) were in power.


                    </p>
                </div>
            </div>
        </div>
    </div>
        
        
       

    </div>
    

    <div id="footer"></div>
</body>

</html>