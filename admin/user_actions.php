<?php
require_once('../includes/config.php');
checkRole('admin');

$action = $_POST['action'];
$name = $_POST['full_name'];
$user = $_POST['username'];
$role = $_POST['role'];
$pass = $_POST['password'];

if ($action == 'create') {
    $stmt = $conn->prepare("INSERT INTO users (full_name, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $user, $pass, $role);
} else {
    $id = $_POST['user_id'];
    if(!empty($pass)) {
        $stmt = $conn->prepare("UPDATE users SET full_name=?, username=?, role=?, password=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $user, $role, $pass, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET full_name=?, username=?, role=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $user, $role, $id);
    }
}

$stmt->execute();
header("Location: manage_staff.php");