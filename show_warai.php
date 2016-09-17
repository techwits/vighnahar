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

        <?php
        $cols="Amount";
        $sqlQry= "select inwardcharge.Amount from `inwardcharge`  where LRID=$searchvalue  and acmid=$acmid and Active=1";
        $sqlQry.=" UNION ALL ";
        $sqlQry.=" select outwardlrbill.Amount from `outwardlrbill`  ";
        $sqlQry.= " inner join outwardlr ";
        $sqlQry.= " on outwardlr.olrid=outwardlrbill.olrid ";
        $sqlQry.= " where 1=1";
        $sqlQry.= " and outwardlr.iid=$searchvalue  ";
        $sqlQry.= " and acmid=$acmid";
        $sqlQry.= " and outwardlrbill.Active=1";

//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            ?>
            <table  class="table">
                <thead>
                <tr class="bg-blue">
                    <th>LR Id</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
            <?php
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
            ?>
                </tbody>
            </table>
            <?php
        }
        ?>
<!-- /single row selection -->