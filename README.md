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

![Uploading Screenshot (510).png…]()












<h1 <p align="center"><b>======== Sekian Terima Kasih ==========</b></p></h1>
