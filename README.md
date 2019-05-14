# jatim-doubletrack-2018

# Aturan
1. Ada tiga branch development, staging, master.
	a. Development untuk pengembangan awal
	b. Master untuk production
2. Setiap membuat fitur harus membuat branch sendiri dengan format [Nama]/[Fitur], apabila sudah jadi silahkan merge ke development.
3. Variabel menggunakan snake_case
4. Fungsi menggunakan camelCase
5. Class menggunakan StudlyCaps

# Cara Deployment Lokal
1. Copy config.php.sample -> config.php
 - Edit base_url jika diperlukan.
2. Copy constant.php.sample -> constan.php
3. Copy database.php.sample -> database.php
 - Edit koneksi ke databasenya.
4. Buat file .htaccess ke direktori public -> file htaccess CI biasa (Jika pakai Apache2)

