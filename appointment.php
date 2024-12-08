<?php
// Start the session
session_start();

// Include the database connection
include('dbconn.php');

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek apakah form dikirimkan dengan metode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari session (data user yang login)
        if (isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
            $user_id = $_SESSION['id'];
            $patient_name = $_SESSION['name']; // Pastikan nama tersimpan di session
            $email = $_SESSION['email'];
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Silakan login untuk membuat janji temu.']);
            exit();
        }

        // Ambil data dari form
        $phone = $_POST['phone'];
        $service = $_POST['service'];
        $doctor = $_POST['doctor'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

        // Persiapkan query SQL untuk memasukkan data ke dalam database
        $sql = "INSERT INTO appointments (user_id, patient_name, email, phone, service, doctor, date, time, notes) 
                VALUES (:user_id, :patient_name, :email, :phone, :service, :doctor, :date, :time, :notes)";

        // Persiapkan statement dan bind parameter
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':patient_name', $patient_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':service', $service);
        $stmt->bindParam(':doctor', $doctor);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':notes', $notes);

        // Eksekusi query
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Janji temu berhasil dibuat!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal membuat janji temu. Silakan coba lagi.']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Koneksi database gagal: ' . $e->getMessage()]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap" 1 
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
  />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="janji temu.css" />
  <title>NumberOneHealth</title>
</head>
<body>
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

  <main>
    <section class="appointment-form">
      <h2>Buat Janji Temu</h2>
      <form id="appointmentForm">
        <div class="form-group">
          <label for="name">Nama Lengkap:</label>
          <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required />
        </div>
        <div class="form-group">
          <label for="phone">Nomor Telepon:</label>
          <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda" required />
        </div>
        <div class="form-group">
          <label for="service">Layanan yang Dipilih:</label>
          <select id="service" name="service" required>
            <option value="">Pilih layanan</option>
            <option value="poli_anak">Poli Anak</option>
            <option value="poli_bedah">Poli Bedah</option>
            <option value="poli_kulit_dan_kelamin">Poli Kulit dan Kelamin</option>
            <option value="poli_tht">Poli THT</option>
            <option value="poli_penyakit_dalam">Poli Penyakit Dalam</option>
            <option value="poli_ginekologi">Poli Kandungan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="doctor">Dokter yang Tersedia:</label>
          <select id="doctor" name="doctor" required>
            <option value="">Pilih layanan terlebih dahulu</option>
          </select>
        </div>
        <div class="form-group">
          <label for="date">Tanggal:</label>
          <input type="date" id="date" name="date" required />
        </div>
        <div class="form-group">
          <label for="time">Waktu:</label>
          <input type="time" id="time" name="time" required />
        </div>
        <div class="form-group">
          <label for="notes">Catatan Tambahan:</label>
          <textarea id="notes" name="notes" placeholder="Tulis catatan Anda di sini (opsional)"></textarea>
        </div>
        <button type="submit" class="btn">Ajukan Janji Temu</button>
      </form>
      <div class="success-message" id="successMessage">
        Janji temu Anda berhasil dibuat!
      </div>
    </section>
  </main>

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
  

  <script src="janji temu.js"></script>
</body>
</html>