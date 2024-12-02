USE si_kesehatan;

CREATE TABLE queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poli VARCHAR(50) NOT NULL,
    dokter VARCHAR(50) NOT NULL,
    nomor_antrian INT NOT NULL,
    waktu_antrian TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);