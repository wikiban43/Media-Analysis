<!DOCTYPE html>
<?php
$id = $_GET['page'];
if (!empty($id)) {
} else {
    header("Location:../Entities/INTERLOCKS.htm");
}
?>
<html lang="en">

<head>
	<title>GEM</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link href="../scripts/css/nv.d3.css" rel="stylesheet" type="text/css">

	<style>
		body {
			font-family: 'Montserrat', 'serif';
			font-size: 14px;
			overflow: auto;
			color: #555555;
			letter-spacing: 0.15px;
			line-height: 1.5;
			width:100%;
		}
	    #mynetwork {
        width:100%;
		height: 500px;
		border: 1px solid white;
		border-radius: 5px;
		box-shadow: 0px 0px 6px white;

        }
		.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('../Images/page-loader.gif') 50% 50% no-repeat rgb(249,249,249);
}
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js" charset="utf-8"></script>
	<script src="../scripts/js/nv.d3.js"></script>
	<script type="text/javascript" src="../scripts/js/vis.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../scripts/css/vis.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../scripts/css/styleinfo.min.css">
	<link rel="stylesheet" type="text/css" href="../scripts/css/infostyle.min.css">
	<link rel="stylesheet" type="text/css" href="../scripts/css/interlocks.min.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script> 
$(function(){
  $("#header").load("header.html"); 
  $("#footer").load("footer.html"); 
});
</script>
</head>

<body>
<div class="loader"></div>
    <script type="text/javascript">
        $(window).load(function () {
            $(".loader").fadeOut("slow");
        })
	</script>
	<div id="header"></div>
	<div class="main">
		<h2 style="text-align: center;color: #05386b !important">

			<?php echo $_GET['page']; ?>
		</h2>
		<div class="container-fluid">
		<div class="row">
			
			<div class="col-sm-6 text-left"  >
			<div class="right-info" style="background:white;width:100% !important;" >
			<div class="graph" style="background:white; width:100% !important;">
				<div class="container-fluid" >
					<div class="row" style="background:white;">
						<br>
						<div class="col-sm-12 text-left">
							
							<div id="mynetwork"></div>
							
							<div id="networkJSON-results" class="results" style="display:none"></div>
							
							<script type="text/javascript">
								var options = {
									nodes: { 
										font: { 
											size: 18 
											}
										},
									autoResize: true,
									edges: {
										arrows: {
											to: {
												enabled: false,
												scaleFactor: 0.75,
												type: 'arrow'
											},
											middle: {
												enabled: false,
												scalefactor: 1,
												type: 'arrow'
											},
											from: {
												enabled: false,
												scaleFactor: 0.3,
												type: 'arrow'
											}
										},
										arrowStrikethrough: true,
										chosen: true,
										color: {
											color: '#2B7CE9',
											highlight: '#2B7CE9',
											hover: '#163644',
											inherit: 'from',
											opacity: 1.0
										},
										dashes: false,
										font: {
											color: '#343434',
											size: 14, // px
											face: 'arial',
											background: 'none',
											strokeWidth: 2, // px
											strokeColor: '#ffffff',
											align: 'horizontal',
											multi: false,
											vadjust: 0,
											bold: {
												color: '#343434',
												size: 14, // px
												face: 'arial',
												vadjust: 0,
												mod: 'bold'
											},
											ital: {
												color: '#343434',
												size: 14, // px
												face: 'arial',
												vadjust: 0,
												mod: 'italic'
											},
											boldital: {
												color: '#343434',
												size: 14, // px
												face: 'arial',
												vadjust: 0,
												mod: 'bold italic'
											},
											mono: {
												color: '#343434',
												size: 15, // px
												face: 'courier new',
												vadjust: 2,
												mod: ''
											}
										}
									},
									physics: {
										enabled: true,
										barnesHut: {
											gravitationalConstant: -2000,
											centralGravity: 0.3,
											springLength: 320,
											springConstant: 0.04,
											damping: 0.09,
											avoidOverlap: 0
										},
										forceAtlas2Based: {
											gravitationalConstant: -50,
											centralGravity: 0.01,
											springConstant: 0.08,
											springLength: 100,
											damping: 0.4,
											avoidOverlap: 0
										},
										repulsion: {
											centralGravity: 0.2,
											springLength: 200,
											springConstant: 0.05,
											nodeDistance: 100,
											damping: 0.09
										},
										hierarchicalRepulsion: {
											centralGravity: 0.0,
											springLength: 100,
											springConstant: 0.01,
											nodeDistance: 120,
											damping: 0.09
										},
										maxVelocity: 50,
										minVelocity: 0.1,
										solver: 'barnesHut',
										stabilization: {
											enabled: true,
											iterations: 1000,
											updateInterval: 100,
											onlyDynamicEdges: false,
											fit: true
										},
										timestep: 0.5,
										adaptiveTimestep: true
									},
									length: 320,
									smooth: {
										enabled: true,
										type: "continuous",
										roundness: 0.0
									},
									scaling: {
										min: 1,
										max: 2,
									}
								};


								var json = $.getJSON("../json data/<?php echo $_GET['page']; ?>.json")
									.done(function (data) {
										var data = {
											nodes: data.nodes,
											edges: data.edges
										};
										var network = new vis.Network(container, data, options);
									});

								var container = document.getElementById('mynetwork');
							</script>
							<p
						style="margin-inline-end: 4%;margin-inline-start: 4%;padding: 2.5px 2.5px 2.5px 2.5px; font-size: 15px !important;">
						<h5>The above figure is shown in two cases<br><br><b>Case 1:The industry sector is at the centre of the figure.</b></h5>
							This figure shows the industry sector and the ministries that it is interlocked with. 
							At the centre, we have the sector for which we want to see the interlocks, 
							and around it are the ministries to which it is connected. 
							The edge weights show the number of paths that exist between the sector and the ministry.
							<h5><b>Case 2:The ministry is at the centre of the figure.</b></h5>
							This figure shows the ministry and the industry sectors that it is interlocked with. 
							At the centre, we have the ministry for which we want to see the interlocks, 
							and around it are the sectors to which it is connected. 
							The edge weights show the number of paths that exist between the sector and the ministry.
					</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
			</div>
			<div class="col-sm-3 text-left">

				<div class="linkDeco">

					<ul class="list-group links-list" style="width:100%;margin-block-start: 10%;">
						<li class="list-group-item" style="background:white;color: #05386b !important;font-size:130%;border: 1px solid white; "
						 data-toggle="modal" data-target="#sector" data-toggle="tooltip" title="Click to know more!">
							<span style="font-family: 'Open Sans', 'serif';">Top Interlocked Sectors </button>
							</span>
						</li>
						<li class="list-group-item">
							<a href="../Pages/info.php?page=Manufacturing">Manufacturing</a>
						</li>
						<li class="list-group-item">
							<a href="../Pages/info.php?page=Professional, Scientic and Technical Activities">Professional, Scientic and
								Technical Activities</a>
						</li>
						<li class="list-group-item">
							<a href="../Pages/info.php?page=Wholesale and Retail Trade">Wholesale and Retail Trade</a>
						</li>
						<li class="list-group-item">
							<a href="../Pages/info.php?page=Financial and Insurance Activities">Financial and Insurance Activities</a>
						</li>
						<li class="list-group-item">
							<a href="../Pages/info.php?page=Agriculture, Forestry and Fishing">Agriculture, Forestry and Fishing</a>
						</li>
					</ul>

				</div>
			</div>
			<div class="col-sm-3 text-left">

				
					<div class="linkDeco">
						<ul class="list-group links-list" style="width: 100% !important;margin-block-start: 10%;">
							<li class="list-group-item" style="background:white;color: #05386b !important;font-size: 130%;border: 1px solid white; "
							 data-toggle="modal" data-target="#department" data-toggle="tooltip" title="Click to know more!">
								<span style="font-family: 'Open Sans', 'serif';font-size: 95%;">Top Interlocked Ministries</button>
								</span>
							</li>
							<li class="list-group-item">
								<a href="../Pages/info.php?page=Ministry Of Finance">Ministry Of Finance</a>
							</li>
							<li class="list-group-item">
								<a href="../Pages/info.php?page=Ministry Of Commerce and Industry">Ministry Of Commerce and Industry</a>
							</li>
							<li class="list-group-item">
								<a href="../Pages/info.php?page=Ministry Of Textiles">Ministry Of Textiles</a>
							</li>
							<li class="list-group-item">
								<a href="../Pages/info.php?page=Ministry Of Housing and Urban Affairs">Ministry Of Housing and Urban Affairs</a>
							</li>
							<li class="list-group-item">
								<a href="../Pages/info.php?page=Ministry Of Home Affairs">Ministry Of Home Affairs</a>
							</li>
						</ul>
					
				</div>

			</div>

			<p
						style="margin-inline-end: 1%;margin-inline-start: 1%;padding: 2.5px 2.5px 2.5px 2.5px; font-size: 15px !important;">
					In the above tables, we show the top five highest interlocked industry sectors that are interlocked with government ministries, 
					and the top five highest interlocked government ministries that are interlocked with industry sectors. 
					An interlock between a government ministry and an industry sector can occur through multiple hops. 
					For example, ministry A ---(works in)---IAS officer B---(is a manager of)---company C--(belongs to)---sector D. 
					Here, IAS officer B works in ministry A, and is also a manager or director of company C, which belongs to sector D. 
					Such paths or interlocks between the ministries and industry sectors are important examples of corporate-government overlap. 
					Click on each ministry/sector for further details about the interlocks.
					</p>




		</div>
	</div>
						
<div id="footer"></div>
							<script>
		$(document).ready(function () {
			$('.dropdown-submenu a.test').on("click", function (e) {
				$(this).next('ul').toggle();
				e.stopPropagation();
				e.preventDefault();
			});
		});
	</script>
	
	
	<div class="modal fade" id="department" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Hotspots are hubs of potential policy influence or cronyism. On the government side we have governemnt departments and
						ministries as hotspots: that is, politicians and bureaucrats interlock with each other through these departments and
						ministries. Similarly on the corporate side, industry sectors are hotspots where companies and their directors belong.
						We wanted to find out if there exist interlocks between these hotspots. Hence, we considered paths(interlocks) of upto
						3 hops between departments (ministries) and industry sectors. Here we show an example interlock between an government
						departments and an industry sector.</h5>
				</div>
				<div class="modal-body">
					<img src="../Images/INTERLOCKDESC.jpg" class="img-thumbnail">
					<p>Following are the top 5 most interlocked departments listed in decreasing order of their number of interlocks. As mentioned
						earlier, these hotspots are some of the most important hubs of policy influence and cronyism. Click on each department
						to know more about the details of the interlocks.
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="sector" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Hotspots are hubs of potential policy influence or cronyism. On the government side we have governemnt departments and
						ministries as hotspots: that is, politicians and bureaucrats interlock with each other through these departments and
						ministries. Similarly on the corporate side, industry sectors are hotspots where companies and their directors belong.
						We wanted to find out if there exist interlocks between these hotspots. Hence, we considered paths(interlocks) of upto
						3 hops between departments (ministries) and industry sectors. Here we show an example interlock between an government
						departments and an industry sector.</h5>
				</div>
				<div class="modal-body">
					<img src="../Images/INTERLOCKDESC.jpg" class="img-thumbnail">
					<p>Following are the top 5 most interlocked industry sectors listed in decreasing order of their number of interlocks.
						As mentioned earlier, these hotspots are some of the most important hubs of policy influence and cronyism. Click on
						each industry sector to know more about the details of the interlocks.
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

</body>

</html>
