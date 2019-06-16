<?php

session_start();
include_once('config.php');

$requester = $_POST['requester'];
$requestee = $_POST['requestee'];
$sql = 'DELETE FROM requests WHERE OwnerId=? AND RequesteeId=?';

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
   
    mysqli_stmt_bind_param($stmt, "ss", $requestee, $requester);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "1";
    } else {
        echo "Some error happened.\n";
    }
}

$sql = 'INSERT INTO friends VALUES (?,?)';

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
   
    mysqli_stmt_bind_param($stmt, "ss", $requester, $requestee);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "2";
    } else {
        echo "Some error happened.\n";
    }
}

$sql = 'INSERT INTO friends VALUES (?,?)';

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
   
    mysqli_stmt_bind_param($stmt, "ss", $requestee, $requester);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "Some error happened.\n";
    }
}

$sql = "INSERT INTO notifications VALUES (?,?,'has accepted your friend request',NOW(),?,?)";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    $plink = 'profile.php?id=' . $requester;
    mysqli_stmt_bind_param($stmt, "ssss", $requestee, $plink, $_SESSION['Pic'], $_SESSION['Name']);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
    } else {
        echo "You already sent this friend request before.\n";
    }
}

?>