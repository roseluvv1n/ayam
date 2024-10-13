<?php

$sql = "CREATE TABLE IF NOT EXISTS jenis_kelamin (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    jenis_kelamin VARCHAR(20) NOT NULL
)";

if ($conn->query($sql,) === TRUE) {
    echo "Tabel jenis_kelamin berhasil dibuat<br>";
} else {
    echo "Error membuat tabel jenis_kelamin: " . $conn->error . "<br>";
}
$insert = "INSERT INTO jenis_kelamin (jenis_kelamin) VALUES
            ('pria'),
            ('wanita')";
  $conn->query($insert)
?>
