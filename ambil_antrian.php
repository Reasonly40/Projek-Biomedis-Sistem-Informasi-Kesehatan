<?php
// Sambungkan ke database
include 'dbconn.php'; // Pastikan file ini ada untuk koneksi database
$conn = openConnection();

// Proses pengambilan nomor antrian
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $poli = $_POST['poli'] ?? '';
    $dokter = $_POST['dokter'] ?? '';

    if (empty($poli) || empty($dokter)) {
        $error = "Poli dan Dokter harus dipilih.";
    } else {
        // Dapatkan nomor antrian terakhir
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
            $success = "Nomor antrian Anda: $newQueue";
        } else {
            $error = "Gagal mengambil nomor antrian.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ambil Antrian</title>
    <link rel="stylesheet" href="ambil antrian.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.html">
                <img src="images/LogoNumberOneHealth.png" alt="NumberOneHealth Logo">
                <a>Number<span>ONE</span>Health</a>
            </a>
        </div>
    </header>
    <div class="container">
        <h1>Ambil Nomor Antrian</h1>

        <?php if (!empty($error)): ?>
            <div style="color: red;"><?= $error ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div style="color: green;"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
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

            <button type="submit" id="takeNumberBtn">Ambil Nomor</button>
        </form>

        <h2>Daftar Antrian</h2>
        <ul id="queueList">
            <?php
            // Tampilkan daftar antrian untuk hari ini
            $today = date('Y-m-d');
            $stmt = $conn->prepare("SELECT * FROM queue WHERE DATE(created_at) = ? ORDER BY created_at ASC");
            $stmt->bind_param("s", $today);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()):
            ?>
                <li>Poli: <?= htmlspecialchars($row['poli']) ?>, Dokter: <?= htmlspecialchars($row['dokter']) ?>, Nomor Antrian: <?= $row['queue_number'] ?></li>
            <?php endwhile; ?>

            <?php $stmt->close(); ?>
        </ul>
    </div>
</body>
</html>
<?php
$conn->close();
?>
