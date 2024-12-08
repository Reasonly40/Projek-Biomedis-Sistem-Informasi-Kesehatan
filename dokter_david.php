<?php
// Mulai sesi jika diperlukan
session_start();

// Masukkan koneksi ke database
include('dbconn.php');

// Query untuk mengambil data dokter dari tabel
$sql = "SELECT * FROM dokter";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    />
    <link rel="stylesheet" href="dokter.css" />
    <title>Dr. David Brown</title>
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="logo">
        <img src="Images/LogoNumberOneHealth.png" alt="NumberOneHealth Logo" />
        <a>Number<span>ONE</span>Health</a>
      </div>

      <nav class="navbar">
        <a href="index.php#Home">Beranda</a>
        <a href="index.php#Poli">Layanan Kami</a>
        <a href="index.php#Dokter">Temukan Dokter</a>
        <a href="index.php#Berita">Berita</a>
      </nav>
    </header>

    <!-- Section: Dokter Detail -->
    <section id="DokterDetail">
      <div class="dokter-heading">
        <h1>Dr. David Brown</h1>
        <p>Spesialis Bedah Ortopedi</p>
      </div>
      <div class="dokter-detail-container">
        <div class="dokter-img">
          <img src="Images/team2.jpg" alt="Foto Dr. Sarah Williams" />
        </div>
        <div class="dokter-detail-text">
          <h2>Profil Dokter</h2>
          <p>
            Dr. David Brown adalah spesialis bedah ortopedi yang ahli dalam
            menangani cedera tulang, sendi, dan jaringan lunak
          </p>
          <h2>Jadwal Praktik</h2>
          <table>
            <thead>
              <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Lokasi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Selasa</td>
                <td>10:00 - 13:00</td>
                <td>Poli Bedah - Lantai 3</td>
              </tr>
              <tr>
                <td>Kamis</td>
                <td>15:00 - 18:00</td>
                <td>Poli Bedah - Lantai 3</td>
              </tr>
              <tr>
                <td>Jumat</td>
                <td>08:30 - 11:30</td>
                <td>Poli Bedah - Lantai 3</td>
              </tr>
            </tbody>
          </table>
          <h2>Kontak</h2>
          <p>
            Email: david.brown@numberonehealth.com <br />
            Telepon: +123 456 790
          </p>
          <div class="Home-btn">
            <a href="appointment.php">
              <i class="fa-regular fa-calendar-days"></i>
              Buat Janji Temu</a
            >
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
