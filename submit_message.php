<?php
// Database connection
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $patient_name = $_POST['patient_name'] ?? null;
    $service = $_POST['service'] ?? null;
    $appointment_date = $_POST['date'] ?? null;
    $appointment_time = $_POST['time'] ?? null;
    $message = $_POST['message'] ?? null;

    // Validate the data (optional but recommended)
    if (empty($patient_name) || empty($service) || empty($message)) {
        echo "Please fill in all the required fields.";
        exit;
    }

    try {
        // Insert message into the Messages table
        $stmt = $pdo->prepare("
            INSERT INTO Messages (patient_name, service, appointment_date, appointment_time, message, status)
            VALUES (:patient_name, :service, :appointment_date, :appointment_time, :message, 'pending')
        ");

        $stmt->execute([
            ':patient_name' => $patient_name,
            ':service' => $service,
            ':appointment_date' => $appointment_date,
            ':appointment_time' => $appointment_time,
            ':message' => $message
        ]);

        // Redirect or display a success message
        echo "<script>
                alert('Message submitted successfully! Our receptionist will contact you soon.');
                window.location.href = 'welcome_page.html'; // Redirect to the welcome page
              </script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
