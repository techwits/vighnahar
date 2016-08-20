<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
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
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/datatables_api.js"></script>
<!-- /theme JS files -->



<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $searchvalue="";
    if(isset($_REQUEST["searchvalue"])) {
        include('assets/inc/db_connect.php');
        include('assets/inc/common-function.php');

        $searchvalue = sanitize($con, $_REQUEST["searchvalue"]);
        $searchin = sanitize($con, $_REQUEST["searchin"]);
    }

    if (strlen($searchvalue)==0){
        $searchvalue="";
        $searchin=1;
        $TableHeading="Last Top 5 Records..";
    }
    else{
        $TableHeading=$searchvalue." Results..";
    }

    $columnname="";
    $pre_wildcharacter="";
    $post_wildcharacter="";
    if ($searchin==1){
        $columnname="ConsignorName like";
        $pre_wildcharacter="";
        $post_wildcharacter="%";
    }
//    elseif ($searchin==2){
//        $columnname="Telephone like";
//        $pre_wildcharacter="%";
//        $post_wildcharacter="%";
//    }
    //    echo ("CurrentDate:- ".$CurrentDate."</br>");
    //    echo ("searchvalue:- ".$searchvalue."</br>");
    //    die();
?>




<!-- Single row selection -->
    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>Name</th>
            <th>Telephone</th>
            <th>Email</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $cols="`consignor_master`.`cid`, `consignor_master`.`ConsignorName`, `consignor_master`.`PanCard`, ";
        $cols.="`consignoraddress_master`.`caid`, `consignoraddress_master`.`Address`, `consignoraddress_master`.`Pincode`, `consignoraddress_master`.`City`, ";
        $cols.="`consignorcontact_master`.`ccid`, `consignorcontact_master`.`ctmid`, `consignorcontact_master`.`Contact`, `consignorcontact_master`.`PrimaryContact`, ";
        $cols.="`consignorproduct_master`.`cpid`, `consignorproduct_master`.`pmid`, ";
        $cols.=" `consignoraddress_master`.`amid`, `area_master`.`AreaName`";


        $sqlQry= " select $cols from `consignor_master` ";
        $sqlQry.= " inner join `consignoraddress_master`";
        $sqlQry.= " on `consignor_master`.`cid`=`consignoraddress_master`.`cid`";

        $sqlQry.= " inner join `consignorcontact_master`";
        $sqlQry.= " on `consignoraddress_master`.`caid`=`consignorcontact_master`.`caid`";

        $sqlQry.= " inner join `consignorproduct_master`";
        $sqlQry.= " on `consignoraddress_master`.`caid`=`consignorproduct_master`.`caid`";

        $sqlQry.= " inner join `area_master`";
        $sqlQry.= " on `consignoraddress_master`.`amid`=`area_master`.`amid`";


        $sqlQry.= " where 1=1";
        $sqlQry.= " and $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry.= " and `consignor_master`.Active=1";
        echo ("Check sqlQry :- $sqlQry </br>");
        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                $cnid=$row[0];
                $ConsigneeName=$row[1];
                $Website=$row[2];
                $cnaid=$row[3];
                $Address=$row[4];
                $Pincode=$row[5];
                $City=$row[6];
                $Telephone=$row[7];
                $Email=$row[8];

                ?>

                <tr>
                    <td><a href="#" onclick="return editconsignee(<?php echo $cnid; ?>, '<?php echo $ConsigneeName; ?>', '<?php echo $Website; ?>', '<?php echo $cnaid; ?>', '<?php echo $Address; ?>', '<?php echo $Pincode; ?>', '<?php echo $City; ?>', '<?php echo $Telephone; ?>', '<?php echo $Email; ?>');"><?php echo $ConsigneeName; ?></a> </td>
                    <td>Sachin</td>
                    <td>12</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                    <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                                    <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>

<!-- /single row selection -->