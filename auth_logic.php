<?php
require_once('includes/config.php');

// If action is not set, redirect to index
if (!isset($_POST['action'])) {
    header("Location: index.php");
    exit();
}

$action = $_POST['action'];

// --- 1. RESIDENT REGISTRATION ---
if ($action == 'register_resident') {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $pass = $_POST['password']; 

    $stmt = $conn->prepare("INSERT INTO residents (full_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $pass);

    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Email already exists!'); window.history.back();</script>";
    }
}

// --- 2. RESIDENT LOGIN ---
if ($action == 'login_resident') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM residents WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $res = $result->fetch_assoc();
        $_SESSION['role'] = 'resident';
        $_SESSION['resident_id'] = $res['id'];
        $_SESSION['username'] = $res['full_name'];
        $_SESSION['email'] = $res['email']; // Useful for auto-filling forms

        header("Location: resident/dashboard.php"); 
        exit();
    } else {
        echo "<script>alert('Invalid email or password'); window.history.back();</script>";
    }
}

// --- 3. STAFF / ADMIN LOGIN ---
if ($action == 'login_official') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['full_name'] = $data['full_name'];

        if ($data['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: staff/dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password'); window.history.back();</script>";
    }
}
?>