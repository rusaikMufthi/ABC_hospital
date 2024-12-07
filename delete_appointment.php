<?php
// Database connection
include('db_connect.php');

// Handle delete request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $appointment_id = $_GET['id'];

    // Check if appointment exists before deleting
    $stmt = $pdo->prepare("SELECT * FROM Appointments WHERE appointment_id = :id");
    $stmt->execute(['id' => $appointment_id]);
    $appointment = $stmt->fetch();

    if ($appointment) {
        // Appointment exists, proceed with deletion
        $stmt = $pdo->prepare("DELETE FROM Appointments WHERE appointment_id = :id");
        $stmt->execute(['id' => $appointment_id]);

        // Redirect to appointments page
        header("Location: admin_dashboard.html#appointments?status=deleted");
        exit;
    } else {
        // If appointment doesn't exist, redirect with an error message
        header("Location: admin_dashboard.html#appointments?error=not_found");
        exit;
    }
} else {
    // Invalid or missing ID
    header("Location: admin_dashboard.html#appointments?error=invalid_id");
    exit;
}
?>
