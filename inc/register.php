<?php
include_once('config.php');

// receive all input values from the form
$email = mysqli_real_escape_string($link, $_POST['email']);
$password = mysqli_real_escape_string($link, $_POST['password']);
$firstname = mysqli_real_escape_string($link, $_POST['first_name']);
$lastname = mysqli_real_escape_string($link, $_POST['last_name']);
$dob = mysqli_real_escape_string($link, $_POST['birthday']);
$gender = mysqli_real_escape_string($link, $_POST['gender']);
$phone = mysqli_real_escape_string($link, $_POST['phone']);
$country = mysqli_real_escape_string($link, $_POST['country']);


$password_hashed = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database


$duplicate = mysqli_query($link, "select * FROM users WHERE Email='$email'");
if (mysqli_num_rows($duplicate) > 0) {
    echo "This email already exists.\n";
    return;
} else {

    $sql = 'INSERT INTO users (Email,Password,FirstName,LastName,Birthdate,Gender,PhoneNumber,HomeTown,AboutMe) VALUES (?,?,?,?,?,?,?,?,?)';

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        if ($gender == 'on')
            $gender_let = 'M';
        else
            $gender_let = 'F';
        $def_about = 'Nothing yet.';
        mysqli_stmt_bind_param($stmt, "sssssssss", $email, $password_hashed, $firstname, $lastname, $dob, $gender_let, $phone, $country, $def_about);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "This email already exists.\n";
        }
    }
}
// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($link);
