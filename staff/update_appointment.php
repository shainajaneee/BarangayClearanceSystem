<?php
require_once('../includes/config.php');
checkRole('staff');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']); 
    $status = $_GET['status'];

    // MATCH THESE TO YOUR DB: 'Scheduled', 'Completed', 'Cancelled'
    $allowed = ['Scheduled', 'Completed', 'Cancelled'];
    
    if (in_array($status, $allowed)) {
        $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            header("Location: schedule.php?msg=StatusUpdated");
            exit();
        }
    }
}
header("Location: schedule.php?msg=Error");
exit();