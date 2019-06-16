<?php
session_start();
include_once('config.php');

$poster = $_SESSION['User'];
$is_public = $_POST['post_type'];
$caption = $_POST['caption'];

if ($stmt = $link->prepare('INSERT INTO posts VALUES (?,?,NOW(),?)')) {
    $stmt->bind_param('sss', $poster, $caption, $is_public);
    $stmt->execute();
    echo 'Posted';
}
