<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<?php

    $CYear=date("Y");
    $CMonth=date("m");
    if($CMonth<4){
        $CYear=$CYear-1;
    }
    $FinancialYear=Get_FinancialYear($con, $CYear);
//    echo("FinancialYear :- $FinancialYear </br>");

?>

<!-- Single row selection -->
<table class="table datatable-basic" width="100%">
        <thead>
        <tr>
            <th>Sr.No</th>
            <th>Consignor Name</th>
            <th>Last Bill Date</th>
            <th>Last Bill Amount</th>
            <th>FY Bill Amount</th>
            <th>Overall Dues</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $cols=" bill.caid, sum(bill.BillAmount) ";
        $sqlQry  = "select $cols from `bill`";

//        $sqlQry.=" inner join billlr";
//        $sqlQry.=" on bill.bid=billlr.bid";

        $sqlQry.=" where 1=1";
        $sqlQry.=" and bill.Active =1";
//        $sqlQry.=" and billlr.Active =1";
        $sqlQry.=" Group By bill.caid";
        $sqlQry.=" Order By bill.caid";

//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        $inc=0;
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0){
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                $inc=$inc+1;
                $caid=$row[0];
                $BillAmount=$row[1];
                $ConsignorName=Get_ConsignorName($con, $caid);

                $LastBillDate="";
                $LastBillAmount=0;
                $Consignor_LastBillGeneratedDetails="";
                $Consignor_LastBillGeneratedDetails=Get_Consignor_LastBillGeneratedDetails($con, $caid);
//                echo ("Consignor_LastBillGeneratedDetails :- $Consignor_LastBillGeneratedDetails </br>");
                if(strlen(trim($Consignor_LastBillGeneratedDetails))>0){
                    $Split_Consignor_LastBillGeneratedDetails = explode("|", $Consignor_LastBillGeneratedDetails);
                    $LastBillDate=$Split_Consignor_LastBillGeneratedDetails[0];
                    $LastBillAmount=$Split_Consignor_LastBillGeneratedDetails[1];
                }

                $Consignor_FinancialYear_BillAmount=Get_Consignor_FinancialYear_BillAmount($con, $caid, $FinancialYear);
                $Receipt=0;
                $Receipt=Get_Receipt($con, $caid);
//                echo("BillAmount :- $BillAmount </br>");
//                echo("Receipt :- $Receipt </br>");
                $OverallDue=0;
                $OverallDue=$BillAmount-$Receipt;
//                echo("OverallDue :- $OverallDue </br>");
                ?>
                    <tr>
                        <td><?php echo $inc; ?></td>
                        <td><?php echo $ConsignorName; ?></td>
                        <td><?php echo $LastBillDate; ?></td>
                        <td><?php echo $LastBillAmount; ?></td>
                        <td><?php echo $Consignor_FinancialYear_BillAmount; ?></td>
                        <td><?php echo $OverallDue; ?></td>
                        <td align="center">
                            <div id="<?php echo $inc;?>">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-circle-down2"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                            <li><a href="#modal_full" data-toggle='modal' class='modalButton' data-teacherid="<?php echo $caid; ?>"><i class=" icon-pencil7"></i>Receipt</a></li>

                                            <li class="divider"></li>
                                            <li><a href="#" onclick="return deletelrentry('<?php echo _session_userid_?>', '<?php echo _session_ip_?>', <?php echo $lrid; ?>, <?php echo $inc;?>, <?php echo $LRIDExist_ForRM; ?>);"><i class="icon-cross"></i> Delete</a></li>
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
<!-- /single row selection -->

<!-- Modal -->
<div id="modal_full" class="modal fade" style="font-weight: normal;">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php header("refresh:0; url=billstatus.php"); ?>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    $('.modalButton').click(function(){
        var teacherid = $(this).attr('data-teacherid');
//        var LRNumber=document.getElementById("show_lrno").value;
        $.ajax({url:"receipt.php?caid="+teacherid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
</script>
