<?php
// Database connection
include('db_connect.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $admin_email = filter_var($_POST['admin_email'], FILTER_SANITIZE_EMAIL);
    $contact_number = filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING);
    $notifications = ($_POST['notifications'] == 'on') ? 1 : 0;  // Convert checkbox to boolean

    // Validate email format
    if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Password logic: only hash if password is set
    $admin_password = !empty($_POST['admin_password']) ? password_hash($_POST['admin_password'], PASSWORD_BCRYPT) : null;

    try {
        // Prepare SQL for updating settings
        $sql = "UPDATE Settings SET 
                    admin_email = :admin_email, 
                    contact_number = :contact_number, 
                    notifications = :notifications";
        $params = [
            'admin_email' => $admin_email,
            'contact_number' => $contact_number,
            'notifications' => $notifications
        ];

        // Update password if provided
        if ($admin_password) {
            $sql .= ", admin_password = :admin_password";
            $params['admin_password'] = $admin_password;
        }

        // Execute the update query
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Redirect with a success message
        header("Location: admin_dashboard.html#settings&status=updated");
        exit;
    } catch (PDOException $e) {
        // Error handling
        echo "Error updating settings: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Settings</title>
</head>
<body>
    <h2>Update Settings</h2>

    <!-- Success Message -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
        <p style="color: green;">Settings updated successfully!</p>
    <?php endif; ?>

    <form action="update_settings.php" method="POST">
        <label>Admin Email:</label><br>
        <input type="email" name="admin_email" value="<?php echo htmlspecialchars($current_settings['admin_email']); ?>" required><br><br>

        <label>Admin Password:</label><br>
        <input type="password" name="admin_password" placeholder="Leave empty to keep current password"><br><br>

        <label>Contact Number:</label><br>
        <input type="text" name="contact_number" value="<?php echo htmlspecialchars($current_settings['contact_number']); ?>" required><br><br>

        <label>Enable Notifications:</label><br>
        <input type="checkbox" name="notifications" <?php echo ($current_settings['notifications'] == 1) ? 'checked' : ''; ?>><br><br>

        <button type="submit">Update Settings</button>
    </form>
</body>
</html>
