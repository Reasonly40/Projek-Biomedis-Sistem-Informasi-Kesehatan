<?php
// Include database connection
include 'dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize user input
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));

    // Validate inputs
    if (empty($email) || empty($password)) {
        echo "Email dan password wajib diisi!";
        exit;
    }

    try {
        // Open database connection
        $conn = openConnection();

        // Check if the email exists
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            echo "Email tidak terdaftar!";
            $stmt->close();
            $conn->close();
            exit;
        }

        // Fetch user data
        $stmt->bind_result($id, $name, $hashedPassword);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            header("Location: dashboard.php"); // Redirect to the dashboard or any other page
        } else {
            echo "Password salah!";
        }

        // Close connections
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
