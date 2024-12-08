<?php
include('dbconn.php');

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE poli SET name='$name', description='$description' WHERE id='$id'";
    if ($conn->query($sql)) {
        header("Location: poli.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    $result = $conn->query("SELECT * FROM poli WHERE id='$id'");
    $data = $result->fetch_assoc();
}
?>

<form method="POST">
    <input type="text" name="name" value="<?= $data['name'] ?>" required>
    <textarea name="description" required><?= $data['description'] ?></textarea>
    <button type="submit">Update</button>
</form>
