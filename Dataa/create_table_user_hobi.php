<?php
include 'connection.php';
$sql = "CREATE TABLE IF NOT EXISTS user_hobi (
    user_id INT(6) UNSIGNED,
    hobi_id INT(6),
    PRIMARY KEY (user_id, hobi_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (hobi_id) REFERENCES hobi(id)
)";
$insert = "INSERT INTO user_hobi (user_id, hobi_id) VALUES
            ('1'),
            ('2')";
            
if ($conn->query($sql) === TRUE) {
    echo "Tabel user_hobi berhasil dibuat<br>"; 
} else {
    echo "Error membuat tabel user_hobi: " . $conn->error . "<br>"; 
}


$conn->close();
?>
