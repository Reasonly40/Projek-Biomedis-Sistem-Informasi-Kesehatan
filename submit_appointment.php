// Ambil data dari formulir
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$service = $_POST['service'];
$doctor = $_POST['doctor'];
$date = $_POST['date'];
$time = $_POST['time'];
$notes = $_POST['notes'];

// Validasi input
if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($doctor) || empty($date) || empty($time)) {
    echo json_encode(['status' => 'error', 'message' => 'Semua kolom wajib diisi.']);
    exit;
}

// Masukkan data ke database
$stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, service, doctor, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $name, $email, $phone, $service, $doctor, $date, $time, $notes);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Janji temu berhasil diajukan.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data janji temu.']);
}

$stmt->close();
$conn->close();
?>