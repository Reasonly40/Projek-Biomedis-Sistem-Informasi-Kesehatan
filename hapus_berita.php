<?php
include('dbconn.php');

$id = $_GET['id'];
$sql = "DELETE FROM berita WHERE id='$id'";
if ($conn->query($sql)) {
    header("Location: berita.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
