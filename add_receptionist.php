<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('db_connect.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    try {
        // Insert into Users table if `user_id` is required
        $username = strtolower(str_replace(' ', '_', $first_name . $last_name)); // Example username
        $password = password_hash('defaultpassword', PASSWORD_BCRYPT); // Default password
        
        $user_sql = "INSERT INTO Users (username, password, email, role_id, role) 
                     VALUES (:username, :password, :email, 3, 'Receptionist')";
        $stmt = $pdo->prepare($user_sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password,
            ':email' => $email
        ]);
        $user_id = $pdo->lastInsertId(); // Get the new user_id

        // Insert into Receptionists table
        $sql = "INSERT INTO Receptionists (user_id, first_name, last_name, email, gender, age, contact_number, address) 
                VALUES (:user_id, :first_name, :last_name, :email, :gender, :age, :contact, :address)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':gender' => $gender,
            ':age' => $age,
            ':contact' => $contact,
            ':address' => $address
        ]);

        // Redirect to Admin Dashboard or confirmation page
        header("Location: admin_dashboard.html#receptionists");
        exit;
    } catch (PDOException $e) {
        echo "Error adding receptionist: " . $e->getMessage();
    }
}
?>

<?php
    $cssPath = "css\add_doctor.css";
    echo '<link rel="stylesheet"
    href="' .$cssPath.'">'
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Receptionist</title>
</head>
<body>
    <div class="form-container">
        <h1>Add Receptionist</h1>
        <form action="add_receptionist.php" method="POST">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="first_name" required>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="last_name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Age:</label><br>
                <input type="number" name="age" required>
            </div>
            <div class="form-group">
                <label>Contact:</label>
                <input type="text" name="contact" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <button type="submit">Add Receptionist</button>
            </div>
        </form>

    </div>
</body>
</html>
