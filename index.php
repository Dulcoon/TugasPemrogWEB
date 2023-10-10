<?php

$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "sistemakademiksederhana";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
  die("Tidak bisa terkoneksi ke database!");
}

$npm = "";
$nama = "";
$programStudi = "";
$fakultas = "";
$alamat = "";
$sukses = "";
$error = "";

$sql5 = "ALTER TABLE mahasiswa AUTO_INCREMENT=0;";
$q5 = mysqli_query($koneksi, $sql5);

if (isset($_POST['simpan'])) {
  $npm    = $_POST['npm'];
  $nama    = $_POST['nama'];
  $programStudi    = $_POST['programStudi'];
  $fakultas    = $_POST['fakultas'];
  $alamat    = $_POST['alamat'];

  if ($npm && $nama && $programStudi && $fakultas && $alamat) {
    //untuk insert
    // cek jika npm sudah ada di database
    $npm_check_query = "SELECT * FROM mahasiswa WHERE NPM='$npm'";
    $npm_check_result = mysqli_query($koneksi, $npm_check_query);

    if (mysqli_num_rows($npm_check_result) > 0) {
      $error = "NPM '$npm' sudah ada terdaftar!";
    } else {
      // Insert data ke database
      $sql1 = "INSERT INTO mahasiswa(NPM, Nama, programStudi, fakultas, Alamat) VALUES ('$npm', '$nama', '$programStudi', '$fakultas', '$alamat')";
      $q1 = mysqli_query($koneksi, $sql1);

      if ($q1) {
        $sukses = "Berhasil Memasukkan data baru";
      } else {
        $error = "Gagal memasukkan data";
      }
    }
  } else {
    $error = "Pastikan semua data telah terisi!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    .mx-auto {
      width: 800px;
    }

    .card {
      margin-top: 10px;
    }

    body {
      font-family: 'Poppins', sans-serif;
      font-weight: 400;
    }
  </style>
  <title>Sistem Akademik Sederhana</title>
</head>

<body>
  <div class="mx-auto">
    <!-- masukkan data -->
    <div class="">
      <h1 class="text-center text-lg" style="font-weight: 600;">Pengelolaan Data Mahasiswa<br>Universitas ABCD</h1>
    </div>
    <div class="card shadow">
      <div class="card-header bg-primary text-white text-center fs-4 d-flex ">
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="z-1 bi bi-house-door-fill" viewBox="0 0 16 16">
          <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
        </svg>
        <span class="mx-auto z-999 position-absolute">Input Data Mahasiswa</span>
      </div>
      <div class="card-body">
        <?php
        if ($error) {
        ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
          </div>
        <?php
        }
        ?>
        <?php
        if ($sukses) {
        ?>
          <div class="alert alert-success" role="alert">
            <?php echo $sukses ?>
          </div>
        <?php
        }
        ?>
        <form action="" method="POST">
          <div class="mb-3">
            <label for="npm" class="form-label">NPM</label>
            <input type="text" class="form-control" id="npm" name="npm" placeholder="Masukkan NPM Anda" value="<?php echo $npm ?>" />
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda" value="<?php echo $nama ?>" />
          </div>
          <div class="mb-3">
            <label for="programStudi" class="form-label">Program Studi</label>
            <input type="text" class="form-control" id="programStudi" name="programStudi" placeholder="Masukkan Prodi Anda" value="<?php echo $programStudi ?>" />
          </div>
          <div class="mb-3">
            <label for="programStudi" class="form-label">Fakultas</label>
            <select class="form-control" name="fakultas" id="fakultas">
              <option value="">- Pilih Fakultas -</option>
              <option value="saintek <?php if ($fakultas == "saintek") echo "Selected" ?>">Sains & Teknologi -</option>
              <option value="bishum <?php if ($fakultas == "bishum") echo "Selected" ?>">Bisnis & Humaniora -</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat di Jogja" value="<?php echo $alamat ?>" />
          </div>
          <div class="d-flex justify-content-center grid gap-3">
            <!-- <input type="submit" value="Simpan Data" name="simpan" class="btn btn-primary "> -->
            <button type="submit" name="simpan" class="btn btn-primary ">Simpan Data</button>
            <a href="index.php"><button type="button" class="btn btn-success">Refresh</button></a>
            <a href="process.php"><button type="button" class="btn btn-secondary">Prosess Data Mhs</button></a>
          </div>
        </form>
      </div>
    </div>
  </div>







  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>