<?php
$sql = "CREATE TABLE IF NOT EXISTS kelas (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(50) NOT NULL
)";
$insert = "INSERT INTO kelas(nama_kelas) VALUES
        ('X'),
        ('XI'),
        ('XII')";

if ($conn->query($sql) === TRUE) {
    echo "Tabel kelas berhasil dibuat<br>";
} else {
    echo "Error membuat tabel kelas: " . $conn->error . "<br>";
}
$conn->query($insert)
?>
