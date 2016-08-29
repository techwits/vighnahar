
<?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
    $CurrentDate = date('Y-m-d h:i:s');

    $designation=trim($_REQUEST["designation"]);
    $designationencryption=trim($_REQUEST["p"]);

//    echo ("designation:- ".$designation."</br>");
//    echo ("designationencryption:- ".$designationencryption."</br>");
//    die();

    if (strlen($designationencryption) != 128)
    {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid Code configuration.</p>';
    }

    $designationencryption_hash = password_hash($designationencryption, PASSWORD_BCRYPT);

    $Procedure= "Call Save_Designation('$CurrentDate', '$designation', '$designationencryption_hash');";
//    echo ("Procedure:- ".$Procedure."</br>");
//    die();

    $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: ".mysqli_error($con), E_USER_ERROR);
    if (mysqli_num_rows($result)!=0)
    {
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $LastInsertedID=$row{0};
    }
    mysqli_free_result($result);
    echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");