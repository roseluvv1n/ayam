<?php
$sql = "CREATE TABLE IF NOT EXISTS jurusan (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    nama_jurusan VARCHAR(50) NOT NULL
)";
$insert = "INSERT INTO jurusan(nama_jurusan) VALUES
        ('RPL'),
        ('TKJ'),
        ('DKV'),
        ('MP'),
        ('AKL'),
        ('BR'),
        ('TBS'),
        ('TBG')";

if ($conn->query($sql) === TRUE) {
    echo "Tabel jurusan berhasil dibuat<br>";
} else {
    echo "Error membuat tabel jurusan: " . $conn->error . "<br>";
}
$conn->query($insert)
?>