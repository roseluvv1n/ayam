<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="penerima.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" placeholder="Nama Lengkap" value="" required><br>
        <input type="radio" name="jenis" value="pria" checked required>Pria
        <input type="radio" name="jenis" value="Wanita" required>Wanita <br>
        <select name="agama" required>
            <option value="">-- Pilih Agama --</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Hindu">Hindu</option>
            <option value="Budha">Budha</option>
        </select> <br></BR>
        <select name="kelas" required>
            <option value="">-- Pilih Kelas --</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
        </select> <br></BR>
        <select name="jurusan" required>
            <option value="">-- Pilih jurusan --</option>
            <option value="RPL">RPL</option>
            <option value="TKJ">TKJ</option>
            <option value="DKV">DKV</option>
            <option value="MP">MP</option>
            <option value="AKL">AKL</option>
            <option value="BR">BR</option>
            <option value="TBS">TBS</option>
            <option value="TBG">TBG</option>
        </select> <br></BR>
        <input type="checkbox" name="hobi[]" value="Bersepeda"> Bersepeda<br>
        <input type="checkbox" name="hobi[]" value="Berenang"> Berenang<br>
        <input type="checkbox" name="hobi[]" value="Memancing"> Memancing<br>
        <input type="checkbox" name="hobi[]" value="Berkemah"> Berkemah<br>
        <br>
        <input type="file" name="file">
        <input type="submit" value="daftar">
    </form>    
</body>
</html>
