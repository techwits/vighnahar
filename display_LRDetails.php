<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SVL LR Print</title>

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
    <link href="assets/css/print_lr.css" rel="stylesheet" type="text/css">
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
    <script type="text/javascript" src="assets/js/pages/invoice_template.js"></script>
    <!-- /theme JS files -->

</head>


<body>


<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $LRID = $_GET['LRID'];
//    echo("LRID :- $LRID </br>");
//    die();


    $cols=" `inward`.LRID, `inward`.ReceivedDate, `inward`.InvoiceNumber, `inward`.PakageType, `inward`.Amount ";
    $cols.=" , `vehicle_master`.`VehicleNumber`";
    $cols.=" , `consignor_master`.`ConsignorName`";
    $cols.=" , `consignee_master`.`ConsigneeName`";
    $cols.=" , `product_master`.`ProductName`";
    $cols.=" , `inward`.fyid, `inward`.Rate, `inward`.Quantity";
    $cols.=" , `inward`.CreationDate, `inward`.Creator, `inward`.ip, `inward`.vmid, `inward`.caid, `inward`.cnid, `inward`.pmid";
    $cols.=" , `login_master`.UserName";
    $cols.=" , `financialyear_master`.FinancialYear";

    $cols.=" , `area_master`.AreaName";

    $sqlQry= "select $cols from `inward`";

    $sqlQry.= "inner join `vehicle_master`";
    $sqlQry.= "on `inward`.`vmid` = `vehicle_master`.`vmid`";

    $sqlQry.= "inner join `consignoraddress_master`";
    $sqlQry.= "on `inward`.`caid` = `consignoraddress_master`.`caid`";

    $sqlQry.= "inner join `consignor_master`";
    $sqlQry.= "on `consignoraddress_master`.`cid` = `consignor_master`.`cid`";

    $sqlQry.= "inner join `consignee_master`";
    $sqlQry.= "on `inward`.`cnid` = `consignee_master`.`cnid`";

    $sqlQry.= "inner join `consigneeaddress_master`";
    $sqlQry.= "on `consignee_master`.`cnid` = `consigneeaddress_master`.`cnid`";

    $sqlQry.= "inner join `area_master`";
    $sqlQry.= "on `consigneeaddress_master`.`amid` = `area_master`.`amid`";

    $sqlQry.= "inner join `product_master`";
    $sqlQry.= "on `inward`.`pmid` = `product_master`.`pmid`";

    $sqlQry.= "inner join `login_master`";
    $sqlQry.= "on `inward`.`Creator` = `login_master`.`loginid`";

    $sqlQry.= "inner join `financialyear_master`";
    $sqlQry.= "on `inward`.`fyid` = `financialyear_master`.`fyid`";


    $sqlQry.= " where 1=1";

    $sqlQry.= " and LRID = $LRID";

    $sqlQry.= " and `inward`.Active=1";


//    echo ("Check sqlQry :- $sqlQry </br>");
//    die();


    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
    $result = mysqli_query($con, $sqlQry);
    if (mysqli_num_rows($result)!=0)
    {
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
        {
            $lrid=$row[0];
            $TransitDate=$row[1];
            $InvoiceNo=$row[2];
            $PakageType=$row[3];
            $Amount=$row[4];
            $VehicleNumber=$row[5];
            $ConsignorName=$row[6];
            $ConsigneeName=$row[7];
            $ProductName=$row[8];

            $j=0;
            $SingleChar="";
            $Club="";
            for($i==1; $i<=strlen(trim($ProductName)); $i++ )
            {
                $j=$j+1;
                $SingleChar=substr($ProductName,$i,1);
                $Club.=$SingleChar;
                if($j==8){
                    $Club.=" ";
                    $j=0;
                }

            }
            $ProductName=$Club;
            $fyid=$row[9];
            $Rate=$row[10];
            $Quantity=$row[11];

            $CreationDate=$row[12];
            $Creator=$row[13];
            $ip=$row[14];
            $vmid=$row[15];
            $caid=$row[16];
            $cnid=$row[17];
            $pmid=$row[18];

            $UserName=$row[19];
            $FinancialYear=$row[20];

            $ConsigneeArea=$row[21];

            $AdditionalCharges=Get_AdditionalCharges($con, $lrid);
            $Split_AdditionalCharges = explode(",", $AdditionalCharges);
            // 0 - Road Expense (Road Exp.)
            // 1 - Bilty Charges (B. C.)
            // 2 - PhotocopyCharges (Xerox)
            // 3 - Warai (Warai)
            // 4 - Goods Return
            // 5 - Delivery Charges
            // 6 - Insurance
            // 7 - Product Charges

//            echo("AdditionalCharges :- $AdditionalCharges </br>");
//            die();

?>

<page size="A5" layout="portrait">

    <div class="top-headername text-center">
        <h2 class="no-margin-top">Time To Time</h2>
        <h1 class="no-margin-top">Shree Vighnahar Logistics</h1>
        <p> Shed No.1, Gala No.1, Arihant Complex, Kopar Bus Stop, Purna Village, Bhiwandi, Dist:-Thane-421302.</p>
    </div>
    <div class="top-headerdetails">
        <div class="table-responsive">
            <div class="Chalan-details1">
                <P>L.R.NO.</P>
                <P>LR Type</P>
                <P>party bill no</P>
            </div>
            <div class="Chalan-details2">
                <P>: <?php echo $lrid;?></P>
                <P>: TBB</P>
                <P>: <?php echo $InvoiceNo;?></P>
            </div>
            <div class="Chalan-details3"> </div>
            <div class="Chalan-details4">
                <P>Date</P>
                <P>From</P>
                <P>To</P>
            </div>
            <div class="Chalan-details5">
                <P>: <?php echo $TransitDate; ?></P>
                <P>: Bhiwandi</P>
                <P>: <?php echo $ConsigneeArea; ?></P>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table>
            <col style="width:22%">
            <col style="width:21%">
            <col style="width:11%">
            <col style="width:9%">
            <col style="width:7%">
            <col style="width:13%">
            <col style="width:15%">
            <thead>
            <tr>
                <th >Consignor</th>
                <th >Consignee</th>
                <th >Products</th>
                <th >Weight</th>
                <th >Qty</th>
                <th >Rate</th>
                <th >Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td rowspan="9"><?php echo $ConsignorName; ?></td>
                <td rowspan="9"><?php echo $ConsigneeName; ?></td>
                <td rowspan="9"><?php echo $ProductName; ?></td>
                <td align="right" rowspan="9">0</td>
                <td align="right" rowspan="9"><?php echo $Quantity; ?></td>
                <td align="right"><?php echo $Rate; ?></td>
                <td align="right"><?php echo $Split_AdditionalCharges[7]; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>


            <tr>
                <td>B.C.</td>
                <td align="right"><?php echo $Split_AdditionalCharges[1]; ?> </td>
            </tr>
            <tr>
                <td>Xerox</td>
                <td align="right"><?php echo $Split_AdditionalCharges[2]; ?></td>
            </tr>
            <tr>
                <td>Road Exp.</td>
                <td align="right"><?php echo $Split_AdditionalCharges[0]; ?></td>
            </tr>
            <tr>
                <td>Warai</td>
                <td align="right"><?php echo $Split_AdditionalCharges[3]; ?></td>
            </tr>
            <tr>
                <td>Lb./Misc.</td>
                <?php
                    $Misc=0;
                    $Misc=$Split_AdditionalCharges[4]+$Split_AdditionalCharges[5]+$Split_AdditionalCharges[6];
                    $Misc=number_format((float)$Misc, 2, '.', '');
                ?>
                <td align="right"><?php echo $Misc; ?></td>
            </tr>
            <tr>
                <td></td>
                <td align="right"></td>
            </tr>

            <tr>
                <td><b>Total Amt.</b></td>
                <?php
                    $Total=0;
                    $Total=round(($Split_AdditionalCharges[0]+$Split_AdditionalCharges[1]+$Split_AdditionalCharges[2]+$Split_AdditionalCharges[3]+$Split_AdditionalCharges[4]+$Split_AdditionalCharges[5]+$Split_AdditionalCharges[6]+$Split_AdditionalCharges[7]),2);
                    $Total=number_format((float)$Total, 2, '.', '');
                ?>
                <td align="right"><b><?php echo $Total; ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="footerdetails">
        <div class="footertext">
            <P>All disputes enquiries and complaints or the receipt to be paid refunded to above office within seven days no claim shall be entertained after that. No claim shall be entertained due to loss in accident or any natural calamity and liquid materials glass chinware paper and plastic packing goods. Goods are booked at owners risk. We carry at your risk only.</P>
        </div>
        <div class="footersign">
            <P>For shree vignahar logistics</P>
        </div>
    </div>
</page>
</body>
<?
}
    }
        else{
        echo("LR No. does not exit. Please check......");
        die();
    }