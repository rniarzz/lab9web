<h1 align="center"><b>Praktikum 9</b></h1> 

**Nama: Rini Ariza**

**NIM: 312210337**

**Kelas: TI.22.A3**

---

## Instruksi Praktikum
1. Persiapkan text editor misalnya VSCode. 2. Buat folder baru dengan nama lab9_php_modular pada docroot webserver
(htdocs)
3. Ikuti langkah-langkah praktikum yang akan dijelaskan berikutnya.

## Langkah-langkah Praktikum
### Buat file baru dengan nama header.php

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh Modularisasi</title>
    <link href="style.css" rel="stylesheet" type="text/stylesheet"
media="screen" />
</head>
<body>
    <div class="container">
        <header>
    <h1>Modularisasi Menggunakan Require</h1>
    </header>
    <nav>
        <a href="home.php">Home</a>
        <a href="about.php">Tentang</a>
        <a href="kontak.php">Kontak</a>
    </nav>
```

### Buat file baru dengan nama ```footer.php```

```php
        <footer>
            <p>&copy; 2021, Informatika, Universitas Pelita Bangsa</p>
        </footer>
    </div>
</body>
</html>
```

### Buat file baru dengan nama ```home.php```

```php
<?php require('header.php'); ?>
<div class="content">
    <h2>Ini Halaman Home</h2>
    <p>Ini adalah bagian content dari halaman.</p>
</div>
<?php require('footer.php'); ?>
```

### Buat file baru dengan nama ```about.php```

```php
<?php require('header.php'); ?>
<div class="content">
    <h2>Ini Halaman About</h2>
    <p>Ini adalah bagian content dari halaman.</p>
</div>
<?php require('footer.php'); ?>
```

## Output

### Halaman Home

![Screenshot (509)](https://github.com/rniarzz/lab9web/assets/115542704/30eed0bb-84b8-425e-8e2e-5093e8a2247a)

### Halaman About

![Screenshot (510)](https://github.com/rniarzz/lab9web/assets/115542704/40157abf-a063-4b8a-a787-d2e82e6a4622)

## Pertanyaan dan Tugas

### Implementasikan konsep modularisasi pada kode program praktikum 8 tentang database, sehingga setiap halamannya memiliki template tampilan yang sama.

## Berikut struktur yang saya buat

### Config
Dalam folder tersebut menyimpan file khusus php yang nanti akan dieksekusi

#### koneksi.php

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "latihan1";
$port = 3307;
$conn = mysqli_connect($host, $user, $pass, $db, $port);
if ($conn == false)
{
echo "Koneksi ke server gagal.";
die();
} #else echo "Koneksi berhasil";

$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);

?>
```

#### tambah.php

```php
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';
if (isset($_POST['submit']))
{
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;
    if ($file_gambar['error'] == 0){
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)){
            $gambar = 'gambar/' . $filename;;
        }
    }
    $sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli, stok, gambar) ';
    $sql .= "VALUE ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
?>
```

#### ubah.php

```php
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';
if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;
    if ($file_gambar['error'] == 0)
    {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination))
        {
            $gambar = 'gambar/' . $filename;;
        }
    }
    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
    if (!empty($gambar)) $sql .= ", gambar = '{$gambar}' ";
    $sql .= "WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);
function is_select($var, $val)
{
    if ($var == $val) return 'selected="selected"';
    return false;
}
?>
```

#### hapus.php

```php
<?php
include_once 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
header('location: ../index.php');
?>
```

### layouts

Untuk menyimpan tampilan utama pada website, dan dibagi pada beberapa file

#### head-static.php

```php
<meta charset="UTF-8">
<link href="static/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
```

#### header.php

```php
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require('head-static.php'); ?>
    <title>Data Barang</title>
  </head>
  <body>
    <div class="container ">
      <h1>Data Barang</h1>
      <a href="tambah.php">Tambah Barang</a>
```

#### main.php

```php
<div class="main mt-4">
        <table border="1" cellpadding="5" cellspacing="0">
          <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr> 
          <?php if($result): ?> <?php while($row = mysqli_fetch_array($result)): ?> 
          <tr>
            <td>
              <img src="gambar/ <?= $row['gambar'];?>" alt="<?= $row['nama'];?>">
            </td>
            <td> <?= $row['nama'];?> </td>
            <td> <?= $row['kategori'];?> </td>
            <td> <?= $row['harga_beli'];?> </td>
            <td> <?= $row['harga_jual'];?> </td>
            <td> <?= $row['stok'];?> </td>
            <td> <a class="badge badge-pill badge-primary" href="ubah.php?id=<?php echo $row['id_barang']; ?>">Ubah</a>
            	 / <a class="badge badge-pill badge-danger" href="config/hapus.php?id=<?php echo $row['id_barang']; ?>">Hapus</a>  
            </td> 
            
          </tr> <?php endwhile; else: ?> <tr>
            <td colspan="7">Belum ada data</td>
          </tr> <?php endif; ?>
        </table>
      </div>
```

#### footer.php

```php
	
		<footer class="mt-4 pt-4" >
			<p>&copy; 2022 | rniarzz</p>
    	</footer>
    </div>
  </body>
</html>
```

### Static

Untuk menyimpan file yang diperlukan seperti css, js, gambar

#### Style.css

```css
.container{
	margin-top: 3%;
	font-size: 1.1em;
}
table, th, td{
	border: 1px solid black;
	padding: 10px;
	border-collapse: collapse;
}
tr:nth-child(even) {background-color: #f2f2f2;}
label {
  	display: inline-block;
  	width: 120px;
  	padding-right: 20px;
  	padding-bottom: 20px;
}
input,
textarea {
  	font: 1em sans-serif;
  	box-sizing: border-box;
}
input[type=text] {
  	padding: 4px 0;
  	width: 250px;
}
input[type=file] {
  padding: 4px 0;
  width: 250px;
}
input[type=submit] {
  	position: relative;
	left: 144px;
  	padding: 8px 14px;
  	border-radius: 4px;
  	background-color: #0069FF;
  	border: none;
  	color: white;
  	text-decoration: none;
  	cursor: pointer;
}
select {
  	padding: 8px 50px;
  	border: none;
  	border-radius: 4px;
  	background-color: #f1f1f1;
}
```

### index.php, tambah.php, ubah.php

File utama dan berfungsi sebagai wadah untuk memanggil sub-file di beberapa direktori

### index.php

```php
<?php require('config/koneksi.php'); ?>
<?php require('layouts/header.php'); ?>
<?php require('layouts/main.php'); ?>
<?php require('layouts/footer.php'); ?>
```

#### tambah.php

```php
<?php require('config/tambah.php'); ?>
<?php require('layouts/tambah.php'); ?>
```

#### ubah.php

```php
<?php require('config/ubah.php'); ?>
<?php require('layouts/ubah.php'); ?>
```

### Output

![Screenshot (513)](https://github.com/rniarzz/lab9web/assets/115542704/936cacc0-7ad5-4826-9f97-f305e2b9b68f)

#### Tambah barang

![Screenshot (516)](https://github.com/rniarzz/lab9web/assets/115542704/ec9eeb60-3ce5-42f4-a7f0-3f33b40fecbb)

![Screenshot (518)](https://github.com/rniarzz/lab9web/assets/115542704/e6451549-2b24-42e9-a86a-772a3ed6b7b0)

#### Ubah barang

![Screenshot (514)](https://github.com/rniarzz/lab9web/assets/115542704/9ef2b6d9-342f-49c5-bf2b-b637cf57ca39)

![Screenshot (517)](https://github.com/rniarzz/lab9web/assets/115542704/5f0009f3-7fbf-488c-a80c-1581897bc656)

#### Hapus barang

![IMG_20231128_211235](https://github.com/rniarzz/lab9web/assets/115542704/83c0b779-069a-4276-9216-bbf7fd5a2b59)

![Screenshot (520)](https://github.com/rniarzz/lab9web/assets/115542704/dcbe56f5-2678-4b24-bb29-6b6d542833e9)

<h1 <p align="center"><b>======== Sekian Terima Kasih ==========</b></p></h1>
