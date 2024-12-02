<?php
// Konfigurasi koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "numberonehealth";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $notes = $_POST['notes'];

    // Validasi data
    if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($doctor) || empty($date) || empty($time)) {
        echo "Semua kolom yang wajib harus diisi!";
    } else {
        // Query untuk menyimpan data ke database
        $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, service, doctor, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $email, $phone, $service, $doctor, $date, $time, $notes);

        if ($stmt->execute()) {
            echo "Janji temu berhasil dibuat!";
        } else {
            echo "Gagal membuat janji temu: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>