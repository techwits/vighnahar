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
        $columnname="ContactName like";
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
            <th>Creation Date</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $cols="ctmid, CreationDate, ModificationDate, Creator, ip, ContactName, Active ";
        $sqlQry= "select $cols from `contacttype_master`";
        $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry.= " and Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                $ctmid=$row[0];
                $CreationDate=$row[1];
                $CreationDate=substr($CreationDate,0,strpos($CreationDate," "));
                $ModificationDate=$row[2];
                $Creator=$row[3];
                $ip=$row[4];
                $ContactName=$row[5];
                $Active=$row[6];
                ?>
                <tr>
                    <td><a href="#" onclick="return editcontacttype(<?php echo $ctmid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $ContactName; ?>', '<?php echo $Active; ?>');"><?php echo $ContactName; ?></a> </td>
                    <td><?php echo $CreationDate;?></td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
<!-- /single row selection -->