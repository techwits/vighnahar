
<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

//    echo("session_userid :-". _session_userid_ ."</br>");
//    echo("session_ip :-". _session_ip_ ."</br>");
    $searchvalue="";
    if(isset($_REQUEST["searchvalue"])) {
        ?>
            <!-- Theme JS files -->
                <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
            <!-- /theme JS files -->
        <?php
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
        $columnname="LRID = ";
        $pre_wildcharacter="";
        $post_wildcharacter="";
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

<div class="panel panel-flat">

    <table class="table datatable-basic" width="100%">
        <thead>
        <tr>
            <th>LR No.</th>
            <th>Consignor</th>
            <th>Consignee</th>
            <th>Product</th>
            <th>Package Type</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>


            <?php
                $cols=" `inward`.LRID, `inward`.ReceivedDate, `inward`.InvoiceNumber, `inward`.PakageType, `inward`.Amount ";
                $cols.=" , `vehicle_master`.`VehicleNumber`";
                $cols.=" , `consignor_master`.`ConsignorName`";
                $cols.=" , `consignee_master`.`ConsigneeName`";
                $cols.=" , `product_master`.`ProductName`";
                $cols.=" , `inward`.fyid, `inward`.Rate, `inward`.Quantity";



                $sqlQry= "select $cols from `inward`";

                $sqlQry.= "inner join `vehicle_master`";
                $sqlQry.= "on `inward`.`vmid` = `vehicle_master`.`vmid`";

                $sqlQry.= "inner join `consignoraddress_master`";
                $sqlQry.= "on `inward`.`caid` = `consignoraddress_master`.`caid`";
                $sqlQry.= "inner join `consignor_master`";
                $sqlQry.= "on `consignoraddress_master`.`cid` = `consignor_master`.`cid`";

                $sqlQry.= "inner join `consignee_master`";
                $sqlQry.= "on `inward`.`cnid` = `consignee_master`.`cnid`";

                $sqlQry.= "inner join `product_master`";
                $sqlQry.= "on `inward`.`pmid` = `product_master`.`pmid`";

                $sqlQry.= " where 1=1";

                if($searchvalue!="") {
                    $sqlQry.= " and $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
                }

                $sqlQry.= " and `inward`.Active=1";
                $sqlQry.= " order by `inward`.LRID desc";
//                echo ("Check sqlQry :- $sqlQry </br>");
//                die();
                unset($con);
                include('assets/inc/db_connect.php');
                $result = mysqli_query($con, $sqlQry);
                if (mysqli_num_rows($result)!=0){
                    $inc=0;
                    while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                            $inc=$inc+1;
                            $lrid=$row[0];
                            $TransitDate=$row[1];
                            $InvoiceNo=$row[2];
                            $PakageType=$row[3];
                            $Amount=$row[4];
                            $VehicleNumber=$row[5];
                            $ConsignorName=$row[6];
                            $ConsigneeName=$row[7];
                            $ProductName=$row[8];

                            $FinancialYear=$row[9];
                            $Rate=$row[10];
                            $Quantity=$row[11];

                            $LRIDExist_ForRM=Check_LRIDExist_ForRM($con, $lrid);
//                            echo("$lrid) LRIDExist_ForRM :- $LRIDExist_ForRM </br>");
                        ?>

                            <tr>
                                <td><?php echo $lrid; ?></td>
                                <td><?php echo $ConsignorName; ?></td>
                                <td><?php echo $ConsigneeName; ?></td>
                                <td><?php echo $ProductName; ?></td>
                                <td><?php echo $PakageType; ?></td>
                                <td><?php echo $Amount; ?></td>
                                <td align="center">
                                    <div id="<?php echo $inc;?>">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-circle-down2"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                    <li><a href="#" onclick="return editlrentry(<?php echo $lrid; ?>, <?php echo $LRIDExist_ForRM; ?>);"><i class="icon-user-block"></i>Update</a></li>
                                                    <li><a href="#modal_full" data-toggle='modal' class='modalButton1' data-teacherid="<?php echo $lrid; ?>" > <i class="icon-user-block"></i> View</a></li>
                                                    <li><a href="#" onclick="return editlrentry(<?php echo $lrid; ?>, <?php echo $LRIDExist_ForRM; ?>);"><i class="icon-user-minus"></i> Print</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#" onclick="return deletelrentry('<?php echo _session_userid_?>', '<?php echo _session_ip_?>', <?php echo $lrid; ?>, <?php echo $inc;?>, <?php echo $LRIDExist_ForRM; ?>);"><i class="icon-embed"></i> Delete</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<!-- /single row selection -->

<!-- Modal -->
<div id="modal_full" class="modal fade" style="font-weight: normal;">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php header("refresh:0; url=lrentry_7.php"); ?>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    $('.modalButton1').click(function(){
        var teacherid = $(this).attr('data-teacherid');
        $.ajax({url:"display_LRDetails.php?LRID="+teacherid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
</script>
