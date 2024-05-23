<?php
include 'db.php';
session_start();

$id = $_GET['id'];

$sql = "DELETE FROM tugas WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = 'Tugas berhasil dihapus!';
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['message'] = 'Error: ' . $conn->error;
}

header("Location: index.php");
exit();
?>
