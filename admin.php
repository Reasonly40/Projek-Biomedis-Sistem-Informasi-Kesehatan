<?php
session_start();

// Include the database connection
include('dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - NumberOneHealth</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Images/LogoNumberOneHealth.png" alt="NumberOneHealth Logo" />
            <a>Admin NumberOneHealth</a>
        </div>
        <a href="logout.php" class="btnout">Logout</a>
    </header>

    <main>
        <!-- Section: Data Berita -->
        <section id="berita">
            <h2>Data Berita</h2>
            <button onclick="window.location.href='berita.php'">Tambah Berita</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM berita";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['judul']}</td>
                                    <td>" . substr($row['konten'], 0, 50) . "...</td>
                                    <td>
                                        <a href='edit_berita.php?id={$row['id']}'><button>Edit</button></a>
                                        <a href='hapus_berita.php?id={$row['id']}'><button>Hapus</button></a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section: Data Dokter -->
        <section id="dokter">
            <h2>Data Dokter</h2>
            <button onclick="window.location.href='dokter.php'">Tambah Dokter</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM dokter";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['hari']}</td>
                                    <td>{$row['jam']}</td>
                                    <td>{$row['Lokasi']}</td>
                                    <td>
                                        <a href='edit_dokter.php?id={$row['id']}'><button>Edit</button></a>
                                        <a href='hapus_dokter.php?id={$row['id']}'><button>Hapus</button></a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section: Jadwal Dokter -->
        <section id="jadwal">
            <h2>Jadwal Dokter</h2>
            <button onclick="window.location.href='jadwal.php'">Tambah Jadwal</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dokter</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT jadwal.id, dokter.nama AS dokter, jadwal.hari, jadwal.jam 
                                  FROM jadwal 
                                  INNER JOIN dokter ON jadwal.dokter_id = dokter.id";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['dokter']}</td>
                                    <td>{$row['hari']}</td>
                                    <td>{$row['jam']}</td>
                                    <td>
                                        <a href='edit_jadwal.php?id={$row['id']}'><button>Edit</button></a>
                                        <a href='hapus_jadwal.php?id={$row['id']}'><button>Hapus</button></a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section: Rekam Medis -->
        <section id="rekam-medis">
            <h2>Rekam Medis</h2>
            <button onclick="window.location.href='rekam_medis.php'">Tambah Rekam Medis</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pasien</th>
                            <th>Diagnosis</th>
                            <th>Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT rekam_medis.id, pasien.nama AS pasien, rekam_medis.diagnosis, dokter.nama AS dokter
                                  FROM rekam_medis 
                                  INNER JOIN pasien ON rekam_medis.pasien_id = pasien.id
                                  INNER JOIN dokter ON rekam_medis.dokter_id = dokter.id";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['pasien']}</td>
                                    <td>{$row['diagnosis']}</td>
                                    <td>{$row['dokter']}</td>
                                    <td>
                                        <a href='edit_rekam_medis.php?id={$row['id']}'><button>Edit</button></a>
                                        <a href='hapus_rekam_medis.php?id={$row['id']}'><button>Hapus</button></a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section: Data Poli -->
        <section id="poli">
            <h2>Data Poli</h2>
            <button onclick="window.location.href='poli.php'">Tambah Poli</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Poli</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM poli";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['nama_poli']}</td>
                                    <td>{$row['deskripsi']}</td>
                                    <td>
                                        <a href='edit_poli.php?id={$row['id']}'><button>Edit</button></a>
                                        <a href='hapus_poli.php?id={$row['id']}'><button>Hapus</button></a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section: Antrian -->
        <section id="antrian">
            <h2>Antrian</h2>
            <button onclick="window.location.href='ambil_antrian.php'">Tambah Antrian</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No Antrian</th>
                            <th>Layanan</th>
                            <th>Waktu Mengambil Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT antrian.id, pasien.nama AS nama_pasien, antrian.no_antrian, poli.nama_poli, antrian.waktu
                                  FROM antrian 
                                  INNER JOIN pasien ON antrian.pasien_id = pasien.id
                                  INNER JOIN poli ON antrian.poli_id = poli.id";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['nama_pasien']}</td>
                                    <td>{$row['no_antrian']}</td>
                                    <td>{$row['nama_poli']}</td>
                                    <td>{$row['waktu']}</td>
                                    <td>
                                        <a href='edit_antrian.php?id={$row['id']}'><button>Edit</button></a>
                                        <a href='hapus_antrian.php?id={$row['id']}'><button>Hapus</button></a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <footer>
  <div class="footer-top">
    <div class="footer-box">
      <div class="footer-grid">
        <div class="footer-logo-info">
          <h2>
            <img src="Images/LogoNumberOneHealth.png" alt="Logo" class="footer-logo"> 
            <a>Number<span>ONE</span>Health</a>
        </div>

        <!-- Email Section -->
        <div class="footer-contact">
          <i class="fa-regular fa-envelope-open"></i>
          <p>
             Email: NumberOneHealth@gmail.com<br>
             Inquiries: infoOneHealth@gmail.com
          </p>
        </div>

        <!-- Phone Section -->
        <div class="footer-contact">
          <i class="fa-solid fa-phone"></i>
          <p>
            Office Telephone: 0029129102320<br>
             Mobile: 000 2324 39493
          </p>
        </div>
        <div class="footer-contact">
          <i class="fa-solid fa-location-dot"></i>
          <p>
             Office Location:<br>
            Semangat Perjuangan No 100
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="social-icons">
      <a href="#"><i class="fa-brands fa-facebook"></i></a>
      <a href="#"><i class="fa-brands fa-twitter"></i></a>
      <a href="#"><i class="fa-brands fa-instagram"></i></a>
    </div>
    <p>© NumberOneHealth 2024 | All Rights Reserved by KelompokBiomedis</p>
  </div>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
  </body>
</html>