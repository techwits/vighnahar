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
        $columnname="TransporterName like";
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
        </tr>
        </thead>
        <tbody>


        <?php
        $cols="transporter_master.tmid, transporter_master.CreationDate, transporter_master.ModificationDate, transporter_master.Creator, transporter_master.ip, transporter_master.TransporterName, transporter_master.Address, transporter_master.MobileNumber, transporter_master.LicenceNumber, transporter_master.Active ";
        $sqlQry= "select $cols from `transporter_master`";
        $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry.= " and transporter_master.Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                $tmid=$row[0];
                $CreationDate=$row[1];
                $ModificationDate=$row[2];
                $Creator=$row[3];
                $ip=$row[4];
                $TransporterName=$row[5];
                $Address=$row[6];
                $MobileNumber=$row[7];
                $LicenceNumber=$row[8];
                $Active=$row[10];
                ?>
                <tr>
                    <td><a href="#" onclick="return edittransporter(<?php echo $tmid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $TransporterName; ?>', '<?php echo $Address; ?>', '<?php echo $MobileNumber; ?>', '<?php echo $LicenceNumber; ?>', '<?php echo $Active; ?>');"><?php echo $TransporterName; ?></a> </td>
                    <td><?php echo $MobileNumber; ?></td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
<!-- /single row selection -->