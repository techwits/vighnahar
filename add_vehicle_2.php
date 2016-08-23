<!-- Theme JS files -->
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
        $columnname="VehicleName like";
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
        $cols="vehicle_master.vmid, vehicle_master.CreationDate, vehicle_master.ModificationDate, vehicle_master.Creator, vehicle_master.ip, vehicle_master.void, vehicle_master.VehicleName, vehicle_master.VehicleNumber, vehicle_master.RCBookNumber, vehicle_master.Active, ";
        $cols.=" vehicleownership_master.Ownership ";
        $sqlQry= "select $cols from `vehicle_master`";
        $sqlQry.= " inner join vehicleownership_master";
        $sqlQry.= " on vehicle_master.void = vehicleownership_master.void";
        $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry.= " and vehicle_master.Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                $vmid=$row[0];
                $CreationDate=$row[1];
                $ModificationDate=$row[2];
                $Creator=$row[3];
                $ip=$row[4];
                $void=$row[5];
                $VehicleName=$row[6];
                $VehicleNumber=$row[7];
                $RCBookNumber=$row[8];
                $Active=$row[9];
                $VehicleOwnershipName=$row[10];
                ?>
                <tr>
                    <td><a href="#" onclick="return editvehicle(<?php echo $void; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $void; ?>', '<?php echo $VehicleOwnershipName; ?>', '<?php echo $VehicleName; ?>', '<?php echo $VehicleNumber; ?>', '<?php echo $RCBookNumber; ?>', '<?php echo $Active; ?>');"><?php echo $VehicleName; ?></a> </td>
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