<?php
// Database connection
include('db_connect.php');

// Fetch existing doctor data
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $doctor_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Doctors WHERE doctor_id = :id");
    $stmt->execute(['id' => $doctor_id]);
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$doctor) {
        die("Doctor not found.");
    }
} else {
    die("Invalid doctor ID.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input sanitization and validation
    $doctor_id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $gender = $_POST['gender'];
    $age = (int) $_POST['age'];
    $specialization = htmlspecialchars($_POST['specialization']);
    $contact = htmlspecialchars($_POST['contact']);
    $address = htmlspecialchars($_POST['address']);

    // Update doctor in the database
    try {
        $sql = "UPDATE Doctors 
                SET name = :name, email = :email, gender = :gender, age = :age, 
                    specialization = :specialization, contact_number = :contact, address = :address 
                WHERE doctor_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $doctor_id,
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'age' => $age,
            'specialization' => $specialization,
            'contact' => $contact,
            'address' => $address,
        ]);

        header("Location: admin_dashboard.html#doctors&status=updated");
        exit;
    } catch (PDOException $e) {
        echo "Error updating doctor: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
</head>
<body>
    <h2>Edit Doctor</h2>
    <form action="edit_doctor.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($doctor['doctor_id']); ?>">

        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($doctor['email']); ?>" required><br><br>

        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="Male" <?php if ($doctor['gender'] === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($doctor['gender'] === 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($doctor['gender'] === 'Other') echo 'selected'; ?>>Other</option>
        </select><br><br>

        <label>Age:</label><br>
        <input type="number" name="age" value="<?php echo htmlspecialchars($doctor['age']); ?>" required><br><br>

        <label>Specialization:</label><br>
        <input type="text" name="specialization" value="<?php echo htmlspecialchars($doctor['specialization']); ?>" required><br><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($doctor['contact_number']); ?>" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address" value="<?php echo htmlspecialchars($doctor['address']); ?>" required><br><br>

        <button type="submit">Update Doctor</button>
    </form>
</body>
</html>
