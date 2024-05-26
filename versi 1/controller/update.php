<?php
include '../db/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $mata_kuliah = $_POST['mata_kuliah'];
    $deadline = $_POST['deadline'];

    $sql = "UPDATE tugas SET nama='$nama', mata_kuliah='$mata_kuliah', deadline='$deadline' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Tugas berhasil diupdate!';
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Error: ' . $conn->error;
    }

    header("Location: ../");
    exit();
}
?>
