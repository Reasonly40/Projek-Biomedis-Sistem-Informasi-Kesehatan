<div class="poli-selection">
    <label for="poli">Pilih Poli:</label>
    <select id="poli" name="poli">
        <option value="">Pilih Poli</option>
        <option value="poli_anak">Poli Anak</option>
        <option value="poli_bedah">Poli Bedah</option>
        <option value="poli_kulit_dan_kelamin">Poli Kulit dan Kelamin</option>
        <option value="poli_tht">Poli THT</option>
        <option value="poli_penyakit_dalam">Poli Penyakit Dalam</option>
        <option value="poli_ginekologi">Poli Kandungan</option>
    </select>
</div>

<div class="dokter-selection">
    <label for="dokter">Pilih Dokter:</label>
    <select id="dokter" name="dokter">
        <option value="">Pilih Dokter</option>
        <option value="dr_andre">Dr. Andre</option>
        <option value="dr_clara">Dr. Clara</option>
    </select>
</div>

<button id="takeNumberBtn">Ambil Nomor</button>

<h2>Daftar Antrian</h2>
<ul id="queueList"></ul>


<?php
// Sambungkan ke database
include 'dbconn.php'; // File ini mengatur koneksi ke database
$conn = openConnection();

// Proses pengambilan nomor antrian
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $poli = $_POST['poli'];
    $dokter = $_POST['dokter'];

    if (empty($poli) || empty($dokter)) {
        echo json_encode(['status' => 'error', 'message' => 'Poli dan Dokter harus dipilih.']);
        exit;
    }

    // Dapatkan nomor antrian terakhir untuk poli dan dokter tertentu
    $stmt = $conn->prepare("SELECT MAX(queue_number) AS last_queue FROM queue WHERE poli = ? AND dokter = ?");
    $stmt->bind_param("ss", $poli, $dokter);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastQueue = $result->fetch_assoc()['last_queue'] ?? 0;

    // Tambahkan nomor antrian baru
    $newQueue = $lastQueue + 1;
    $stmt = $conn->prepare("INSERT INTO queue (poli, dokter, queue_number) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $poli, $dokter, $newQueue);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'queue_number' => $newQueue]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengambil nomor antrian.']);
    }

    $stmt->close();
}

// Tutup koneksi database
$conn->close();
?>
