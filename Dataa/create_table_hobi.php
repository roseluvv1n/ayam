<?php

$sql = "CREATE TABLE IF NOT EXISTS hobi (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    nama_hobi VARCHAR(50) NOT NULL
)";

$insert = "INSERT INTO hobi(nama_hobi) VALUES
            ('Bersepeda'),
            ('Berenang'),
            ('Berkemah'),
            ('Memancing')";

if ($conn->query($sql) === TRUE) {
    echo "Tabel hobi berhasil dibuat<br>";
} else {
    echo "Error membuat tabel hobi: " . $conn->error . "<br>";
}
$conn->query($insert)
?>
