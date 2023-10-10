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
$success = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM mahasiswa where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        // $sukses = "Berhasil Hapus Data";
        $success = "Berhasil Hapus Data";
    } else {
        $error = "Gagal Delete Data";
    }
}

if ($op == 'empty') {
    $sql1 = "DELETE FROM mahasiswa";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        // $sukses = "Berhasil Hapus Data";
        $success = "Data berhasil dikosongkan!";
    } else {
        $error = "Gagal mengosongkan data!";
    }
}

if ($op == 'edit') {
    $id              = $_GET['id'];
    $sql1            = "select * from mahasiswa where id = '$id'";
    $q1              = mysqli_query($koneksi, $sql1);
    $r1              = mysqli_fetch_array($q1);
    $npm             = $r1['NPM'];
    $nama            = $r1['Nama'];
    $programStudi    = $r1['programStudi'];
    $fakultas        = $r1['fakultas'];
    $alamat          = $r1['Alamat'];

    if ($npm == '') {
        $error = "Data Tidak Ditemukkan";
    }
}

// $sql5 = "ALTER TABLE mahasiswa AUTO_INCREMENT=0;";
// $q5 = mysqli_query($koneksi, $sql5);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Document</title>
</head>

<body>
    <!-- mengeluaarkan data -->
    <div class="mx-auto">
        <div class="card">
            <div class="card-header bg-secondary text-white text-center fs-4 d-flex ">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                </svg>
                <span class="mx-auto z-999 position-absolute">Proses Data Mahasiswa</span>
            </div>
            <div class="card-body">
                <?php
                if ($success) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success ?>
                    </div>
                <?php
                }
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NPM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Program Studi</th>
                            <th scope="col">Fakultas</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM mahasiswa order by id asc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id              = $r2['id'];
                            $npm             = $r2['NPM'];
                            $nama            = $r2['Nama'];
                            $programStudi    = $r2['programStudi'];
                            $fakultas        = $r2['fakultas'];
                            $alamat          = $r2['Alamat'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $npm ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $programStudi ?></td>
                                <td scope="row"><?php echo $fakultas ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row" class="d-flex grid gap-2">
                                    <a href="edit.php?op=edit&id=<?php echo $id ?>"><button type="button" data-toggle="tooltip" title="Update Data" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                            </svg></button></a>
                                    <a href="process.php?op=delete&id=<?php echo $id ?> " data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Yakin ingin menghapus data?')"><button type="button" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg></button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center grid gap-3">
                    <a href="index.php"><button type="button" class="btn btn-secondary">Kembali ke Input Data</button></a>
                    <a href="process.php"><button type="button" class="btn btn-success">Refresh</button></a>
                    <a href="process.php?op=empty&id=<?php echo $id ?> " onclick="return confirm('Yakin ingin menghapus semua data?')"><button type="button" class="btn btn-danger">Delete All</button></a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>