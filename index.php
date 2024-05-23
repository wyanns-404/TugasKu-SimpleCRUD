<?php
include 'db/db.php';
session_start();

$sql = "SELECT * FROM tugas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TugasKu</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header>
    <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex">
        <h3>Tugas</h3>
        <h3 style="color: gainsboro;">Ku</h3>
      </div>

      <div class="sosmed">
        <a href="https://instagram.com/wyanns/" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
        <a href="https://github.com/wyanns-404/" class="github ms-3" target="_blank"><i class="bi bi-github"></i></a>
        <a href="https://youtube.com/@wayansantiearif?si=wq_EkJrQfiPGDxJy" class="youtube ms-3" target="_blank"><i class="bi bi-youtube"></i></a>
      </div>
    </div>
  </header>

  <section class="main">


    <div class="container d-flex flex-column">
      <form id="taskForm" class="mt-4" method="post" action="controller/create.php">
        <label for="inputTugas" class="form-label">Nama Tugas</label>
        <input type="text" id="inputTugas" class="form-control" placeholder="..." name="nama">

        <label for="inputMataKuliah" class="form-label mt-2">Mata Kuliah</label>
        <input type="text" id="inputMataKuliah" class="form-control" placeholder="..." name="mata_kuliah">

        <label for="inputDeadline" class="form-label mt-2">Tanggal Deadline</label>
        <input type="date" class="form-control" id="inputDeadline" name="deadline" style="cursor: text;">

        <div class="button-tambah d-flex justify-content-center">
          <input class="btn border mt-3 mb-5" type="submit" value="Tambah">
        </div>
      </form>

      <div class="table border p-3">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Nama Tugas</th>
              <th scope="col">Mata Kuliah</th>
              <th scope="col">Deadline</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>" . $row["nama"] . "</td>
                            <td>" . $row["mata_kuliah"] . "</td>
                            <td>" . $row["deadline"] . "</td>
                            <td class='text-center'>
                                <a href='#' class='edit-link' data-id='" . $row["id"] . "' data-nama='" . $row["nama"] . "' data-mata_kuliah='" . $row["mata_kuliah"] . "' data-deadline='" . $row["deadline"] . "'><i class='bi bi-pencil-square'></i></a> |
                                <a href='#' class='delete-link' data-id='" . $row["id"] . "'><i class='bi bi-trash'></i></a>
                            </td>
                          </tr>";
              }
            } else {
              echo "<tr><td colspan='4'>Tidak ada tugas ditemukan, silahkan tambah tugas baru!</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php
    if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
      echo "<script>
                Swal.fire({
                    title: '" . ($_SESSION['status'] == 'success' ? '' : 'Error!') . "',
                    text: '" . $_SESSION['message'] . "',
                    icon: '" . $_SESSION['status'] . "'
                });
              </script>";
      unset($_SESSION['status']);
      unset($_SESSION['message']);
    }
    ?>

  </section>

  <footer class="d-flex">
    <div class="container d-flex align-items-center justify-content-center text-center">
      &copy; Copyright <i style="color:#2185d0">-</i><strong><span>wyanns</span></strong>. All Rights Reserved
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>