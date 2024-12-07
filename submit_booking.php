<?php
// Database connection
include('db_connect.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $patient_name = $_POST['patient_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $specialty = $_POST['specialty'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];

    // Basic validation
    if (empty($patient_name) || empty($age) || empty($gender) || empty($contact) || empty($doctor_id) || empty($date) || empty($time)) {
        echo "All fields are required!";
        exit;
    }

    // Prepare and execute the query
    try {
        $stmt = $pdo->prepare("INSERT INTO Appointments (patient_name, patient_age, patient_gender, patient_contact, doctor_id, appointment_date, appointment_time, reason, specialty, status) 
                               VALUES (:patient_name, :age, :gender, :contact, :doctor_id, :date, :time, :reason, :specialty, 'pending')");

        $stmt->execute([
            'patient_name' => $patient_name,
            'age' => $age,
            'gender' => $gender,
            'contact' => $contact,
            'doctor_id' => $doctor_id,
            'date' => $date,
            'time' => $time,
            'reason' => $reason,
            'specialty' => $specialty,
        ]);

        echo "Appointment booked successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
