<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<?php
$error_msg="";
$CurrentDate = date('Y-m-d h:i:s');
$lridlist="";
$searchvalue="";
if(isset($_REQUEST["Fill_LRIdList"])) {
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');

    $AddEdit = sanitize($con, $_REQUEST["AddEdit"]);
    $session_userid = sanitize($con, $_REQUEST["session_userid"]);
    $session_ip = sanitize($con, $_REQUEST["session_ip"]);

    $financialyear = sanitize($con, $_REQUEST["financialyear"]);
    $rmdate = sanitize($con, $_REQUEST["rmdate"]);
    $vehicleid = sanitize($con, $_REQUEST["vehicleid"]);
    $transporterid = sanitize($con, $_REQUEST["transporterid"]);
    $lridlist = sanitize($con, $_REQUEST["Fill_LRIdList"]);

//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("financialyear:- ".$financialyear."</br>");
//    echo ("rmdate:- ".$rmdate."</br>");
//    echo ("vehicleid:- ".$vehicleid."</br>");
//    echo ("transporterid:- ".$transporterid."</br>");
//    echo ("lridlist:- ".$lridlist."</br>");
//    die();
}


?>


<div class="col-sm-12 col-md-12 col-lg-12 col-lg-12">
    <!-- Scrollable datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Create Bill</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>


        <div class="row">

            <div class="col-md-3">
                <div class="form-group form-group-material">
                    <label>Financial Year </label>
                    <div class="input-group">
                        <?php
                        $CYear=date("Y");
                        $CMonth=date("m");
                        if($CMonth<4){
                            $CYear=$CYear-1;
                        }
                        $FinancialYear_C=Get_FinancialYear($con, $CYear);
                        //														echo("FinancialYear :- $FinancialYear </br>");
                        $FinancialYear_P=$FinancialYear_C-1;
                        ?>
                        <select name="financialyear" id="financialyear" class="form-control" required="required">
                            <?php
                            Fill_FinancialYear($con, $FinancialYear_P, $FinancialYear_C);
                            ?>
                        </select>
                            <span class="input-group-addon">
                                <i class="icon-truck"></i>
                            </span>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group form-group-material">
                    <label>Date <span class="text-danger">*</span></label>
                    <div class="content-group-lg">
                        <div class="input-group">
                            <input type="hidden" class="form-control daterange-single"  name="todaysdate" id="todaysdate" required="required">
                            <input type="text" class="form-control daterange-single"  name="rmdate" id="rmdate" required="required">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>