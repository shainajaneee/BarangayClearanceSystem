<?php
require_once('../includes/config.php');
checkRole('resident');

// ... inside process_request.php ...

if (isset($_POST['submit_request'])) {
    $resident_id = $_SESSION['resident_id'];
    $resident_email = $_SESSION['email']; // Make sure this is in your session!
    $name = $_POST['resident_name'];
    $doc_type = $_POST['document_type'];
    $purpose = $_POST['purpose'];
    $contact = $_POST['contact_no'];
    
    // Generate Tracking Number
    $tracking_no = "BOP-" . date('Y') . "-" . rand(1000, 9999);
    $status = "Pending";

    // UPDATED ORDER TO MATCH YOUR TABLE:
    // 1. resident_id, 2. tracking_no, 3. resident_name, 4. document_type, 5. contact_no, 6. email, 7. purpose, 8. status
    $stmt = $conn->prepare("INSERT INTO clearance_requests (resident_id, tracking_no, resident_name, document_type, contact_no, email, purpose, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // "isssssss" = 1 integer and 7 strings
    $stmt->bind_param("isssssss", $resident_id, $tracking_no, $name, $doc_type, $contact, $resident_email, $purpose, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Application Submitted! Tracking No: $tracking_no'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>