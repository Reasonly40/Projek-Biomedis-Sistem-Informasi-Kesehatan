<?php
session_start();
include('dbconn.php');

if (!isset($_GET['id'])) {
    header("Location: admin_panel.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "DELETE FROM antrian WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data antrian berhasil dihapus!'); window.location.href = 'admin_panel.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data antrian.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Antrian</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <h1>Hapus Antrian</h1>
    </header>
    <main>
        <p>Apakah Anda yakin ingin menghapus antrian ini?</p>
        <form method="POST">
            <button type="submit">Hapus</button>
            <button type="button" onclick="window.location.href='admin_panel.php'">Batal</button>
        </form>
    </main>
</body>
</html>
