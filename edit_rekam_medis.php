<?php
include('dbconn.php');

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pasien = $_POST['pasien'];
    $diagnosis = $_POST['diagnosis'];
    $dokter = $_POST['dokter'];

    $sql = "UPDATE rekam_medis SET pasien='$pasien', diagnosis='$diagnosis', dokter='$dokter' WHERE id='$id'";
    if ($conn->query($sql)) {
        header("Location: rekam_medis.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    $result = $conn->query("SELECT * FROM rekam_medis WHERE id='$id'");
    $data = $result->fetch_assoc();
}
?>

<form method="POST">
    <input type="text" name="pasien" value="<?= $data['pasien'] ?>" required>
    <input type="text" name="diagnosis" value="<?= $data['diagnosis'] ?>" required>
    <input type="text" name="dokter" value="<?= $data['dokter'] ?>" required>
    <button type="submit">Update</button>
</form>
