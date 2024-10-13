<?php
$sql = "CREATE TABLE IF NOT EXISTS images (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabel image berhasil dibuat<br>";
} else {
    echo "Error membuat tabel agama: " . $conn->error . "<br>";
}
?>