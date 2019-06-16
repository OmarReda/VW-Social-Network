<?php
session_start();
include_once('config.php');

if (isset($_SESSION['user'])) {
    header('location: home.php');
    return;
}

if (empty($_POST['email'])) {
    echo 'Enter your email.';
    return;
}
if (empty($_POST['pass'])) {
    echo 'Enter your password.';
    return;
}
$email = mysqli_real_escape_string($link, $_POST['email']);
$password = mysqli_real_escape_string($link, $_POST['pass']);

if ($stmt = $link->prepare('SELECT * FROM users WHERE Email = ?')) {
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $password_hash = $row['Password'];
        if (password_verify($password, $password_hash)) {
            $_SESSION['User'] = $row['UserId'];
            $_SESSION['Name'] = $row['FirstName'] . ' ' . $row['LastName'];
            $_SESSION['Pic'] = $row['HasPic'];
            $_SESSION['Gender'] = $row['Gender'];
            $_SESSION['AboutMe'] = $row['AboutMe'];
            if ($row['HasPic'] == '1') {
                $_SESSION['Pic'] = 'users/' . $_SESSION['User'] . '.jpg';
            } else if ($_SESSION['Gender'] == 'M') {
                $_SESSION['Pic'] = 'users/default_m.jpg';
            } else if ($_SESSION['Gender'] == 'F') {
                $_SESSION['Pic'] = 'users/default_f.jpg';
            }

            echo 'success';
        } else {
            echo 'Invalid Pass';
        }
    } else {
        echo $stmt->error;
    }
}
