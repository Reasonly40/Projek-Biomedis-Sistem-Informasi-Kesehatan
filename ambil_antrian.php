// Sambungkan ke database
include 'dbconn.php'; // Pastikan ada file yang mengatur koneksi database
$conn = openConnection();

// Handle pengambilan nomor antrian
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $poli = $_POST['poli'];
    $dokter = $_POST['dokter'];

    if (empty($poli) || empty($dokter)) {
        echo json_encode(['status' => 'error', 'message' => 'Poli dan Dokter harus dipilih']);
        exit();
    }

    // Ambil nomor antrian terakhir untuk poli dan dokter yang dipilih
    $stmt = $conn->prepare("SELECT MAX(nomor_antrian) AS last_number FROM queue WHERE poli = ? AND dokter = ?");
    $stmt->bind_param("ss", $poli, $dokter);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $lastNumber = $row['last_number'] ?? 0;
    $newNumber = $lastNumber + 1;

    // Simpan antrian baru ke database
    $stmt = $conn->prepare("INSERT INTO queue (poli, dokter, nomor_antrian) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $poli, $dokter, $newNumber);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'number' => $newNumber]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengambil nomor antrian']);
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Handle reset antrian
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $conn->query("TRUNCATE TABLE queue");
    echo json_encode(['status' => 'success', 'message' => 'Antrian berhasil direset']);
    $conn->close();
    exit();
}
?>
