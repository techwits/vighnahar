<?php
include('assets/inc/db_connect.php');
include('assets/inc/common-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SVL LR Print</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover-min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <script type="text/JavaScript" src="assets/js/search/search.js"></script>

</head>


<body>


<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $caid = $_GET['caid'];
    $ConsignorName=Get_ConsignorName($con, $caid);
//    echo("caid :- $caid </br>");
//    die();

?>
<input type="text" class="form-control" name="consignorid" id="consignorid" value="<?php echo $caid;?>">
<div class="panel-heading">
    <h5 class="panel-title"><i class="icon-stack position-left"></i> <span class="text-semibold" >Please enter (<?php echo $ConsignorName;?>) Receipt Amount</h5>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group form-group-material">
                <label>Amount <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" name="receiptamount" id="receiptamount"  required="required" autofocus onkeypress="return only_Numeric_dot(event);" ondrop="return false;" onpaste="return false;">
                    <span class="input-group-addon">
                        <i class="icon-libreoffice"></i>
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="panel-footer">
    <div class="col-md-12">
        <div class="text-right">
            <button type="button" name="submit" id="submit" class="btn bg-grey-600" onclick="return add_receipt(<?php echo $caid; ?>, document.getElementById('receiptamount').value);"><span class="text-semibold" id="<?php echo $span_pageButton; ?>">Submit</span></button>
        </div>
    </div>
    <div id="div_receipt"></div>
</div>