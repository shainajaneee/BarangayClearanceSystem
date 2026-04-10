<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $purpose = $_POST['purpose'];
    
    // Generate a unique tracking number (e.g., BOP-2026-8291)
    $tracking_no = "BOP-" . date("Y") . "-" . rand(1000, 9999);

    $sql = "INSERT INTO clearance_requests (tracking_no, resident_name, contact_no, purpose, status) 
            VALUES ('$tracking_no', '$name', '$contact', '$purpose', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page with the tracking number
        echo "<script>
                alert('Application Submitted! Your Tracking No: $tracking_no');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>