<?php
include('dbconn.php');

$id = $_GET['id'];
$sql = "DELETE FROM rekam_medis WHERE id='$id'";
if ($conn->query($sql)) {
    header("Location: rekam_medis.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
