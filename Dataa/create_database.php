<?php
// koneksi ke database $servername dll variabel
$servername = "localhost";
$username = "root";
$password = "";
$dbname   = "pelajar";


$conn = new mysqli($servername,$username,$password);
$drop = "DROP DATABASE IF EXISTS pelajar";
$conn->query($drop);
$sql  = "CREATE DATABASE pelajar";
    if ($conn->query($sql) === TRUE) {
        echo "Database Create succesfully<br>";
      } else {
        echo "Error creating database:" . $conn->error ;
      }
      // call database
     // $database = 'pelajar';
      //mysqli_select_db($conn ,$database);
      $conn->select_db($dbname);
      
     include "connection.php";
     include "create_table_agama.php";
     include "create_table_gender.php";
     include "create_table_kelas.php";
     include "create_table_jurusan.php";
     include "create_table_hobi.php";
     include "create_table_image.php";
  
     include "create_table_user.php";
     include "create_table_user_hobi.php";
    
    
