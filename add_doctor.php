<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('db_connect.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $specialization = $_POST['specialization'];
    $contact_number = $_POST['contact'];

    try {
        // Optional: Insert into Users table if `user_id` is required
        $username = strtolower(str_replace(' ', '_', $name)); // Example username
        $password = password_hash('defaultpassword', PASSWORD_BCRYPT); // Default password
        
        $user_sql = "INSERT INTO Users (username, password, email, role_id, role) 
                     VALUES (:username, :password, :email, 2, 'Doctor')";
        $stmt = $pdo->prepare($user_sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password,
            ':email' => $email
        ]);
        $user_id = $pdo->lastInsertId(); // Get the new user_id

        // Insert into Doctors table
        $doctor_sql = "INSERT INTO Doctors (user_id, name, email, gender, age, address, specialization, contact_number)
                       VALUES (:user_id, :name, :email, :gender, :age, :address, :specialization, :contact_number)";
        $stmt = $pdo->prepare($doctor_sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':name' => $name,
            ':email' => $email,
            ':gender' => $gender,
            ':age' => $age,
            ':address' => $address,
            ':specialization' => $specialization,
            ':contact_number' => $contact_number
        ]);

        // Redirect to Admin Dashboard or confirmation page
        header("Location: admin_dashboard.php?success=doctor_added");
        exit;
    } catch (PDOException $e) {
        echo "Error adding doctor: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>

    <?php
    $cssPath = "css\add_doctor.css";
    echo '<link rel="stylesheet"
    href="' .$cssPath.'">'
    ?>

</head>
<body>
    <div class="form-container">
        <h1>Add Doctor</h1>
        <form action="add_doctor.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" id="specialization" name="specialization" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <button type="submit">Add Doctor</button>
            </div>
        </form>
    </div>
</body>
</html>
