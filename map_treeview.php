<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include('assets/inc/db_connect.php');
		include('assets/inc/common-function.php');
		include('assets/inc/functions.php');
		sec_session_start();

		$TodaysRM=4;
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Area Entry</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
<!--	<script type="text/javascript" src="assets/js/charts/d3/tree/tree_basic.js"></script>-->

	<script type="text/javascript">
		var TodaysRM= 4;
	</script>
	<script type="text/javascript" src="assets/js/charts/d3/tree/tree_collapsible.js"></script>
	<script type="text/javascript" src="assets/js/charts/d3/tree/tree_bracket.js"></script>
	<script type="text/javascript" src="assets/js/charts/d3/tree/tree_radial.js"></script>
	<script type="text/javascript" src="assets/js/charts/d3/tree/tree_dendrogram.js"></script>
	<script type="text/javascript" src="assets/js/charts/d3/tree/tree_dendrogram_radial.js"></script>
	<!-- /theme JS files -->

	<script type="text/JavaScript" src="assets/js/search/search.js"></script>
	<script type="text/JavaScript" src="assets/js/sha512.js"></script>

	<!-- /theme JS files -->

</head>

<body class="navbar-top">

	<!-- Main navbar -->
	<?php
		$PageHeaderName="Manage Area";
		$icon="icon-address-book";

		include('page_header.php');

//		$php_page=basename(__FILE__);
//		$get_return_value=login_check($con, $php_page);
//		include_once("assets/inc/handle_error.php");
//
//		//		mysqli_close($con);
//		log_pageaccess($con, $_SESSION["pageid"], basename(__FILE__));
//		//		mysqli_close($con);
//		include_once('assets/inc/db_connect.php');


	?>
	<!-- /main navbar -->
	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">


					<?php
							$dir = "assets/demo_data/d3/tree/";
							$my_file = 'tree_data_collapsible_sachin.json';
							$FilePath="assets/demo_data/d3/tree/tree_data_collapsible.json";
							// Open a directory, and read its contents
							if (is_dir($dir)) {
								if ($handle = opendir('.')) {
									while (false !== ($file = readdir($handle))) {
//										echo("file :- $file </br>");
										if ($file != "tree_data_collapsible_sachin.json") {
											$handle = fopen($FilePath, 'w') or die('Cannot open file:  ' . $my_file); //implicitly creates file
											$data="";
//											echo "filename:" . file_get_contents($FilePath)  . "<br>";
//											die();

											$CurrentDate = "2016-09-06"; //date('Y-m-d');
											$StartDate = $CurrentDate . " 00:00:00";
											$EndDate = $CurrentDate . " 23:59:59";
											$sqlQry = "";
											$sqlQry = "select outward.TransitDate, outward.oid from outward ";
											$sqlQry .= " where 1=1";
											$sqlQry .= " and (TransitDate  BETWEEN  '$StartDate' AND '$EndDate')";
											$sqlQry .= " and outward.Active=1";
											$sqlQry .= " order by oid";
//											echo ("$sqlQry");
//											die();
											include('assets/inc/db_connect.php');
											$result = mysqli_query($con, $sqlQry);

											$TotalInc = 0;
											if (mysqli_num_rows($result) != 0) {
												$inc = 0;

												$ParentSubInc=0;
												$Parentrowcount=0;
												$Parentrowcount=mysqli_num_rows($result);

												while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
													$TransitDate = $row{0};
													$RMID = $row{1};

													$inc = $inc + 1;
													//Start Writing to json file
													if($inc==1) {
														$data .= '{';

														$data .= ' "name": "' . $TransitDate . '",';
														$data .= ' "children":[ ';

													}

													$data.= '{';
													$data.= ' "name": "' . $RMID . '", ';

													$sqlQry1 = "";
													$sqlQry1 = "select iid from outwardlr ";
													$sqlQry1 .= " where 1=1";
													$sqlQry1 .= " and (oid=$RMID)";
													$sqlQry1 .= " and Active=1";
//													echo ("$sqlQry1");
//													die();
													include('assets/inc/db_connect.php');
													$result1 = mysqli_query($con, $sqlQry1);
													if (mysqli_num_rows($result1) != 0) {

														$SubInc=0;
														$rowcount=0;
														$rowcount=mysqli_num_rows($result1);
//														echo("RMID :- $RMID </br>");
//														echo ("rowcount :- $rowcount </br></br></br>");
//														die();

														$data.= ' "children":[ ';
														while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) {
															$SubInc=$SubInc+1;
//															echo ("SubInc :- $SubInc </br>");
															$TotalInc = $TotalInc + $TotalInc;
															$LRID = $row{0};
															$data.= ' {"name": "' . $LRID . '", ';
															$data.= ' "size": 3514}';

															if($SubInc  < $rowcount){
																$data.= ',';
															}
														}

														$data.= ' ] ';
													}

													$ParentSubInc=$ParentSubInc+1;

													if($ParentSubInc  < $Parentrowcount){
														$data.= '},';
													}
												}

												//End Writing to json file
												$data.= ' } ';
												$data.= ' ] ';
												$data.= '}';


												fwrite($handle, $data);
											}
											mysqli_free_result($result);
//											echo("TotalInc :- $TotalInc </br></br></br>");
											fclose($handle);
										}

//										closedir($handle);
									}
								}
							}


					?>
					<!-- Collapsible tree -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Collapsible tree</h5>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="reload"></a></li>
								</ul>
							</div>
						</div>

						<div class="panel-body">


							<div class="chart-container has-scroll">
								<div class="chart has-minimum-width" id="d3-tree-collapsible"></div>
							</div>
						</div>
					</div>
					<!-- /collapsible tree -->



					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
