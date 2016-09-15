<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SVL RM Print</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover-min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover" rel="stylesheet" type="text/css">
    <link href="assets/css/print.css" rel="stylesheet" type="text/css">
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
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/fixed_header.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/col_reorder.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>

    <script type="text/javascript" src="assets/js/pages/datatables_extension_fixed_header.js"></script>
    <script type="text/javascript" src="assets/js/layout_sidebar_sticky.js"></script>
    <!-- /theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/media/fancybox.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/gallery.js"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="assets/js/pages/invoice_template.js"></script>
    <!-- /theme JS files -->

</head>


<?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
?>

<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $RMID = $_GET['RMID'];
//        echo("RMID :- $RMID </br>");
    //    die();

    $cols="";
    $cols.=" outward.oid, outward.CreationDate, outward.ModificationDate, outward.Creator, outward.ip, outward.TransitDate, outward.fyid, outward.vmid, outward.tmid, outward.Active";
    $cols.=" , outwardlr.iid, outwardlr.RMStatus, outwardlr.Bill";
    $cols.=" , `vehicle_master`.`VehicleNumber`";

    $sqlQry= "select $cols from `outward`";

    $sqlQry.= "inner join `outwardlr`";
    $sqlQry.= "on `outward`.`oid` = `outwardlr`.`oid`";

    $sqlQry.= "inner join `vehicle_master`";
    $sqlQry.= "on `outward`.`vmid` = `vehicle_master`.`vmid`";

    $sqlQry.= " where 1=1";

    $sqlQry.= " and outward.oid = $RMID";

    $sqlQry.= " and `outward`.Active=1";
    $sqlQry.= " and `outwardlr`.Active=1";

//    echo ("Check sqlQry :- $sqlQry </br>");
//    die();


    unset($con);
    include('assets/inc/db_connect.php');
    $result = mysqli_query($con, $sqlQry);
    if (mysqli_num_rows($result)!=0)
    {
        $inc=0;
        $LRID_List="";
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
        {
            $oid=$row[0];
            $CreationDate=$row[1];
            $ModificationDate=$row[2];
            $Creator=$row[3];
            $ip=$row[4];
            $TransitDate=$row[5];
            $fyid=$row[6];
            $vmid=$row[7];
            $tmid=$row[8];
            $Active=$row[9];

            $VehicleName=$row[10];

            $inc=$inc+1;
            $inc==1?$LRID_List=$row[10]:$LRID_List=$LRID_List.",".$row[10];
?>

<body class="print-mode print-paper-a4">
<div class="print-papers print-preview">
    <div class="print-paper">

        <!-- Invoice template -->

        <div class="top-header">
            <div class="row text-center">
                <h2>Road Memo</h2>
                <h4 class="no-margin-top text-semibold">Shree Vighnahar Logistics</h4>
                <p>Shed No.1, Gala No.1, Arihant Complex, Kopar Bus Stop, Purna Village, Bhiwandi, Dist:-Thane-421302.</p>
                <p>Tel. No. : 9987032373 / 9272217794 / 9272217795   Email ID : chetan@shreevighnaharlogistics.com</p>
            </div>
        </div>
        <div class="top-headerdetails">
            <div class="table-responsive">
                <div class="Chalan-details1">
                    <P>Chalan No.</P>
                    <P>Vehicle No.</P>
                    <P>Through</P>
                </div>
                <div class="Chalan-details2">
                    <P><?php echo $oid; ?></P>
                    <P><?php echo $VehicleName;?></P>
                    <P>SVL</P>
                </div>
                <div class="Chalan-details3"> </div>
                <div class="Chalan-details4">
                    <P>Date</P>
                    <P>From</P>
                    <P>To</P>
                </div>
                <div class="Chalan-details5">
                    <P><?php echo $TransitDate; ?></P>
                    <P>Bhiwandi</P>
                    <P>Mumbai</P>
                </div>
            </div>
        </div>



        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>CN No</th>
                    <th>Consignor's Name</th>
                    <th>Consignee's Name</th>
                    <th>Detination</th>
                    <th>Cases</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>bwd-0001357</td>
                    <td>Mcleods Pharmaceticals Ltd.</td>
                    <td>Chimanlal Sons</td>
                    <td>Borivali</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>bwd-0001369</td>
                    <td>Mcleods Pharmaceticals Ltd.</td>
                    <td>Chimanlal Sons</td>
                    <td>Borivali</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>bwd-0001374</td>
                    <td>Mcleods Pharmaceticals Ltd.</td>
                    <td>Chimanlal Sons</td>
                    <td>Borivali</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Franklin</td>
                    <td>Morrison</td>
                    <td>@Frank</td>
                    <td>@Frank</td>
                    <td>@Frank</td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>Total</td>
                    <td>25</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <div class="footerdetails">
                <div class="driversign">
                    <p> Driver's Signature</p>
                </div>
                <div class="despatchsign">
                    <p> Dispatch Incharge</p>
                </div>
            </div>

        </div>
    </div>
    <!-- /invoice template -->
</div>
</div>
</body>
<?php
    }
        }
        else{
            echo("RM No. does not exit. Please check......");
            die();
        }
?>