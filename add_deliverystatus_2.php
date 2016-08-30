<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>
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
        $columnname="DeliveryStatus like";
        $pre_wildcharacter="%";
        $post_wildcharacter="%";
    }
?>


<!-- Single row selection -->

    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>Delivery Status</th>
            <th>Creation Date</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $cols="dsid, CreationDate, ModificationDate, Creator, ip, DeliveryStatus, Active";
        $sqlQry= "select $cols from `deliverystatus_master`";
        $sqlQry = $sqlQry . " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry= $sqlQry." and Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                    $dsid=$row[0];
                    $CreationDate=$row[1];
                    $CreationDate=substr($CreationDate,0,strpos($CreationDate," "));
                    $ModificationDate=$row[2];
                    $Creator=$row[3];
                    $ip=$row[4];
                    $DeliveryStatus=$row[5];
                    $Active=$row[6];
                ?>
                <tr>
                    <td><a href="#" onclick="return editdeliverystatus(<?php echo $dsid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $DeliveryStatus; ?>', '<?php echo $Active; ?>');"><?php echo $DeliveryStatus; ?></a> </td>
                    <td><?php echo $CreationDate; ?></td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>

<!-- /single row selection -->