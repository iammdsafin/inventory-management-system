<?php
$connect = mysqli_connect('sql207.infinityfree.com', 'if0_36429472', 'kSCpUZAVWh1B', 'if0_36429472_inventory');
if (!$connect) {
    die('Connection failed: ' . mysqli_connect_error());
}

session_start();

// Register session variables in the $_SESSION array
$_SESSION['user_name'] = 'John';
$_SESSION['user_id'] = '';