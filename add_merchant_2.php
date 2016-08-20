<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/core.css" rel="stylesheet" type="text/css">
<link href="assets/css/components.css" rel="stylesheet" type="text/css">
<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

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
        $columnname="Company like";
        $pre_wildcharacter="";
        $post_wildcharacter="%";
    }
    elseif ($searchin==2){
        $columnname="Telephone like";
        $pre_wildcharacter="%";
        $post_wildcharacter="%";
    }
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
        $cols="`merchant_master`.mmid, `merchant_master`.CreationDate, `merchant_master`.ModificationDate, `merchant_master`.Creator, `merchant_master`.ip, `merchant_master`.Company, `merchant_master`.Address, `merchant_master`.amid, `merchant_master`.Pincode, `merchant_master`.City, `merchant_master`.Telephone, `merchant_master`.Email, `merchant_master`.Website, `merchant_master`.Pancard, `merchant_master`.Active";
        $cols.=" , `area_master`.`AreaName`";
        $sqlQry= "select $cols from `merchant_master`";
        $sqlQry.=" left join `area_master`";
        $sqlQry.=" on `merchant_master`.`amid`=`area_master`.`amid`";
        $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry.=" and `merchant_master`.Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                $mmid=$row[0];
                $CreationDate=$row[1];
                $ModificationDate=$row[2];
                $Creator=$row[3];
                $ip=$row[4];
                $Company=$row[5];
                $Address=$row[6];
                $amid=$row[7];
                $Pincode=$row[8];
                $City=$row[9];
                $Telephone=$row[10];
                $Email=$row[11];
                $Website=$row[12];
                $Pancard=$row[13];
                $Active=$row[14];
                $AreaName=$row[15];
        ?>
                <tr>
                    <td><a href="#" onclick="return editmerchant(<?php echo $mmid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $Company; ?>', '<?php echo $Address; ?>', '<?php echo $amid; ?>', '<?php echo $AreaName; ?>', '<?php echo $Pincode; ?>', '<?php echo $City; ?>', '<?php echo $Telephone; ?>', '<?php echo $Email; ?>', '<?php echo $Website; ?>', '<?php echo $Pancard; ?>', '<?php echo $Active; ?>');"><?php echo $Company; ?></a> </td>
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