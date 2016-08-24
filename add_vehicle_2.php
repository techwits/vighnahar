<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>
<!-- /theme JS files -->

<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $searchvalue="";
    $searchin=1;
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
        $columnname="VehicleNumber like";
        $pre_wildcharacter="%";
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
            <th>Vehicle Number</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $cols="vehicle_master.vmid, vehicle_master.CreationDate, vehicle_master.ModificationDate, vehicle_master.Creator, vehicle_master.ip, vehicle_master.void, vehicle_master.VehicleName, vehicle_master.VehicleNumber, vehicle_master.RCBookNumber, vehicle_master.Active, ";
        $cols.=" vehicleownership_master.Ownership, ";
        $cols.=" vehicle_master.RegistrationYear, vehicle_master.PermitNo, vehicle_master.PermitExpiry, vehicle_master.InsuranceNo, vehicle_master.InsuranceExpiry ";

        $sqlQry= "select $cols from `vehicle_master`";
        $sqlQry.= " inner join vehicleownership_master";
        $sqlQry.= " on vehicle_master.void = vehicleownership_master.void";
        $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry.= " and vehicle_master.Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
//        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {

                $Permit_newDate="";
                $Insurance_newDate="";


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

                $RegistrationYear=$row[11];
                $PermitNo=$row[12];
                $PermitExpiry=$row[13];
//                echo("PermitExpiry :- $PermitExpiry </br>");
//                die();
                if(strlen(trim($PermitExpiry))>0 and $PermitExpiry!="0000-00-00"){
                    $Permit_oldDate = $PermitExpiry;
//                    $Permit_OldDate_Valid=validateDate($Permit_oldDate);
//                    if($Permit_OldDate_Valid<>1){
//                        echo("Entered Permit Date is invalid. Please check..........");
//                        die();
//                    }
                    $Permit_arr = explode('-', $Permit_oldDate);
                    $Permit_newDate = $Permit_arr[2].'/'.$Permit_arr[1].'/'.$Permit_arr[0];
//                    echo("PermitExpiry :- $Permit_newDate </br>");
                }

                $InsuranceNo=$row[14];
                $InsuranceExpiry=$row[15];
//                echo("InsuranceExpiry :- $InsuranceExpiry </br>");
                if(strlen(trim($InsuranceExpiry))>0 and $InsuranceExpiry!="0000-00-00"){
                    $Insurance_oldDate = $InsuranceExpiry;
//                    $Insurance_OLDDate_Valid=validateDate($Insurance_oldDate);
//                    if($Insurance_OLDDate_Valid<>1){
//                        echo("Entered Insurance Date is invalid. Please check..........");
//                        die();
//                    }
                    $Insurance_arr = explode('-', $Insurance_oldDate);
                    $Insurance_newDate = $Insurance_arr[2].'/'.$Insurance_arr[1].'/'.$Insurance_arr[0];
                }

                ?>
                <tr>
                    <td><a href="#" onclick="return editvehicle(<?php echo $vmid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $void; ?>', '<?php echo $VehicleOwnershipName; ?>', '<?php echo $VehicleName; ?>', '<?php echo $VehicleNumber; ?>', '<?php echo $RCBookNumber; ?>', '<?php echo $Active; ?>', '<?php echo $RegistrationYear; ?>', '<?php echo $PermitNo; ?>', '<?php echo $Permit_newDate; ?>', '<?php echo $InsuranceNo; ?>', '<?php echo $Insurance_newDate; ?>');"><?php echo $VehicleNumber; ?></a> </td>
                    <td><?php echo $VehicleName; ?></td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
<!-- /single row selection -->