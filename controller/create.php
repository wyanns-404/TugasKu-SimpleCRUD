<?php
include '../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $mata_kuliah = $_POST['mata_kuliah'];
  $deadline = $_POST['deadline'];

  $sql = "INSERT INTO tugas (nama, mata_kuliah, deadline) VALUES ('$nama', '$mata_kuliah', '$deadline')";
  if ($conn->query($sql) === TRUE) {
      session_start();
      $_SESSION['status'] = 'success';
      $_SESSION['message'] = 'Tugas berhasil ditambahkan!';
  } else {
      session_start();
      $_SESSION['status'] = 'error';
      $_SESSION['message'] = 'Error: ' . $conn->error;
  }

  header("Location: ../");
  exit();
}
?>