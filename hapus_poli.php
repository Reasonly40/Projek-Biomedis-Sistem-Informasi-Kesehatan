<?php
include('dbconn.php');

$id = $_GET['id'];
$sql = "DELETE FROM poli WHERE id='$id'";
if ($conn->query($sql)) {
    header("Location: poli.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
