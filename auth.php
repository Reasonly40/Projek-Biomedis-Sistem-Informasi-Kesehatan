<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Pastikan hashing password konsisten

    $query = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $query->bind_param('ss', $email, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: dashboard.php');
        }
        exit;
    } else {
        echo 'Email atau password salah.';
    }
}
?>
