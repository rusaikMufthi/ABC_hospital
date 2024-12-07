<?php
// Database connection
include('db_connect.php');

// Handle delete request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $doctor_id = $_GET['id'];

    // Check if doctor exists before deleting
    $stmt = $pdo->prepare("SELECT * FROM Doctors WHERE doctor_id = :id");
    $stmt->execute(['id' => $doctor_id]);
    $doctor = $stmt->fetch();

    if ($doctor) {
        // Doctor exists, proceed with deletion
        $stmt = $pdo->prepare("DELETE FROM Doctors WHERE doctor_id = :id");
        $stmt->execute(['id' => $doctor_id]);

        // Redirect to doctors list with success message
        header("Location: admin_dashboard.html#doctors?status=deleted");
        exit;
    } else {
        // Doctor not found, redirect with error message
        header("Location: admin_dashboard.html#doctors?error=not_found");
        exit;
    }
} else {
    // Invalid or missing doctor ID
    header("Location: admin_dashboard.html#doctors?error=invalid_id");
    exit;
}
?>
