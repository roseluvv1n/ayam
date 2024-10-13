<?php
$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    id_agama INT(6) ,
    
    id_kelas INT(6) ,
    id_jurusan INT(6) ,
    id_jenis_kelamin INT(6) ,
    id_image INT(6) ,
    FOREIGN KEY (id_agama) REFERENCES agama(id),
   
    FOREIGN KEY (id_kelas) REFERENCES kelas(id),
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id),
    FOREIGN KEY (id_jenis_kelamin) REFERENCES jenis_kelamin(id),
    FOREIGN KEY (id_image) REFERENCES images(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel user berhasil dibuat<br>";
} else {
    echo "Error membuat tabel user: " . $conn->error . "<br>";
}
?>
