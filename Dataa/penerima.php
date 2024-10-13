<?php
include 'resize_image.php';
include 'connection.php';

function redirectToIndex($message) {
    echo "<script>
            alert('$message');
            window.location.href = 'index.php';
          </script>";
    exit();
}

$dirupload       = "asset/ori/";
$dirupload2      = "asset/thumbnail/";
$namaFile        = $_FILES['file']['name'];
$temporary       = $_FILES['file']['tmp_name'];
$fileSize        = $_FILES['file']['size'];
$fileExtension   = pathinfo($namaFile, PATHINFO_EXTENSION);
$allowedTypes    = ['jpeg', 'jpg', 'png'];
$maxFileSize     = 10 * 1024 * 1024; // 10 MB

if (!in_array(strtolower($fileExtension), $allowedTypes)) {
    redirectToIndex("Only JPEG and PNG files are allowed.");
}
if ($fileSize > $maxFileSize) {
    redirectToIndex("File size exceeds 10 MB.");
}

$newFileName   = date("Y-m-d H.i.s") . '.' . $fileExtension;
$filepath       = $dirupload . $newFileName;
$thumbnailPath = $dirupload2 . $newFileName;

if (move_uploaded_file($temporary, $filepath)) {
    if (resizeImage($filepath, 100, 100, $thumbnailPath)) {
        echo "File uploaded and resized successfully.<br>" ; 
        
        // Ambil data dari form
        $nama = $_POST['nama'];
        $agama = $_POST['agama'];
        $jenis = $_POST['jenis'];
        $kelas = $_POST['kelas'];
        $jurusan = $_POST['jurusan'];
        $images = $filepath; // Simpan path gambar yang diunggah
        $hobiArray = $_POST['hobi']; // Asumsikan ini adalah array dengan beberapa hobi

        // Masukkan data ke tabel agama, jenis_kelamin, kelas, jurusan, dan images
        $conn->query("INSERT INTO `agama` (`nama_agama`) VALUES ('$agama')");
        $id_agama = $conn->insert_id; 
        $conn->query("INSERT INTO `jenis_kelamin` (`jenis_kelamin`) VALUES ('$jenis')");
        $id_jenis_kelamin = $conn->insert_id; 
        $conn->query("INSERT INTO `kelas` (`nama_kelas`) VALUES ('$kelas')");
        $id_kelas = $conn->insert_id; 
        $conn->query("INSERT INTO `jurusan` (`nama_jurusan`) VALUES ('$jurusan')");
        $id_jurusan = $conn->insert_id; 
        $conn->query("INSERT INTO `images` (`image_url`) VALUES ('$images')");
        $id_images = $conn->insert_id; 

        // Masukkan data ke tabel user
        $conn->query("INSERT INTO `user` (`nama`, `id_agama`, `id_kelas`, `id_jurusan`, `id_jenis_kelamin`, `id_image`) 
                      VALUES ('$nama', $id_agama, $id_kelas, $id_jurusan, $id_jenis_kelamin, $id_images)");
        $user_id = $conn->insert_id;

        // Masukkan data ke tabel user_hobi
        foreach ($hobiArray as $hobi) {
            $conn->query("INSERT INTO `hobi` (`nama_hobi`) VALUES ('$hobi')");
            $hobi_id = $conn->insert_id;
            $conn->query("INSERT INTO `user_hobi` (`user_id`, `hobi_id`) VALUES ($user_id, $hobi_id)");
        }

        // Tampilkan semua data dari tabel user
        $result = $conn->query("SELECT u.id, u.nama, a.nama_agama, jk.jenis_kelamin, k.nama_kelas, j.nama_jurusan, i.image_url, h.nama_hobi 
                                FROM `user` u
                                JOIN `agama` a ON u.id_agama = a.id
                                JOIN `jenis_kelamin` jk ON u.id_jenis_kelamin = jk.id
                                JOIN `kelas` k ON u.id_kelas = k.id
                                JOIN `jurusan` j ON u.id_jurusan = j.id
                                JOIN `images` i ON u.id_image = i.id
                                JOIN `user_hobi` uh ON u.id = uh.user_id
                                JOIN `hobi` h ON uh.hobi_id = h.id");

        if ($result->num_rows > 0) {
            echo '<div class="data-container">';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="data-box">';
                echo '<div class="profile-image">';
                echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="Profile Picture">';
                echo '</div>';
                echo '<div class="data-info">';
                echo "<div class='data-item'><strong>Nama Lengkap:</strong> " . htmlspecialchars($row['nama']) . "</div>";
                echo "<div class='data-item'><strong>Jenis Kelamin:</strong> " . htmlspecialchars($row['jenis_kelamin']) . "</div>";
                echo "<div class='data-item'><strong>Kelas:</strong> " . htmlspecialchars($row['nama_kelas']) . "</div>";
                echo "<div class='data-item'><strong>Jurusan:</strong> " . htmlspecialchars($row['nama_jurusan']) . "</div>";
                echo "<div class='data-item'><strong>Agama:</strong> " . htmlspecialchars($row['nama_agama']) . "</div>";
                echo "<div class='data-item'><strong>Hobi:</strong> " . htmlspecialchars($row['nama_hobi']) . "</div>";
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "No data found.";
        }

    } else {
        echo "Failed to resize image.";
    }
} else {
    echo "Failed to upload file.";
}
?>


<style>
    .data-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }
    .data-box {
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: calc(33.333% - 40px); /* 3 kotak dalam satu baris, dengan jarak */
        box-sizing: border-box;
        display: flex;
        align-items: center;
    }
    .profile-image {
        margin-right: 20px;
    }
    .profile-image img {
        width: 100px;
        height: 100px;
        border-radius: 50%; /* Membuat gambar menjadi bulat */
        object-fit: cover; /* Menjaga rasio gambar */
    }
    .data-info {
        flex: 1;
    }
    .data-item {
        margin-bottom: 10px;
        word-wrap: break-word;
    }
    .data-item strong {
        display: inline-block;
        width: 120px; /* Lebar label */
    }
</style>
