<?php
// Sambungkan ke database
include 'dbconn.php'; // Pastikan ada file yang mengatur koneksi database
$conn = openConnection();

// Proses data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir dan sanitasi input
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $service = trim(htmlspecialchars($_POST['service']));
    $doctor = trim(htmlspecialchars($_POST['doctor']));
    $date = trim(htmlspecialchars($_POST['date']));
    $time = trim(htmlspecialchars($_POST['time']));
    $notes = trim(htmlspecialchars($_POST['notes']));

    // Validasi input
    if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($doctor) || empty($date) || empty($time)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua kolom wajib diisi.']);
        exit;
    }

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Email tidak valid.']);
        exit;
    }

    // Validasi tanggal
    if (!DateTime::createFromFormat('Y-m-d', $date)) {
        echo json_encode(['status' => 'error', 'message' => 'Format tanggal tidak valid (harus YYYY-MM-DD).']);
        exit;
    }

    // Validasi waktu
    if (!DateTime::createFromFormat('H:i', $time)) {
        echo json_encode(['status' => 'error', 'message' => 'Format waktu tidak valid (harus HH:MM).']);
        exit;
    }

    try {
        // Masukkan data ke database
        $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, service, doctor, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Query prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssssssss", $name, $email, $phone, $service, $doctor, $date, $time, $notes);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Janji temu berhasil diajukan.']);
        } else {
            throw new Exception("Gagal menyimpan data janji temu: " . $stmt->error);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
}
?>
