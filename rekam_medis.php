<?php
// Mulai sesi
session_start();

// Masukkan koneksi ke database
include('dbconn.php');

// Pesan untuk menampilkan hasil aksi (berhasil atau gagal)
$message = "";

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $patient_name = $_POST['patient_name'];
    $dob = $_POST['dob'];
    $complaints = $_POST['complaints'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $doctor = $_POST['doctor'];

    // Query untuk menyimpan data rekam medis ke database
    $sql = "INSERT INTO medical_records (patient_name, dob, complaints, diagnosis, treatment, doctor) 
            VALUES ('$patient_name', '$dob', '$complaints', '$diagnosis', '$treatment', '$doctor')";

    // Mengeksekusi query dan mengecek apakah berhasil
    if ($conn->query($sql) === TRUE) {
        $message = "Rekam medis berhasil disimpan!";
    } else {
        $message = "Terjadi kesalahan: " . $conn->error;
    }
}

// Query untuk mengambil data rekam medis
$sql = "SELECT * FROM medical_records ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css" />
    <title>NumberOneHealth</title>
    <style>
    /* Global Styling */
    body {
        font-family: 'Rubik', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        width: 90%;
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Styling Form */
    .form-container {
        margin-bottom: 30px;
    }

    .form-container input,
    .form-container textarea,
    .form-container button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-container input[type="text"],
    .form-container input[type="date"] {
        width: 48%;
        display: inline-block;
    }

    .form-container textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-container button {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .form-container button:hover {
        background-color: #45a049;
    }

    /* Styling Table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    td {
        background-color: #ffffff;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .form-container input[type="text"],
        .form-container input[type="date"] {
            width: 100%;
            display: block;
        }

        .form-container textarea {
            width: 100%;
        }

        table {
            font-size: 14px;
        }

        th, td {
            padding: 10px;
        }
    }
</style>

</head>
<body>
<header>
    <div class="logo">
        <img src="Images/LogoNumberOneHealth.png" alt="NumberOneHealth Logo" />
        <a>Number<span>ONE</span>Health</a>
    </div>

    <nav class="navbar">
        <a href="index.php">Beranda</a>
        <a href="index.php">Layanan Kami</a>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="rekam_medis.php">Rekam Medis</a>
        <?php endif; ?>
        <a href="index.php">Temukan Dokter</a>
        <a href="index.php">Berita</a>
    </nav>

    <?php if(!isset($_SESSION['role'])): ?>
        <a href="login.php" class="btn">Login</a>
    <?php else: ?>
        <a href="logout.php" class="btn">Logout</a>
    <?php endif; ?>
</header>

<main>
    <div class="container">
        <h1>Daftar Rekam Medis Pasien</h1>
        
        <?php
        // Menampilkan pesan jika ada
        if (isset($message)) {
            echo "<p style='color: green;'>$message</p>";
        }
        ?>
        <br><br>

        <!-- Form untuk menambah data rekam medis -->
        <div class="form-container">
            <h2>Tambah Rekam Medis</h2><br>
            <form action="rekam_medis.php" method="POST">
                <label for="patient_name">Nama Pasien:</label><br>
                <input type="text" id="patient_name" name="patient_name" required><br>

                <label for="dob">Tanggal Lahir:</label><br>
                <input type="date" id="dob" name="dob" required><br>

                <label for="complaints">Keluhan:</label>
                <textarea id="complaints" name="complaints" required></textarea>

                <label for="diagnosis">Diagnosis:</label>
                <textarea id="diagnosis" name="diagnosis" required></textarea>

                <label for="treatment">Pengobatan:</label>
                <textarea id="treatment" name="treatment" required></textarea>

                <label for="doctor">Nama Dokter:</label><br>
                <input type="text" id="doctor" name="doctor" required>

                <button type="submit">Simpan Rekam Medis</button>
            </form>
        </div>

        <!-- Tabel Rekam Medis -->
        <h2>Daftar Rekam Medis</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Lahir</th>
                    <th>Keluhan</th>
                    <th>Diagnosis</th>
                    <th>Pengobatan</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Jika ada data dalam tabel
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['patient_name'] . "</td>
                                <td>" . $row['dob'] . "</td>
                                <td>" . nl2br($row['complaints']) . "</td>
                                <td>" . nl2br($row['diagnosis']) . "</td>
                                <td>" . nl2br($row['treatment']) . "</td>
                                <td>" . $row['doctor'] . "</td>
                                <td>" . $row['created_at'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data rekam medis.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<footer>
    <div class="footer-top">
        <div class="footer-box">
            <div class="footer-grid">
                <div class="footer-logo-info">
                    <h2><img src="Images/LogoNumberOneHealth.png" alt="Logo" class="footer-logo">
                        <a>Number<span>ONE</span>Health</a></h2>
                </div>
                <!-- Email Section -->
                <div class="footer-contact">
                    <i class="fa-regular fa-envelope-open"></i>
                    <p>Email: NumberOneHealth@gmail.com<br>Inquiries: infoOneHealth@gmail.com</p>
                </div>

                <!-- Phone Section -->
                <div class="footer-contact">
                    <i class="fa-solid fa-phone"></i>
                    <p>Office Telephone: 0029129102320<br>Mobile: 000 2324 39493</p>
                </div>

                <!-- Location Section -->
                <div class="footer-contact">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>Office Location:<br>Semangat Perjuangan No 100</p>
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
        <p>© 2024 NumberONEHealth | All Rights Reserved</p>
    </div>
</footer>

</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
