<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('assets/inc/db_connect.php');
        include('assets/inc/common-function.php');
        include('assets/inc/functions.php');
        sec_session_start();

        $LREntry_30Days=Get_LREntry_30Days($con);
//        echo("</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>");

        $Club="";
        $Club = explode("||", $LREntry_30Days);
        $LREntry_30Days=$Club[0];
        $LREntry_30Days_DayList=$Club[1];
        $LREntry_30Days_CountList=$Club[2];



//        echo("LREntry_30Days :- $LREntry_30Days </br>");
//        echo("LREntry_30Days_DayList :- $LREntry_30Days_DayList </br>");
//        echo("LREntry_30Days_CountList :- $LREntry_30Days_CountList </br>");


//        die();
        $RMEntry_30Days=Get_RMEntry_30Days($con);

        $Club="";
        $Club = explode("||", $RMEntry_30Days);
        $RMEntry_30Days=$Club[0];
        $RMEntry_30Days_DayList=$Club[1];
        $RMEntry_30Days_CountList=$Club[2];

//        echo("</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>");
//        echo("RMEntry_30Days :- $RMEntry_30Days </br>");
//        echo("RMEntry_30Days_DayList :- $RMEntry_30Days_DayList </br>");
//        echo("RMEntry_30Days_CountList :- $RMEntry_30Days_CountList </br>");
//        die();

        // 1 - Delivered, 2 - UnDelivered, 3 - InTransit
        $LRDelivered=Get_LRStatusCount($con,1);
        $LRUnDelivered=Get_LRStatusCount($con,2);
        $LRInTransit=Get_LRStatusCount($con,3);

        // No RM is Created
        $LRRoadMemo=Get_LRRoadMemo($con,1);


//        $BillAmountFinancialYear=Get_BillAmountFinancialYear($con, $FinancialYearID);
//        $BillAmountFinancialYear=Get_BillReceivedAmountFinancialYear($con, $FinancialYearID);


        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-t');
        $StartDate=$first_day_this_month." 00:00:00";
        $EndDate=$last_day_this_month." 23:59:59";
        //                                                echo("Start_Date :- $Start_Date </br>");
        //                                                echo("End_Date :- $End_Date </br>");
        $CYear=date("Y");
        $CMonth=date("m");
        if($CMonth<4){
            $CYear=$CYear-1;
        }
        $FinancialYearID=Get_FinancialYear($con, $CYear);

        $BillGeneratedAmountFinancialYear=Get_BillGeneratedAmountFinancialYear($con, $FinancialYearID);
//        echo("BillGeneratedAmountFinancialYear :- $BillGeneratedAmountFinancialYear </br>");
//        die();

        $BillNotGeneratedAmountFinancialYear=Get_BillNotGeneratedAmountFinancialYear($con, $FinancialYearID);
//        echo("BillNotGeneratedAmountFinancialYear :- $BillNotGeneratedAmountFinancialYear </br>");

        $CurrentDate="2016-09-15";//date('Y-m-d');
        $SDate=$CurrentDate." 00:00:00";
        $EDate=$CurrentDate." 23:59:59";

        $Vehicle_RoadMemo_DailyQuantity=Get_Vehicle_RoadMemo_DailyQuantity($con, $SDate, $EDate);
//        echo("Vehicle_RoadMemo_DailyQuantity :- $Vehicle_RoadMemo_DailyQuantity </br>");
//        die();

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shree Vighnahar Logistics ( Time To Time ) A leading name in Logistics , Transportation , Warehousing , C &F</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="invoice/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover-min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Global stylesheets  Invoice-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>


    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/full.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_select2.js"></script>


    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_dropdowns.js"></script>

    <!-- /theme JS files -->


    <script type="text/javascript">
        var LREntry_30Days="<?php echo $LREntry_30Days ?>";
        var LREntry_30Days_DayList="<?php echo $LREntry_30Days_DayList ?>";
        var LREntry_30Days_CountList="<?php echo $LREntry_30Days_CountList ?>";


        var RMEntry_30Days="<?php echo $RMEntry_30Days ?>";
        var RMEntry_30Days_DayList="<?php echo $RMEntry_30Days_DayList ?>";
        var RMEntry_30Days_CountList="<?php echo $RMEntry_30Days_CountList ?>";

    </script>

    <script type="text/javascript" src="assets/js/pages/dashboard.js"></script>
    <!-- /theme JS files -->


    <!-- Google - Theme JS files -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>

        <script type="text/javascript" src="assets/js/charts/google/bars/column.js"></script>
        <script type="text/javascript" src="assets/js/charts/google/bars/column_stacked.js"></script>
        <script type="text/javascript">
            var LRDelivered=<?php echo $LRDelivered ?>;
            var LRUnDelivered=<?php echo $LRUnDelivered ?>;
            var LRInTransit=<?php echo $LRInTransit ?>;
            var LRRoadMemo=<?php echo $LRRoadMemo ?>;
        </script>
        <script type="text/javascript" src="assets/js/charts/google/bars/bar.js"></script>
        <script type="text/javascript" src="assets/js/charts/google/bars/bar_stacked.js"></script>
        <script type="text/javascript" src="assets/js/charts/google/bars/histogram.js"></script>
        <script type="text/javascript" src="assets/js/charts/google/bars/combo.js"></script>
    <!-- Google - Theme JS files -->

        <script type="text/javascript">
            
            var BillGeneratedAmountFinancialYear=<?php echo $BillGeneratedAmountFinancialYear ?>;
            var BillNotGeneratedAmountFinancialYear=<?php echo $BillNotGeneratedAmountFinancialYear ?>;

        </script>
    <!-- Google - Theme JS files (Pie )-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="assets/js/charts/google/pies/3d_exploded.js"></script>
    <!-- Google - Theme JS files (Pie )-->

    <!-- Theme JS files  (EChart Pie)-->
        <script type="text/javascript" src="assets/js/plugins/visualization/echarts/echarts.js"></script>

        <script type="text/javascript">
            var Vehicle_RoadMemo_DailyQuantity="<?php echo $Vehicle_RoadMemo_DailyQuantity ?>";
        </script>

        <script type="text/javascript" src="assets/js/charts/echarts/pies_donuts.js"></script>
    <!-- Theme JS files  (EChart Pie)-->

    <script type="text/JavaScript" src="assets/js/search/search.js"></script>

</head>

<body class="navbar-top">

<!-- Main navbar -->
<?php
    $PageHeaderName="Super Admin Dashboard ";
    $icon="icon-address-book";
    include('page_header.php');

    $php_page=basename(__FILE__);
    $get_return_value=login_check($con, $php_page);
    include_once("assets/inc/handle_error.php");
    log_pageaccess($con, $_SESSION["pageid"], basename(__FILE__));
    include_once('assets/inc/db_connect.php');
?>
<!-- /main navbar -->

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-display4 position-left"></i> <span class="text-semibold"> Admin Dashboard</span> </h4>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Dashboard content -->

            <div class="row">
                <div class="col-lg-10">
                    <!-- Quick stats boxes -->


                    <!-- Quick stats boxes -->
                    <div class="row">
                        <div class="col-lg-4">

                            <!-- Members online -->
                            <div class="panel bg-teal-400">
                                <div class="panel-body">
                                	<div class="row">
                                      <div class="col-xs-12">
                                        <div class="col-xs-4 text-left">
                                            <?php

                                                $LRCountFinancialYear=0;
                                                $LRCountFinancialYear=Get_LRCountFinancialYear($con, $FinancialYearID);

                                                $LRCountMonth=Get_LRCountMonth($con, $StartDate, $EndDate);

                                                $InTransit=Get_LRCountInTransit($con);
                                            ?>
                                            <h1 class="count-top no-margin"><?php echo $LRCountMonth; ?></h1>
                                            Month

                                            <?php
                                                $LRCountDayAvarage=Get_LRCountDayAvarage($con, $StartDate, $EndDate);
                                            ?>
                                            <div class="text-muted text-size-small"><?php echo $LRCountDayAvarage; ?> avg</div>
                                        </div>

                                    </div>
                                   </div>                                  
                                </div>

                                <div class="container-fluid">
                                    <div id="members-rm"></div>
                                </div>
                                <div class="bg-teal-600 text-center"><span>Lorry Receipt </span></div>
                            </div>
                            <!-- /members online -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Current server load -->
                            <div class="panel bg-pink-400">
                                <div class="panel-body">
                                	<div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-xs-4 text-left">
                                                <?php
                                                    $RMCountFinancialYear=Get_RMCountFinancialYear($con, $FinancialYearID);
                                                    $RMCountDayAvarage=Get_RMCountDayAvarage($con, $StartDate, $EndDate);
                                                    $RMCountMonth=Get_RMCountMonth($con, $StartDate, $EndDate);
                                                ?>
                                                 <h3 class="count-top no-margin"><?php echo $RMCountMonth;?></h3>
                                                Month

                                                <?php

                                                ?>

                                                <div class="text-muted text-size-small"><?php echo $RMCountDayAvarage;?> avg</div>
                                            </div>
                                            <div class="col-xs-4 text-right">
                                                
                                            </div>


                                            <div class="col-xs-4 text-right">
                                                <div class="heading-text">
                                                  <ul class="icons-list">
                                                      <li class="dropdown">
                                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                          <i class="icon-cog3"></i> <span class="caret"></span></a>
                                                          <ul class="dropdown-menu dropdown-menu-right">
                                                              <li><a href="#"><i class="icon-tree6"></i> Road Memo Tree View</a></li>
                                                          </ul>
                                                      </li>
                                                  </ul>
                                              </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>

                                <div id="members-lr"></div>
                                <div class="container-fluid">
                                    <div id="members-rm"></div>
                                </div>
                                <div class="bg-pink-800 text-center"><span>Road Memo </span></div>
                            </div>
                            <!-- /current server load -->

                        </div>






                        <div class="col-lg-4">

                            <!-- Today's revenue -->
                            <div class="panel bg-blue-400">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-xs-4 text-left border-right">
                                                <?php
                                                    $LRPackagesCountMonth=Get_LRPackagesCountMonth($con, $StartDate, $EndDate);
                                                ?>
                                                 <h3 class="count-top no-margin"><?php echo $LRPackagesCountMonth;?></h3>
                                                Stock Inward


                                                <div class="text-muted text-size-small"><?php echo $RMCountDayAvarage;?>Areas</div>
                                            </div>
                                            <div class="col-xs-4 text-left border-right">
                                                <?php
                                                    $LRPackagesInTransitCountMonth=Get_LRPackagesInTransitCountMonth($con, $StartDate, $EndDate);
                                                ?>
                                                <h3 class="count-top no-margin"><?php echo $LRPackagesInTransitCountMonth;?></h3>
                                                Stock Outward
                                            </div>
                                            <div class="col-xs-4 text-left">
                                            <div class="heading-text">
                                                  <ul class="icons-list pull-right">
                                                      <li><a data-action="reload"></a></li>
                                                  </ul>
                                              </div>
                                                <?php
                                                    $LRPackagesReturnCountMonth=Get_LRPackagesReturnCountMonth($con, $StartDate, $EndDate);
                                                ?>
                                                
                                            	<span class="heading-text badge bg-blue-800"> <?php echo $LRPackagesReturnCountMonth;?> </span>
                                               <div class="text-muted text-size-small">Return Packages</div>
                                                
                                            </div>
                                        </div>
                                     </div>
                                </div>

                                <div id="members-bill"></div>
                                <div class="container-fluid">
                                    <div id="members-rm"></div>
                                </div>
                                <div class="bg-blue-800 text-center"><span>Stock </span></div>
                            </div>
                            <!-- /today's revenue -->

                        </div>
                    </div>
                    <!-- /quick stats boxes -->
                    <div class="col-md-12">
                    	<div class="row">
                        	<div class="col-md-8">
                            	<div class="row">
                                    <div class="col-md-9">
                                       <div class="panel panel-flat border-top-info">
                                          <div class="panel-heading">
                                              <h6 class="panel-title">Current Financial Year LR Status
                                                  <span class="heading-text badge bg-blue-800"> <?php echo $LRCountFinancialYear;?> </span>
                                              </h6>
                                              <div class="heading-elements">
                                                  <ul class="icons-list">
                                                      <li><a data-action="collapse" class=""></a></li>
                                                      <li><a data-action="reload"></a></li>
                                                  </ul>
                                              </div>
                                              <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                                          </div>
              
                                          <div class="panel-body" style="display: block;">
                                              <!-- Members online -->
                                                      <div id="google-bar"></div>
                                              <!-- /members online -->
                                          </div>
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="panel panel-flat border-top-info">
                                          <div class="panel-body">
                                                  <?php
                                                      $BillGeneratedCountFinancialYear=Get_BillGeneratedCountFinancialYear($con, $FinancialYearID);
//                                                      $RMCountDayAvarage=Get_RMCountDayAvarage($con, $StartDate, $EndDate);
//                                                      $RMCountMonth=Get_RMCountMonth($con, $StartDate, $EndDate);
                                                  ?>

                                                <div class="count_bottom text-left">Bills-This Year</div>
                                                <div class="count no-margin text-center"><?php echo $BillGeneratedCountFinancialYear;?></div>
                                                <div class="media-body">
                                                      <a href="#" class="heading-text pull-right"><strong>More</strong></a>
                                                 </div>
                                                
                                              </div>
                                      </div>
                                      
                                      <div class="panel panel-flat border-top-info">
                                          <div class="panel-body">
											  <?php
                                                  $BillNotGeneratedCountFinancialYear=Get_BillNotGeneratedCountFinancialYear($con, $FinancialYearID);
                                              ?>

                                            <div class="count_bottom text-left">Unbills-This Year</div>
                                            <div class="count no-margin text-center"><?php echo $BillNotGeneratedCountFinancialYear; ?>
                                            </div>
                                            <div class="media-body">
                                                  <a href="#" class="heading-text pull-right"><strong>More</strong></a>
                                             </div>
                                          </div>
                                      </div> 
                                      
                                   </div>
                                </div>
                        		<div class="row">
                                 <div class="col-md-12">
                                 	<div class="row">
                                    	<div class="col-md-6">
                                            <div class="panel panel-flat border-top-info">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Statistics</h6>
                                                    <div class="heading-elements">
                                                        <ul class="icons-list">
                                                            <li><a data-action="collapse" class=""></a></li>
                                                            <li><a data-action="reload"></a></li>
                                                        </ul>
                                                    </div>
                                                <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                                                </div>
                    
                                                <div class="panel-body text-center">
                                                    <!-- Members online -->
                                                    <div class="chart has-fixed-height has-minimum-width" id="basic_pie"></div>
                                                    <!-- /members online -->
                                                </div>
                                            </div>
                                         </div>
                                         <div class="col-md-6">
                                            <div class="panel panel-flat border-top-info">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Custom panel border</h6>
                                                    <div class="heading-elements">
                                                        <ul class="icons-list">
                                                            <li><a data-action="collapse" class=""></a></li>
                                                            <li><a data-action="reload"></a></li>
                                                        </ul>
                                                    </div>
                                                <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                                                </div>
                    
                                                <div class="panel-body text-center">
                                                    <!-- Members online -->
                                                        <div class="display-inline-block" id="google-3d-exploded"></div>
                                                    <!-- /members online -->
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                 </div>
                                 </div>
                             </div>
                        	<div class="col-md-4">
                        		<div class="panel panel-flat border-top-info">
                                  <div class="panel-heading">
                                      <h6 class="panel-title">Facts & Figures</h6>
                                      <div class="heading-elements">
                                          <ul class="icons-list">
                                              <li><a data-action="collapse"></a></li>
                                              <li><a data-action="reload"></a></li>
                                          </ul>
                                      </div>
                                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                                  
                                  <div class="panel-body">
                                  </div>
                                  <div class="table-responsive">
                                      <table class="table text-nowrap">
                                          <thead>
                                              <tr>
                                                  <th>Descriptiom</th>
                                                  <th></th>
                                                  <th>Count</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon"> I</span>
                                                          </a>
                                                      </div>

                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Inward Count</a>
                                                          </div>
                                                          <div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> </div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $LRCountFinancialYear; ?></h6>
                                                  </td>
                                              </tr>

                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon"> A</span>
                                                          </a>
                                                      </div>

                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Areas Served</a>
                                                          </div>
                                                          <?php
                                                                $AreaServedFinancialYear=Get_AreaServedFinancialYear($con, $FinancialYearID);
                                                          ?>
                                                          <div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> </div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $AreaServedFinancialYear; ?></h6>
                                                  </td>
                                              </tr>
      
                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon">C</span>
                                                          </a>
                                                      </div>
      
                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Consignees</a>
                                                          </div>
      
                                                          <div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> </div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <?php
                                                        $ConsigneeFinancialYear=Get_ConsigneeFinancialYear($con, $FinancialYearID);
                                                  ?>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $ConsigneeFinancialYear;?></h6>
                                                  </td>
                                              </tr>
      
                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-indigo-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon">T</span>
                                                          </a>
                                                      </div>
      
                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Trips</a>
                                                          </div>
      
                                                          <div class="text-muted text-size-small"><i class="icon-lifebuoy text-size-mini position-left"></i> ..</div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <?php
                                                    $TripsFinancialYear=Get_TripsFinancialYear($con, $FinancialYearID);
                                                  ?>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $TripsFinancialYear;?></h6>
                                                  </td>
                                              </tr>
      
                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon">P</span>
                                                          </a>
                                                      </div>
      
                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Products</a>
                                                          </div>
      
                                                          <div class="text-muted text-size-small"><i class="icon-lifebuoy text-size-mini position-left"></i>...</div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <?php
                                                    $ProductsFinancialYear=Get_ProductsFinancialYear($con, $FinancialYearID);
                                                  ?>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $ProductsFinancialYear;?></h6>
                                                  </td>
                                              </tr>
      
                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon">C</span>
                                                          </a>
                                                      </div>
      
                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Consignors</a>
                                                          </div>
      
                                                          <div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> </div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <?php
                                                    $ConsignorFinancialYear=Get_ConsignorFinancialYear($con, $FinancialYearID);
                                                  ?>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $ConsignorFinancialYear;?></h6>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon">V</span>
                                                          </a>
                                                      </div>
      
                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Vehicles</a>
                                                          </div>
      
                                                          <div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> </div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <?php
                                                    $VehicleFinancialYear=Get_VehicleFinancialYear($con, $FinancialYearID);
                                                  ?>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $VehicleFinancialYear;?></h6>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>
                                                      <div class="media-left media-middle">
                                                          <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
                                                              <span class="letter-icon">P</span>
                                                          </a>
                                                      </div>
      
                                                      <div class="media-body">
                                                          <div class="media-heading">
                                                              <a href="#" class="letter-icon-title">Packages Handled</a>
                                                          </div>
      
                                                          <div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> </div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <span class="text-muted text-size-small"></span>
                                                  </td>
                                                  <?php
                                                        $PackagesFinancialYear=Get_PackagesFinancialYear($con, $FinancialYearID);
                                                  ?>
                                                  <td>
                                                      <h6 class="text-semibold no-margin"><?php echo $PackagesFinancialYear;?></h6>
                                                  </td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                    	<div class="row">
								<div class="col-md-12">
									<div class="panel panel-flat border-top-info">
										<div class="panel-body">

                                            <?php include('billstatus.php'); ?>

										</div>

										
									</div>
								</div>
							</div>
                    </div>
                    
                </div>
                
                <div class="col-lg-2 col-sm-6">
                               <!-- View LR RM -->
                              <div class="panel panel-flat">
                                  <div class="panel-heading">
                                      <h6 class="panel-title">View LR / Rm / Bill</h6>
                                      <div class="heading-elements">
                                          <ul class="icons-list">
                                              <li><a data-action="collapse"></a></li>
                                          </ul>
                                      </div>
                                  </div>
  
                                  <div class="panel-body">
                                      <form action="#">
                                          <div class="form-group">
                                              <input class="form-control input-micro" type="text" placeholder="View LR" name="show_lrno" id="show_lrno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                          </div>
                                          <div class="col-sm-2 text-center">
  
  
                                              <!--                                        <button type="button" class="btn btn-info btn-xs" onclick="return displaylr(document.getElementById('show_lrno').value);">Submit</button>-->
                                              <button type="button" class="btn btn-info btn-xs" onclick="return displaylr(document.getElementById('show_lrno').value);">Submit</button>
  
                                          </div>
                                      </form>
                                  </div>
  
  
                                  <div class="panel-body">
                                      <form action="#">
                                          <div class="form-group">
                                              <input class="form-control input-micro" type="text" placeholder="View RM" name="show_rmno" id="show_rmno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                          </div>
                                          <div class="col-sm-2 text-center">
  
                                              <!--                                    <a href="#modal_full" data-toggle='modal' class='modalButton2' data-teacherid="1" >-->
                                              <button type="button" class="btn btn-success btn-xs" onclick="return displayrm(document.getElementById('show_rmno').value);">Submit</button>
                                              <!--                                        </a>-->
                                          </div>
                                      </form>
                                  </div>
  
  
                                  <div class="panel-body">
                                      <form action="#">
                                          <div class="form-group">
                                              <input class="form-control input-micro" type="text" placeholder="View Bill" name="show_billno" id="show_billno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                          </div>
                                          <div class="col-sm-2 text-center">
  
                                              <!--                                    <a href="#modal_full" data-toggle='modal' class='modalButton2' data-teacherid="1" >-->
                                              <button type="button" class="btn btn-danger btn-xs" onclick="return displaybill(document.getElementById('show_billno').value);">Submit</button>
                                              <!--      </a>-->
                                          </div>
                                      </form>
                                  </div>
                              </div>
                              <!-- /View LR RM -->
                            </div>

                <div class="col-lg-2 col-sm-6">
                    <!-- Secondary sidebar -->
                    <div class="sidebar sidebar-secondary sidebar-default">
                        <div class="sidebar-content">
							<!-- Actions -->
                            <div class="sidebar-category">
                                <div class="bg-blue-800 text-center"><span>Manage Masters </span></div>

                                <ul class="navigation navigation-alt navigation-accordion">
                                    <?php
                                        $TableName="login_master";
                                        $MasterDataCount=Get_MasterDataCount($con, $TableName);
                                    ?>
                                    <li><a href="#" onclick="window.open('add_login.php','_self');"><i class="icon-user-lock"></i> User <span class="badge badge-info"><?php echo $MasterDataCount;?></span></a></li>

                                    <?php
                                        $TableName="consignor_master";
                                        $MasterDataCount=Get_MasterDataCount($con, $TableName);
                                    ?>
                                    <li><a href="#" onclick="window.open('add_consignor.php','_self');"><i class="icon-user-check"></i> Consignor <span class="badge badge-danger"><?php echo $MasterDataCount;?></span></a></li>

                                    <?php
                                        $TableName="product_master";
                                        $MasterDataCount=Get_MasterDataCount($con, $TableName);
                                    ?>
                                    <li><a href="#" onclick="window.open('add_product.php','_self');"><i class="icon-cart-add2"></i> Products <span class="badge badge-info"><?php echo $MasterDataCount;?></span></a></li>

                                    <li><a href="#" onclick="window.open('add_rate.php','_self');"><img src="assets/images/rupee_bag-512.png" height="20" width="20"> &nbsp;&nbsp;Rate </a></li>
                                    <li><a href="#" onclick="window.open('add_additionalcharge.php','_self');"><i class="icon-coin-dollar"></i> Additional Charges</a></li>
                                    <?php
                                        $TableName="transporter_master";
                                        $MasterDataCount=Get_MasterDataCount($con, $TableName);
                                    ?>
                                    <li><a href="#" onclick="window.open('add_transporter.php','_self');"><i class="icon-steering-wheel"></i> Driver <span class="badge badge-success"><?php echo $MasterDataCount;?></span></a></li>

                                    <?php
                                        $TableName="vehicle_master";
                                        $MasterDataCount=Get_MasterDataCount($con, $TableName);
                                    ?>
                                    <li><a href="#" onclick="window.open('add_vehicle.php','_self');"><i class="icon-truck"></i> Vehicle <span class="badge badge-success"><?php echo $MasterDataCount;?></span></a></li>

                                    <li><a href="#" onclick="window.open('add_undeliveredreason.php','_self');"><i class="icon-location3"></i> Undelivered Reason </a></li>

                                    <?php
                                        $TableName="area_master";
                                        $MasterDataCount=Get_MasterDataCount($con, $TableName);
                                    ?>
                                    <li><a href="#" onclick="window.open('add_area.php','_self');"><i class="icon-location4"></i> Area <span class="badge badge-info"><?php echo $MasterDataCount;?></span></a></li>
                                    <li><a href="#" onclick="window.open('add_vehicleownership.php','_self');"><i class="icon-bus"></i>Vehicle Ownership</a></li>
                                    <li><a href="#" onclick="window.open('add_pageaccess.php','_self');"><i class="icon-file-check"></i>Page Access</a></li>
                                    <li><a href="#" onclick="window.open('add_pages.php','_self');"><i class="icon-stack"></i>Pages </a></li>
                                    <li><a href="#" onclick="window.open('add_merchant.php','_self');"><i class="icon-user-tie"></i> Merchant</a></li>
                                    <li><a href="#" onclick="window.open('add_contacttype.php','_self');"><i class="icon-address-book"></i> Contact Type</a></li>
                                    <li><a href="#" onclick="window.open('add_deliverystatus.php','_self');"><i class="icon-diff"></i> Delivery Status</a></li>
                                    <li><a href="#" onclick="window.open('add_consignee.php','_self');"><i class=" icon-users2"></i>Manage Consignee</a></li>




                                </ul>
                            </div>
                            <!-- /actions -->


                            <!-- Navigation -->
                            
                            <div class="sidebar-category">
                                <div class="category-content no-padding">
                                </div>
                            </div>
                            <!-- /navigation -->
                        </div>

                    </div>
                    <!-- /secondary sidebar -->
                </div>
                
        <!-- /main content -->

    </div>
    <!-- /page content -->


    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- /footer -->

</div>
<!-- /page container -->

</body>
</html>
