<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
<!-- /theme JS files -->

<?php
    include_once('assets/inc/db_connect.php');
    include_once('assets/inc/common-function.php');

    if(!isset($_REQUEST["Table_ColumnName"])) {
        $UrlPage=substr($_SERVER["PHP_SELF"],1,strlen($_SERVER["PHP_SELF"]));
        $AccessingPage=basename(__FILE__); //"add_society.php";
        //			echo("UrlPage :- $UrlPage </br>");
        //			echo("AccessingPage :- $AccessingPage </br>");
        if(trim($UrlPage)==trim($AccessingPage)){
            header("Location: /login.php");
        }
    }


    $Table_ColumnName=$_REQUEST["Table_ColumnName"];
//    echo("Table_ColumnName :- $Table_ColumnName </br>");
    if(strlen(trim($Table_ColumnName))>0){
        $Split_Master = explode("||", $Table_ColumnName);
        $TblName=$Split_Master[0];
        $ClnName=$Split_Master[1];
        $FirstColumnName=Get_FirstColumnName($con, $TblName);

//        echo("Split_Master[0] :- $Split_Master[0] </br>");
//        echo("Split_Master[1] :- $Split_Master[1] </br>");
//        echo("FirstColumnName :- $FirstColumnName </br>");
//        die();
        ?>
            <input type="hidden" name="TableName" id="TableName" value="<?php echo $TblName; ?>">
            <input type="hidden" name="ColumnName" id="ColumnName" value="<?php echo $ClnName; ?>">
            <input type="hidden" name="FirstColumn" id="FirstColumn" value="<?php echo $FirstColumnName; ?>">

            <div class="form-group form-group-material">
                <label>Product</label>
                <div class="input-group">
                    <select name="masterrecord" id="masterrecord"  class="form-control">
                        <option></option>
                            <?php
                                Fill_Master_Delete($con, $Split_Master[0], $Split_Master[1], $FirstColumnName);
                            ?>
                    </select>
                </div>
            </div>
        <?php
    }

//    echo("Table_ColumnName :- $Table_ColumnName </br>");
//    echo("Table Name :- $Split_Master[0] </br>");
//    echo(" Column Name :- $Split_Master[1] </br>");
//    die();

?>
