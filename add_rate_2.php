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
        $columnname="consignor_master.ConsignorName like ";
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
            <th>Consignor</th>
            <th>Consignee</th>
            <th>Product</th>
            <th>Rate</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $cols="`rate_master`.rmid, `rate_master`.CreationDate, `rate_master`.ModificationDate, `rate_master`.Creator, `rate_master`.ip, `rate_master`.caid, `rate_master`.cnid, `rate_master`.pmid, `rate_master`.MinimumRate, `rate_master`.CartoonRate, `rate_master`.ItemRate, `rate_master`.Active, ";
        $cols.=" `consignor_master`.`ConsignorName`, ";
        $cols.=" `product_master`.`ProductName`, ";
        $cols.=" `consignee_master`.`ConsigneeName` ";

        $sqlQry= "select $cols from `rate_master`";

        $sqlQry.=" left join consignoraddress_master";
        $sqlQry.=" on rate_master.caid = consignoraddress_master.caid ";

        $sqlQry.=" inner join consignor_master ";
        $sqlQry.=" on consignoraddress_master.cid = consignor_master.cid ";

        $sqlQry.=" inner join consignee_master ";
        $sqlQry.=" on rate_master.cnid = consignee_master.cnid ";

        $sqlQry.=" inner join product_master ";
        $sqlQry.=" on rate_master.pmid = product_master.pmid ";

        $sqlQry.= " where 1=1";

        if ($searchin==1) {
            $sqlQry.= " and consignor_master.ConsignorName like '$searchvalue%'";
        }
        elseif ($searchin==2) {
            $sqlQry.= " and consignee_master.ConsigneeName like '$searchvalue%'";
        }
        elseif ($searchin==3) {
            $sqlQry.= " and product_master.ProductName like '$searchvalue%'";
        }
        
        $sqlQry.= " order by `consignor_master`.`ConsignorName` ";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                    $rmid=$row[0];
                    $CreationDate=$row[1];
                    $ModificationDate=$row[2];
                    $Creator=$row[3];
                    $ip=$row[4];
                    $caid=$row[5];
                    $cnid=$row[6];
                    $pmid=$row[7];
                    $MinimumRate=$row[8];
                    $CartoonRate=$row[9];
                    $ItemRate=$row[10];
                    $Active=$row[11];
                    $ConsignorName=$row[12];
                    $ProductName=$row[13];
                    $ConsigneeName=$row[14];
                ?>
                <tr>
                    <td><a href="#" onclick="return editrate(<?php echo $rmid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $caid; ?>', '<?php echo $cnid; ?>', '<?php echo $pmid; ?>', '<?php echo $MinimumRate; ?>', '<?php echo $CartoonRate; ?>', '<?php echo $ItemRate; ?>', '<?php echo $Active; ?>', '<?php echo $ConsignorName; ?>', '<?php echo $ProductName; ?>', '<?php echo $ConsigneeName; ?>');"><?php echo $ConsignorName; ?></a> </td>
                    <td><?php echo $ConsigneeName; ?></td>
                    <td><?php echo $ProductName; ?></td>
                    <td><?php echo $CartoonRate.", ".$ItemRate; ?></td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>

<!-- /single row selection -->