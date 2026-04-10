<?php
require_once('../includes/config.php');
checkRole('staff');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = 'Completed';

    // Update the status to Completed
    $stmt = $conn->prepare("UPDATE clearance_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        // Redirect back with a success flag
        header("Location: dashboard.php?msg=Released");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    header("Location: dashboard.php");
    exit();
}