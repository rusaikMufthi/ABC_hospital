<?php
// Database connection
include('db_connect.php');

// Fetch existing appointment data
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Appointments WHERE appointment_id = :id");
    $stmt->execute(['id' => $appointment_id]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$appointment) {
        die("Appointment not found.");
    }
} else {
    die("Invalid appointment ID.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input sanitization and validation
    $appointment_id = $_POST['id'];
    $patient_name = htmlspecialchars($_POST['patient_name']);
    $contact = htmlspecialchars($_POST['contact']);
    $doctor_id = (int) $_POST['doctor_id']; // Ensuring doctor_id is an integer
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = htmlspecialchars($_POST['reason']);
    $status = $_POST['status'];

    // Update appointment in the database
    try {
        $stmt = $pdo->prepare("UPDATE Appointments 
                               SET patient_name = :patient_name, patient_contact = :contact, doctor_id = :doctor_id, 
                                   appointment_date = :date, appointment_time = :time, reason = :reason, status = :status 
                               WHERE appointment_id = :id");

        $stmt->execute([
            'id' => $appointment_id,
            'patient_name' => $patient_name,
            'contact' => $contact,
            'doctor_id' => $doctor_id,
            'date' => $date,
            'time' => $time,
            'reason' => $reason,
            'status' => $status,
        ]);

        header("Location: admin_dashboard.html#appointments&status=updated");
        exit;
    } catch (PDOException $e) {
        echo "Error updating appointment: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
</head>
<body>
    <h2>Edit Appointment</h2>
    <form action="edit_appointment.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($appointment['appointment_id']); ?>">
        
        <label>Patient Name:</label><br>
        <input type="text" name="patient_name" value="<?php echo htmlspecialchars($appointment['patient_name']); ?>" required><br><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($appointment['patient_contact']); ?>" required><br><br>

        <label>Doctor:</label><br>
        <select name="doctor_id" required>
            <?php
            // Fetch doctors to populate the dropdown
            $stmt = $pdo->query("SELECT doctor_id, name FROM Doctors");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($row['doctor_id'] == $appointment['doctor_id']) ? 'selected' : '';
                echo "<option value='{$row['doctor_id']}' $selected>{$row['name']}</option>";
            }
            ?>
        </select><br><br>

        <label>Date:</label><br>
        <input type="date" name="date" value="<?php echo htmlspecialchars($appointment['appointment_date']); ?>" required><br><br>

        <label>Time:</label><br>
        <input type="time" name="time" value="<?php echo htmlspecialchars($appointment['appointment_time']); ?>" required><br><br>

        <label>Reason:</label><br>
        <textarea name="reason" required><?php echo htmlspecialchars($appointment['reason']); ?></textarea><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="pending" <?php if ($appointment['status'] === 'pending') echo 'selected'; ?>>Pending</option>
            <option value="confirmed" <?php if ($appointment['status'] === 'confirmed') echo 'selected'; ?>>Confirmed</option>
            <option value="cancelled" <?php if ($appointment['status'] === 'cancelled') echo 'selected'; ?>>Cancelled</option>
            <option value="completed" <?php if ($appointment['status'] === 'completed') echo 'selected'; ?>>Completed</option>
        </select><br><br>

        <button type="submit">Update Appointment</button>
    </form>
</body>
</html>
