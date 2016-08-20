<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/core.css" rel="stylesheet" type="text/css">
<link href="assets/css/components.css" rel="stylesheet" type="text/css">
<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/datatables_api.js"></script>
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
            <th>Name</th>
            <th>Telephone</th>
            <th>Email</th>
            <th class="text-center">Actions</th>
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
            $sqlQry.= " and $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        }
        $sqlQry.=" and `pageaccess_member`.Active=1";
        $sqlQry.=" order by `pageaccess_member`.menusub_id";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
//        include('assets/inc/common-function.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
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
                    <td>12</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                    <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                                    <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>

<!-- /single row selection -->