<?php
// Database connection
include('db_connect.php');

// Handle delete request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $receptionist_id = $_GET['id'];

    // Check if receptionist exists before deleting
    $stmt = $pdo->prepare("SELECT * FROM Receptionists WHERE receptionist_id = :id");
    $stmt->execute(['id' => $receptionist_id]);
    $receptionist = $stmt->fetch();

    if ($receptionist) {
        // Receptionist exists, proceed with deletion
        $stmt = $pdo->prepare("DELETE FROM Receptionists WHERE receptionist_id = :id");
        $stmt->execute(['id' => $receptionist_id]);

        // Redirect to receptionists list with success message
        header("Location: admin_dashboard.html#receptionists?status=deleted");
        exit;
    } else {
        // Receptionist not found, redirect with error message
        header("Location: admin_dashboard.html#receptionists?error=not_found");
        exit;
    }
} else {
    // Invalid or missing receptionist ID
    header("Location: admin_dashboard.html#receptionists?error=invalid_id");
    exit;
}
?>
