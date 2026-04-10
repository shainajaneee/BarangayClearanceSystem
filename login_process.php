<?php
// Fix the path to point to the includes folder
require_once('includes/config.php'); 

$type = $_POST['login_type'] ?? '';

if ($type == 'official') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // $conn comes from includes/config.php
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['username'] = $data['username'];

        // Redirect based on role
        if ($data['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: staff/dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid Credentials'); window.location.href='login.php';</script>";
    }

} elseif ($type == 'resident') {
    $tracking_no = $_POST['tracking_no'];

    $stmt = $conn->prepare("SELECT * FROM clearance_requests WHERE tracking_no = ?");
    $stmt->bind_param("s", $tracking_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['tracking_no'] = $tracking_no;
        $_SESSION['role'] = 'resident';
        header("Location: resident_dashboard.php");
    } else {
        echo "<script>alert('Tracking Number Not Found'); window.location.href='login.php';</script>";
    }
}
?>