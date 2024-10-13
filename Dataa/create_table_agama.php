<?php
$sql = "CREATE TABLE IF NOT EXISTS agama (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    nama_agama VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel agama berhasil dibuat<br>";
} else {
    echo "Error membuat tabel agama: " . $conn->error . "<br>";
}
$insert = "INSERT INTO agama (nama_agama) VALUES
            ('Islam'),
            ('Kristen'),
            ('Hindu'),
            ('Budha')";
            $conn->query($insert)

?>
