<?php
include('dbconn.php');

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    $sql = "UPDATE berita SET judul='$judul', konten='$konten' WHERE id='$id'";
    if ($conn->query($sql)) {
        header("Location: berita.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    $result = $conn->query("SELECT * FROM berita WHERE id='$id'");
    $data = $result->fetch_assoc();
}
?>

<form method="POST">
    <input type="text" name="judul" value="<?= $data['judul'] ?>" required>
    <textarea name="konten" required><?= $data['konten'] ?></textarea>
    <button type="submit">Update</button>
</form>
