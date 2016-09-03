<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
    include('assets/inc/functions.php');
    sec_session_start();
    $Area=Fill_LRForJS($con);
    //		echo("</br></br></br></br></br></br></br></br></br></br></br> Area :- $Area </br>");
    $Area="[".$Area."]";
    $vals=$Area;
    mysqli_close($con);
    include('assets/inc/db_connect.php');
    //		echo("</br></br></br></br></br></br></br></br></br></br></br> Area :- $Area </br>");
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Bill</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/fontawesome/fonts/styles.min.css" rel="stylesheet" type="text/css">
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
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
    <!-- /theme JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
    <!-- /theme JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>

    <!-- /theme JS files -->


    <!-- Javascript dropdown list functions-->
    <script type="text/javascript">
        var area=<?php echo $vals;?>;
    </script>

    <script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/autosize.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/formatter.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/typeahead/handlebars.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/passy.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/maxlength.min.js"></script>

    <script type="text/javascript" src="assets/js/pages/form_controls_extended.js"></script>
    <!-- Javascript dropdown list functions-->

    <script type="text/JavaScript" src="assets/js/search/search.js"></script>
    <script type="text/JavaScript" src="assets/js/sha512.js"></script>

</head>

<body class="navbar-top">

<!-- Main navbar -->
<?php
    $PageHeaderName="Bill Deletion";
    $icon="icon-address-book";

    include('page_header.php');

    $php_page=basename(__FILE__);
    $get_return_value=login_check($con, $php_page);
    include_once("assets/inc/handle_error.php");
    log_pageaccess($con, $_SESSION["pageid"], basename(__FILE__));
    include_once('assets/inc/db_connect.php');

?>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">



            <!-- Form actions -->
            <div class="row">
                <div class="col-sm-10 col-md-10 col-lg-10 col-lg-10 col-lg-offset-1">
                    <form name="deletebill_form" id="deletebill_form" action="#">
                        <input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
                        <input type="hidden" name="AddEdit" id="AddEdit" value="0">

                        <div id="<?php echo $div_merchantcontrols; ?>" class="panel panel-flat" style="border-color:<?php echo $Form_BorderColor; ?>; border-top-width:<?php echo $Form_BorderTopWidth; ?>;">

                            <div class="panel-heading" id="<?php echo $div_panel; ?>" style="background-color:<?php echo $FormHeadingColor; ?>;">
                                <h5 class="panel-title"><i class="icon-user-tie position-left"></i> <span class="text-semibold" id="<?php echo $span_pageName; ?>"><?php echo $PageHeaderName; ?></h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload" onclick="return ClearAllControls(0);"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body" style="margin-top:15px;">
                                <div class="row">

                                    <!-- Basic datatable -->
                                    <div class="panel panel-flat">


                                        <table class="table datatable-basic">
                                            <thead>
                                            <tr>
                                                <th>Bill No.</th>
                                                <th>Financial year</th>
                                                <th>Bill Date</th>
                                                <th>Consignor Name</th>
                                                <th>Discount</th>
                                                <th>Bill Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $cols="bid, CreationDate, ModificationDate, Creator, ip, fyid, BillingDate, caid, Amount, Discount, ServiceTax, BillAmount, Active ";
                                                $sqlQry= "select $cols from `bill`";
                                                $sqlQry.= " where BillStatus=0";
                                                $sqlQry.= " and Active=1";
//                                                echo ("Check sqlQry :- $sqlQry </br>");
//                                                die();
                                                unset($con);
                                                include('assets/inc/db_connect.php');
                                                $result = mysqli_query($con, $sqlQry);
                                                if (mysqli_num_rows($result)!=0)
                                                {
                                                    while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
                                                    {
                                                        $bid=$row[0];
                                                        $CreationDate=$row[1];
                                                        $ModificationDate=$row[2];
                                                        $Creator=$row[3];
                                                        $ip=$row[4];
                                                        $fyid=$row[5];
                                                        $BillingDate=$row[6];
                                                        $caid=$row[7];
                                                        $Amount=$row[8];
                                                        $Discount=$row[9];
                                                        $ServiceTax=$row[10];
                                                        $BillAmount=$row[11];
                                                        $Active=$row[12];

                                                        $FinancialYearOnID=Get_FinancialYearOnID($con, $fyid);
                                                        $ConsignorName=Get_ConsignorName($con, $caid);

                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <div id="<?php echo $bid;?>">
                                                                    <a href="#" onclick="return delete_bill(<?php echo $bid; ?>);"><?php echo $bid; ?></a>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $FinancialYearOnID; ?></td>
                                                            <td><?php echo $BillingDate; ?></td>
                                                            <td><?php echo $ConsignorName; ?></td>
                                                            <td><?php echo $Discount; ?></td>
                                                            <td><?php echo $BillAmount; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /basic datatable -->

                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>




            <!-- /form actions -->
        </div>
        <!-- /content wrapper -->
    </div>
    <!-- /page content -->
    <?php include('footer.php'); ?>
</div>
<!-- /page container -->
</body>
</html>
