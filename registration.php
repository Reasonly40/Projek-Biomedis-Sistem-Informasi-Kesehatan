<?php
// Include database connection
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize user input
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));

    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        echo "Semua kolom wajib diisi!";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Open database connection
        $conn = openConnection();

        // Check if the email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Email sudah terdaftar!";
            $stmt->close();
            $conn->close();
            exit;
        }

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Pendaftaran berhasil! Silakan <a href='login.html'>masuk</a>.";
        } else {
            echo "Gagal mendaftar: " . $stmt->error;
        }

        // Close connections
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
