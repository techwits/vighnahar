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
        $columnname="ChargeName like";
        $pre_wildcharacter="";
        $post_wildcharacter="%";
    }
?>

<!-- Single row selection -->
    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>Charge Name</th>
            <th>Percentage</th>
            <th>Fix</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $cols="acmid, CreationDate, ModificationDate, Creator, ip, ChargeName, ChargePercentage, ChargeFix, Active ";
            $sqlQry= "select $cols from `additionalcharge_master`";
            $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
            $sqlQry.= " and Active=1";
    //        echo ("Check sqlQry :- $sqlQry </br>");
    //        die();
            unset($con);
            include('assets/inc/db_connect.php');
            $result = mysqli_query($con, $sqlQry);
            if (mysqli_num_rows($result)!=0){
                while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                        $acmid=$row[0];
                        $CreationDate=$row[1];
                        $ModificationDate=$row[2];
                        $Creator=$row[3];
                        $ip=$row[4];
                        $ChargeName=$row[5];
                        $ChargePercentage=$row[6];
                        $ChargeFix=$row[7];
                        $Active=$row[8];
                    ?>
                        <tr>
                            <td><a href="#" onclick="return editadditionalcharge(<?php echo $acmid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $ChargeName; ?>', '<?php echo $ChargePercentage; ?>', '<?php echo $ChargeFix; ?>', '<?php echo $Active; ?>');"><?php echo $ChargeName; ?></a> </td>
                            <td><?php echo $ChargePercentage; ?></td>
                            <td><?php echo $ChargeFix; ?></td>
                        </tr>
                    <?php
                }
            }
        ?>
        </tbody>
    </table>
<!-- /single row selection -->