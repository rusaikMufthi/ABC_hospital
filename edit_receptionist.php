<?php
// Database connection
include('db_connect.php');

// Fetch existing receptionist data
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $receptionist_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Receptionists WHERE receptionist_id = :id");
    $stmt->execute(['id' => $receptionist_id]);
    $receptionist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$receptionist) {
        die("Receptionist not found.");
    }
} else {
    die("Invalid receptionist ID.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input sanitization and validation
    $receptionist_id = $_POST['id'];
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $gender = $_POST['gender'];
    $age = (int) $_POST['age'];
    $contact = htmlspecialchars($_POST['contact']);
    $address = htmlspecialchars($_POST['address']);

    try {
        $sql = "UPDATE Receptionists 
                SET first_name = :first_name, last_name = :last_name, email = :email, 
                    gender = :gender, age = :age, contact_number = :contact, address = :address 
                WHERE receptionist_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $receptionist_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'gender' => $gender,
            'age' => $age,
            'contact' => $contact,
            'address' => $address,
        ]);

        header("Location: admin_dashboard.html#receptionists&status=updated");
        exit;
    } catch (PDOException $e) {
        echo "Error updating receptionist: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Receptionist</title>
</head>
<body>
    <h2>Edit Receptionist</h2>
    <form action="edit_receptionist.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($receptionist['receptionist_id']); ?>">
        
        <label>First Name:</label><br>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($receptionist['first_name']); ?>" required><br><br>
        
        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($receptionist['last_name']); ?>" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($receptionist['email']); ?>" required><br><br>
        
        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="Male" <?php if ($receptionist['gender'] === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($receptionist['gender'] === 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($receptionist['gender'] === 'Other') echo 'selected'; ?>>Other</option>
        </select><br><br>
        
        <label>Age:</label><br>
        <input type="number" name="age" value="<?php echo htmlspecialchars($receptionist['age']); ?>" required><br><br>
        
        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($receptionist['contact_number']); ?>" required><br><br>
        
        <label>Address:</label><br>
        <input type="text" name="address" value="<?php echo htmlspecialchars($receptionist['address']); ?>" required><br><br>
        
        <button type="submit">Update Receptionist</button>
    </form>
</body>
</html>
