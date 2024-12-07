<?php
session_start(); 
include('db_connect.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // trim to avoid spaces

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Email and password are required';
        header("Location: login_form.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header("Location: login_form.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (!empty($user['password']) && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            $roleRedirects = [
                'Admin' => 'admin_dashboard.php',
                'Doctor' => 'Doctor_Dashboard.php',
                'Receptionist' => 'Receptionist_Dashboard.php',
            ];

            $redirectPage = $roleRedirects[$user['role']];
            header("Location: $redirectPage");
            exit;
        } else {
            $_SESSION['error'] = 'Invalid password';
            header("Location: login_form.php");
            exit;
        }
    } else {
        $_SESSION['error'] = 'User not found';
        header("Location: login_form.php");
        exit;
    }
}
?>
