<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>
<!-- /theme JS files -->
<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $searchvalue="";
    if(isset($_REQUEST["searchvalue"])) {
        include_once('assets/inc/db_connect.php');
        include_once('assets/inc/common-function.php');

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

        $columnname="menusub_id = ";
        $pre_wildcharacter="";
        $post_wildcharacter="";
    }
    elseif ($searchin==2){
        $columnname="designation_id = ";
        $pre_wildcharacter="";
        $post_wildcharacter="";
    }
//        echo ("CurrentDate:- ".$CurrentDate."</br>");
//        echo ("searchvalue:- ".$searchvalue."</br>");
//        die();
?>




<!-- Single row selection -->

    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>Page Name</th>
            <th>Designation</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $cols="`pageaccess_member`.id, `pageaccess_member`.CreationDate, `pageaccess_member`.ModificationDate, `pageaccess_member`.Creator, `pageaccess_member`.ip, `pageaccess_member`.menusub_id, `1menusub`.`url`, designation_id, `designation_master`.`Designation`, `pageaccess_member`.Active";
        $sqlQry= "select $cols from `pageaccess_member` ";
        $sqlQry.= " left join 1menusub ";
        $sqlQry.= " on `pageaccess_member`.`menusub_id` = `1menusub`.`menusub_id`";
        $sqlQry.= " left join designation_master ";
        $sqlQry.= " on  `pageaccess_member`.`designation_id` = `designation_master`.`designationid` ";
        $sqlQry.= " where 1=1 ";
        if (strlen($searchvalue)>0) {
//            $sqlQry.= " and $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
            if ($searchin==1){
                $sqlQry.= " and 1menusub.url like '$searchvalue%' ";
            }
            elseif ($searchin==2){
                $sqlQry.= " and designation_master.Designation like '$searchvalue%' ";
            }
        }
        $sqlQry.=" and `pageaccess_member`.Active=1";
        $sqlQry.=" order by `pageaccess_member`.menusub_id";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        include('assets/inc/db_connect.php');
//        include('assets/inc/common-function.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0){
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                $id=$row[0];
                $CreationDate=$row[1];
                $ModificationDate=$row[2];
                $Creator=$row[3];
                $ip=$row[4];
                $menusub_id=$row[5];
                $PageName=$row[6];
                $designation_id=$row[7];
                $LoginName=$row[8];
                $Active=$row[9];
                ?>
                    <tr>
                        <td><a href="#" onclick="return editpageaccess(<?php echo $id; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $menusub_id; ?>', '<?php echo $PageName; ?>', '<?php echo $designation_id; ?>', '<?php echo $LoginName; ?>', '<?php echo $Active; ?>');"><?php echo $PageName; ?></a> </td>
                        <td><?php echo $LoginName; ?></td>
                    </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
<!-- /single row selection -->