<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>
<!-- /theme JS files -->



<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $searchvalue="";
    if(isset($_REQUEST["LRNO"])) {
        include('assets/inc/db_connect.php');
        include('assets/inc/common-function.php');
        $searchvalue = sanitize($con, $_REQUEST["LRNO"]);

        $ChargeName="Warai";
        $acmid=Get_acmid($con, $ChargeName);
        if($acmid==0){
            $error_msg.="Warai Charge ID is missing. Please check....";
            die();
        }

    }
?>


<!-- Single row selection -->

    <table class="table datatable-selection-single" style="background-color: #FFF700">
        <thead>
        <tr>
            <th>LR Id</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $cols="Amount";
        $sqlQry= "select $cols from `inwardcharge`";
        $sqlQry.=" where LRID=$searchvalue";
        $sqlQry.=" and acmid=$acmid";
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
                $Amount=$row[0];
                ?>
                <tr>
                    <td><?php echo $searchvalue; ?></td>
                    <td><?php echo $Amount; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>

<!-- /single row selection -->