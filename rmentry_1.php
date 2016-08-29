<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<?php
$error_msg="";
$CurrentDate = date('Y-m-d h:i:s');
$lridlist="";
$searchvalue="";
if(isset($_REQUEST["Fill_LRIdList"])) {
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');

    $AddEdit = sanitize($con, $_REQUEST["AddEdit"]);
    $session_userid = sanitize($con, $_REQUEST["session_userid"]);
    $session_ip = sanitize($con, $_REQUEST["session_ip"]);

    $financialyear = sanitize($con, $_REQUEST["financialyear"]);
    $rmdate = sanitize($con, $_REQUEST["rmdate"]);
    $vehicleid = sanitize($con, $_REQUEST["vehicleid"]);
    $transporterid = sanitize($con, $_REQUEST["transporterid"]);
    $lridlist = sanitize($con, $_REQUEST["Fill_LRIdList"]);

//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("financialyear:- ".$financialyear."</br>");
//    echo ("rmdate:- ".$rmdate."</br>");
//    echo ("vehicleid:- ".$vehicleid."</br>");
//    echo ("transporterid:- ".$transporterid."</br>");
//    echo ("lridlist:- ".$lridlist."</br>");
//    die();
}


?>


<div class="col-sm-12 col-md-12 col-lg-12 col-lg-12">
    <!-- Scrollable datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Scrollable datatable</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <input type="hidden" name="AddEdit1" id="AddEdit1" value="<?php echo $AddEdit; ?>">
        <input type="hidden" name="session_userid1" id="session_userid1" value="<?php echo $session_userid; ?>">
        <input type="hidden" name="session_ip1" id="session_ip1" value="<?php echo $session_ip; ?>">

        <input type="hidden" name="financialyear1" id="financialyear1" value="<?php echo $financialyear; ?>">
        <input type="hidden" name="rmdate1" id="rmdate1" value="<?php echo $rmdate; ?>">
        <input type="hidden" name="vehicleid1" id="vehicleid1" value="<?php echo $vehicleid; ?>">
        <input type="hidden" name="transporterid1" id="transporterid1" value="<?php echo $transporterid; ?>">
        <input type="hidden" name="lridlist1" id="lridlist1" value="<?php echo $lridlist; ?>">

        <table class="table datatable-scroll-y" width="100%">
            <thead>
            <tr>
                <th>LR Number</th>
                <th>Invoice Number</th>
                <th>Consignor Name</th>
                <th>COnsignee Name</th>
                <th>Product Name</th>
                <th>Quantiry</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>

            <?php
                $cols="iid, CreationDate, ModificationDate, Creator, ip, LRID, fyid, ReceivedDate, InvoiceNumber, vmid, caid, cnid, pmid, PakageType, Rate, Quantity, Amount, Active";
                $sqlQry="";
                if(strlen(trim($lridlist))>0) {
                $sqlQry = "select $cols from `inward`";
                $sqlQry .= " where LRID in ($lridlist)";
                $sqlQry .= " and Active=1";
                $sqlQry .= " order by LRID";
//                echo ("Check sqlQry :- $sqlQry </br>");
//                die();
//                unset($con);
                include('assets/inc/db_connect.php');
                $result = mysqli_query($con, $sqlQry);
                if (mysqli_num_rows($result) != 0) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        $iid = $row[0];
                        $CreationDate = $row[1];
                        $CreationDate = substr($CreationDate, 0, strpos($CreationDate, " "));
                        $ModificationDate = $row[2];
                        $Creator = $row[3];
                        $ip = $row[4];
                        $LRID = $row[5];
                        $fyid = $row[6];
                        $ReceivedDate = $row[7];
                        $InvoiceNumber = $row[8];
                        $vmid = $row[9];
                        $caid = $row[10];
                        $cnid = $row[11];
                        $pmid = $row[12];
                        $PakageType = $row[13];
                        $Rate = $row[14];
                        $Quantity = $row[15];
                        $Amount = $row[16];
                        $Active = $row[17];

                        $checkbocname = "";
                        $checkbocname = $LRID;

                        $ConsignorName=Get_ConsignorName($con, $caid);
                        $ConsigneeName=Get_ConsigneeName($con, $cnid);
                        $ProductName=Get_ProductName($con, $pmid);
                        
                        ?>
                        <tr>
                            <td><input type="checkbox" name="<?php echo $checkbocname; ?>"
                                       id="<?php echo $checkbocname; ?>" checked><?php echo $LRID; ?></td>
                            <td><?php echo $InvoiceNumber; ?></td>
                            <td><?php echo $ConsignorName; ?></td>
                            <td><?php echo $ConsigneeName; ?></td>
                            <td><?php echo $ProductName; ?></td>
                            <td><?php echo $Quantity; ?></td>
                            <td><?php echo $Amount; ?></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <div class="col-md-12">
            <div class="text-right">
                <button type="button" name="submit" id="submit" class="btn bg-grey-600" onclick="return add_rmentry();"><span class="text-semibold" id="<?php echo $span_pageButton; ?>">Submit</span></button>
            </div>
        </div>
        <div id="div_rmentry"></div>
    </div>
</div>