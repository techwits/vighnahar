<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
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

    $session_userid = sanitize($con, $_REQUEST["session_userid"]);
    $session_ip = sanitize($con, $_REQUEST["session_ip"]);
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
    $columnname="bid = ";
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
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
    <div class="datatable-scroll">
        <table class="table datatable-basic">
            <input type="hidden" name="session_userid" id="session_userid" value="<?php echo $session_userid; ?>">
            <input type="hidden" name="session_ip" id="session_ip" value="<?php echo $session_ip; ?>">
            <thead>
            <tr>
                <th>Bill No.</th>
                <th>Financial year</th>
                <th>Bill Date</th>
                <th>Consignor Name</th>
                <th>Discount</th>
                <th>Bill Amount</th>
            </tr>
            </thead>
            <tbody>

            <?php
                $cols="bid, CreationDate, ModificationDate, Creator, ip, fyid, BillingDate, caid, Amount, Discount, ServiceTax, BillAmount, Active ";
                $sqlQry= "select $cols from `bill`";
                $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
                $sqlQry.= " and Active=1";
//                echo ("Check sqlQry :- $sqlQry </br>");
//                die();
                include('assets/inc/db_connect.php');
                $result = mysqli_query($con, $sqlQry);
                if (mysqli_num_rows($result)!=0)
                {
                    while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
                    {
                        $bid=$row[0];
                        $CreationDate=$row[1];
                        $ModificationDate=$row[2];
                        $Creator=$row[3];
                        $ip=$row[4];
                        $fyid=$row[5];
                        $BillingDate=$row[6];
                        $caid=$row[7];
                        $Amount=$row[8];
                        $Discount=$row[9];
                        $ServiceTax=$row[10];
                        $BillAmount=$row[11];
                        $Active=$row[12];

                        $FinancialYearOnID=Get_FinancialYearOnID($con, $fyid);
//                        echo("FinancialYearOnID :- $FinancialYearOnID </br>");
                        $ConsignorName=Get_ConsignorName($con, $caid);
//                        echo("ConsignorName :- $ConsignorName </br>");

                        ?>
                        <tr>
                            <td>
                                <div id="<?php echo $bid;?>">
                                    <a href="#" onclick="return delete_bill(<?php echo $bid; ?>);"><?php echo $bid; ?></a>
                                </div>
                            </td>
                            <td><?php echo $FinancialYearOnID; ?></td>
                            <td><?php echo $BillingDate; ?></td>
                            <td><?php echo $ConsignorName; ?></td>
                            <td><?php echo $Discount; ?></td>
                            <td><?php echo $BillAmount; ?></td>
                        </tr>
                        <?php
                    }
                }
            ?>

            </tbody>
        </table>
     </div>
 </div>
<!-- /single row selection -->