<?php

session_start();
include_once('config.php');

$requester = $_POST['requester'];
$requestee = $_POST['requestee'];
$sql = 'DELETE FROM requests WHERE OwnerId=? AND RequesteeId=?';

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
   
    mysqli_stmt_bind_param($stmt, "ss", $requester, $requestee);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "Some error happened.\n";
    }
}

?>