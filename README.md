# Web Enkripsi

## Deskripsi
Situs _web_ untuk mengunggah data, teks dan file, dan menyimpannya menggunakan 3 metode enkripsi berbeda: AES, RC4, dan DES. Serta dapat mengambil data kembali untuk dibaca atau diunduh. Jumlah pengguna tetap, karena itu tidak ada fitur CRUD untuk pengguna.

## Skema Basis Data
Tabel-tabel untuk menyimpan data memiliki kolom rujukan ke tabel pengguna, data pribadi (merujuk pada UU PDP), dokumen-dokumen, serta untuk IV (_initialization vector_) dan _key_. Terdiri atas 4 tabel:<br />
1. **ki_pengguna** untuk menyimpan akun pengguna<br />
2. **ki_aes** untuk menyimpan data yang dienkripsi menggunakan AES<br />
3. **ki_rc4** untuk menyimpan data yang dienkripsi menggunakan RC4<br />
4. **ki_des** untuk menyimpan data yang dienkripsi menggunakan DES

## Penjelasan
### 1. index.php
Laman berisi _form_ untuk masuk (_login_) dan daftar akun yang dapat digunakan.

### 2. baca.php
Laman untuk membaca data sesuai pengguna, dari tabel (terenkripsi) dan yang sudah didekripsi. Serta _form_ untuk menambahkan data.

### 3. tambah.php
Melakukan penambahan data yang diisi melalui _form_ menggunakan 3 algoritma enkripsi.

## Kendala
1. Tidak menemukan _library_ untuk algoritma RC4. OpenSSL tidak lagi menyediakan RC4
2. Untuk beberapa file dokumen tidak dapat diunggah jika digunakan enkripsi AES dan DES karena ada masalah penamaan (terdapat karakter "/")
2. Untuk beberapa file gambar tidak dapat diunggah jika digunakan enkripsi DES karena ada masalah penamaan (terdapat karakter "/")