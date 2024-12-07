<?php
session_start();

// Store the user's role before destroying the session
$role = $_SESSION['role'] ?? null;

// Destroy session
session_unset();
session_destroy();

// Redirect based on role
if ($role === 'Admin') {
    header("Location: admin_login.php");
} elseif ($role === 'Doctor') {
    header("Location: doctor_login.php");
} elseif ($role === 'Receptionist') {
    header("Location: receptionist_login.php");
} else {
    header("Location: login.html"); // Default redirect
}
exit();
?>
