<?php
session_start();
include('dbconn.php');

if (!isset($_GET['id'])) {
    header("Location: admin_panel.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pasien_id = $_POST['pasien_id'];
    $poli_id = $_POST['poli_id'];
    $no_antrian = $_POST['no_antrian'];

    $query = "UPDATE antrian SET pasien_id = ?, poli_id = ?, no_antrian = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiii", $pasien_id, $poli_id, $no_antrian, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data antrian berhasil diperbarui!'); window.location.href = 'admin_panel.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data antrian.');</script>";
    }
}

$query = "SELECT * FROM antrian WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$antrian = $result->fetch_assoc();

$query_pasien = "SELECT id, nama FROM pasien";
$query_poli = "SELECT id, nama_poli FROM poli";
$pasien_list = $conn->query($query_pasien);
$poli_list = $conn->query($query_poli);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Antrian</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <h1>Edit Antrian</h1>
    </header>
    <main>
        <form method="POST">
            <label for="pasien_id">Pasien:</label>
            <select name="pasien_id" id="pasien_id" required>
                <?php while ($pasien = $pasien_list->fetch_assoc()): ?>
                    <option value="<?= $pasien['id']; ?>" <?= $pasien['id'] == $antrian['pasien_id'] ? 'selected' : ''; ?>>
                        <?= $pasien['nama']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="poli_id">Poli:</label>
            <select name="poli_id" id="poli_id" required>
                <?php while ($poli = $poli_list->fetch_assoc()): ?>
                    <option value="<?= $poli['id']; ?>" <?= $poli['id'] == $antrian['poli_id'] ? 'selected' : ''; ?>>
                        <?= $poli['nama_poli']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="no_antrian">No Antrian:</label>
            <input type="number" name="no_antrian" id="no_antrian" value="<?= $antrian['no_antrian']; ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
        <button onclick="window.location.href='admin_panel.php'">Kembali</button>
    </main>
</body>
</html>
