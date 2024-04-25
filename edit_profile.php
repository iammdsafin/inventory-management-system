<?php


include('database_connection.php');

if (!isset($_POST['user_name'], $_POST["user_old_password"], $_SESSION["user_id"])) {
	echo '<div class="alert alert-danger">Required information is missing.</div>';
	exit;
}

$currentPasswordQuery = "SELECT user_password FROM user_details WHERE user_id = ?";
$stmt = $connect->prepare($currentPasswordQuery);
$stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
	echo '<div class="alert alert-danger">User not found.</div>';
	exit;
}

$row = $result->fetch_assoc();
$currentPassword = $row['user_password'];

if (!password_verify($_POST["user_old_password"], $currentPassword)) {
	echo '<div class="alert alert-danger">Old password does not match.</div>';
	exit;
}

if (!empty($_POST["user_new_password"])) {
	$hashedPassword = password_hash($_POST["user_new_password"], PASSWORD_DEFAULT);
	$updateQuery = "UPDATE user_details SET user_name = ?, user_email = ?, user_password = ? WHERE user_id = ?";
	$stmt = $connect->prepare($updateQuery);
	$stmt->bind_param("ssss", $_POST["user_name"], $_POST["user_email"], $hashedPassword, $_SESSION["user_id"]);
} else {
	$updateQuery = "UPDATE user_details SET user_name = ?, user_email = ? WHERE user_id = ?";
	$stmt = $connect->prepare($updateQuery);
	$stmt->bind_param("sss", $_POST["user_name"], $_POST["user_email"], $_SESSION["user_id"]);
}

if ($stmt->execute()) {
	echo '<div class="alert alert-success">Profile Edited</div>';
} else {
	echo '<div class="alert alert-danger">Profile update failed.</div>';
}

$stmt->close();
