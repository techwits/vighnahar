<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/components_dropdowns.js"></script>
<!-- /theme JS files -->

<?php
//    sec_session_start();
?>

<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');
//    echo("Session User ID :-". _SessionUserID_."</br>");
//    echo("Session User IP :-". _SessionIP_."</br>");
?>

<!-- Single row selection -->

<div class="content">

    <!-- Editable inputs -->
    <div class="panel panel-flat">
            <table class="table datatable-basic" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>RMID</th>
                    <th>Transit Date</th>
                    <th>Vehicle Number</th>
                    <th>Driver Name</th>
                    <th>LRID</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                        $UndeliveryReason=Fill_UndeliveryReason($con);
//                        echo("UndeliveryReason :- $UndeliveryReason </br>");
//                        die();
                        $cols="`outward`.oid, `outward`.CreationDate, `outward`.ModificationDate, `outward`.Creator, `outward`.ip, `outward`.TransitDate, `outward`.fyid, `outward`.vmid, `outward`.tmid, `outward`.Active ";
                        $cols.=", `outwardlr`.iid";
                        $cols.=", `vehicle_master`.VehicleNumber";
                        $cols.=", `transporter_master`.TransporterName";
                        $cols.=", `outwardlr`.RMStatus, `outwardlr`.olrid";

                        $sqlQry= "select $cols from `outward`";

                        $sqlQry.= " inner join `outwardlr`";
                        $sqlQry.= " on outward.oid=outwardlr.oid";

                        $sqlQry.= " inner join `vehicle_master`";
                        $sqlQry.= " on outward.vmid=vehicle_master.vmid";

                        $sqlQry.= " inner join `transporter_master`";
                        $sqlQry.= " on outward.tmid=transporter_master.tmid";

                        $sqlQry.= " where 1=1";
                        $sqlQry.= " and `outwardlr`.Bill=0";
                        $sqlQry.= " and `outward`.Active=1";
                        $sqlQry.= " and `outwardlr`.Active=1";

                        $sqlQry.= " order by `outward`.oid desc";
//                        $sqlQry.= " and `outwardlr`.Active=1";
//                        $sqlQry.= " and `outwardlr`.dsid=1";
//                        echo ("Check sqlQry :- $sqlQry </br>");
            //            die();
                        unset($con);
                        include('assets/inc/db_connect.php');
                        $result = mysqli_query($con, $sqlQry);
                        if (mysqli_num_rows($result)!=0)
                        {
                            $i=0;
                            $div_name="";
                            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
                            {
                                $i+=1;

                                $oid=$row[0];
                                $CreationDate=$row[1];
                                $CreationDate=substr($CreationDate,0,strpos($CreationDate," "));
                                $ModificationDate=$row[2];
                                $Creator=$row[3];
                                $ip=$row[4];
                                $Transitdate=$row[5];
                                $fyid=$row[6];
                                $vmid=$row[7];
                                $tmid=$row[8];
                                $Active=$row[9];

                                $LRID=$row[10];
                                $VehicleNumber=$row[11];
                                $TransporterName=$row[12];

                                $RMStatus=$row[13];
                                $olrid=$row[14];

//                                echo("RMStatus :- $RMStatus </br>");
//                                echo("olrid :- $olrid </br>");

                                $LRRate_LRQuantityCount=Get_LRRate_LRQuantityCount($con, $LRID);
                                $Split_LRRate_LRQuantityCount = explode(",", $LRRate_LRQuantityCount);
                                $LRRate=$Split_LRRate_LRQuantityCount[0];
                                $LRQuantityCount=$Split_LRRate_LRQuantityCount[1];

                                
                                $div_name="div".$i;




                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $oid; ?></td>
                                        <td><?php echo $Transitdate; ?></td>
                                        <td><?php echo $VehicleNumber; ?></td>
                                        <td><?php echo $TransporterName; ?></td>
                                        <td><span class="badge bg-danger"><?php echo $LRID; ?></span></td>

                                        <?php
                                                if($RMStatus==0)
                                                {
                                        ?>
                                                        <td class="text-center">
                                                            <div id="<?php echo $div_name; ?>">
                                                                <li class="dropdown">
                                                                    <a href="#" class="label bg-info-400 dropdown-toggle" data-toggle="dropdown">Update <span class="caret"></span></a>
                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                        <li><a href="#"
                                                                               onclick="return updateRMStatus('<?php echo $i; ?>', '<?php echo _SessionUserID_; ?>', '<?php echo _SessionIP_; ?>' , '<?php echo $oid; ?>', '<?php echo $LRID; ?>', '2', '0', '<?php echo $LRRate; ?>', '<?php echo $LRQuantityCount; ?>');">Delivered</a>
                                                                        </li>
                                                                        <li class="dropdown-submenu dropdown-submenu-left">
                                                                            <a href="#">UnDelivered</a>
                                                                            <ul class="dropdown-menu dropdown-menu-xs">
                                                                                <?php
                                                                                $Split_UndeliveryReason = explode("||", $UndeliveryReason);
                                                                                foreach ($Split_UndeliveryReason as $SingleUndeliveryReason) {
                                                                                    $Split_SingleUndeliveryReason = explode("~", $SingleUndeliveryReason);
                                                                                    ?>
                                                                                    <li><a href="#"
                                                                                           onclick="return updateRMStatus('<?php echo $i; ?>', '<?php echo _SessionUserID_; ?>', '<?php echo _SessionIP_; ?>', '<?php echo $oid; ?>', '<?php echo $LRID; ?>', '3', '<?php echo $Split_SingleUndeliveryReason[0]; ?>', '<?php echo $LRRate; ?>', '<?php echo $LRQuantityCount; ?>' );"><?php echo $Split_SingleUndeliveryReason[1]; ?></a>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                        </li>
                                                                        <li><a href="#"
                                                                               onclick="return updateRMStatus('<?php echo $i; ?>', '<?php echo _SessionUserID_; ?>', '<?php echo _SessionIP_; ?>' , '<?php echo $oid; ?>', '<?php echo $LRID; ?>', '4', '0', '<?php echo $LRRate; ?>', '<?php echo $LRQuantityCount; ?>');">Wrong LR Entry</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>


                                                            </div>
                                                        </td>
                                            <?php
                                                    }
                                                    elseif($RMStatus==2){
                                                        ?>
                                                        <td class="text-center">
                                                            <div id="<?php echo $div_name; ?>">
                                                                <a href="#" onclick="rmstatusreverse('<?php echo _SessionUserID_; ?>', '<?php echo _SessionIP_; ?>', '<?php echo $div_name; ?>', '<?php echo $olrid; ?>', '<?php echo $RMStatus; ?>');"><span class="label label-success">Delivered</span></a>
                                                             </div>
                                                        </td>
                                                        <?php
                                                    }
                                                    elseif($RMStatus==3){
                                                        ?>
                                                        <td class="text-center">
                                                            <div id="<?php echo $div_name; ?>">
                                                                <a href="#" onclick="rmstatusreverse('<?php echo _SessionUserID_; ?>', '<?php echo _SessionIP_; ?>', '<?php echo $div_name; ?>', '<?php echo $olrid; ?>', '<?php echo $RMStatus; ?>');"><span class="label label-danger">Undelivered</span></a>
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                                    elseif($RMStatus==4){
                                                        ?>
                                                        <td class="text-center">
                                                            <div id="<?php echo $div_name; ?>">
                                                                <a href="#" onclick="rmstatusreverse('<?php echo _SessionUserID_; ?>', '<?php echo _SessionIP_; ?>', '<?php echo $div_name; ?>', '<?php echo $olrid; ?>', '<?php echo $RMStatus; ?>');"><span class="label label-warning">Wrong LR Entry</span></a>
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                            ?>
                                    </tr>
                                    <?php





                            }
                        }
                    ?>


                </tbody>
            </table>
        </div>
        <!-- /editable inputs -->

    </div>
    <!-- /content area -->

<!-- /single row selection -->