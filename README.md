# Web Enkripsi

## Deskripsi
Situs _web_ untuk mengunggah data, teks dan file, dan menyimpannya menggunakan 3 metode enkripsi berbeda: AES, RC4, dan DES. Serta dapat mengambil data kembali untuk dibaca dan diunduh. Belum ada fitur CRUD untuk pengguna. Oleh karena itu, untuk menggunakan, masih memakai akun yang telah disediakan. Pengembangan berikutnya adalah untuk menambahkan fitur CRUD untuk pengguna.

## Skema Basis Data
Tabel-tabel untuk menyimpan data memiliki kolom rujukan ke tabel pengguna, data pribadi (merujuk pada UU PDP), dokumen-dokumen, serta untuk IV (_initialization vector_) dan _key_. Terdiri atas 4 tabel: <br />
1. **ki_pengguna** <br />
    Untuk menyimpan akun pengguna <br />
2. **ki_aes** <br />
    Untuk menyimpan data yang dienkripsi menggunakan AES <br />
3. **ki_rc4** <br />
    Untuk menyimpan data yang dienkripsi menggunakan RC4 <br />
4. **ki_des** <br />
    Untuk menyimpan data yang dienkripsi menggunakan DES

## Laman
### index.php
Laman berisi _form_ untuk masuk (_login_) dan daftar akun yang dapat digunakan.

### baca.php
Laman untuk membaca data sesuai pengguna, dari tabel (terenkripsi) dan yang sudah didekripsi dengan tampilan per baris. Serta _form_ untuk menambahkan data. Juga dilengkapi tombol untuk mengunduh data sesuai jenis enkripsi yang dipakai.

### tambah.php
Melakukan penambahan data yang diisi melalui _form_ menggunakan 3 algoritma enkripsi.

### unduh.php
Mengambil data dari basisdata. Membuka file dengan format zip. Mencari file terenkripsi di direktori yang sebelumnya telah dibuat oleh **tambah.php**. Melakukan dekripsi sesuai jenis yang diminta. Membuat direktori baru untuk file yang datanya telah didekripsi. Menyimpan file terdekripsi ke direktori baru yang telah dibuat. Menutup file dengan format zip yang masih terbuka. Membuat agar file dapat diunduh oleh pengguna.

## Kendala
1. Tidak menemukan _library_ untuk algoritma RC4. OpenSSL tidak lagi menyediakan RC4.
2. Untuk beberapa file dokumen tidak dapat diunggah jika digunakan enkripsi AES dan DES karena ada masalah penamaan (terdapat karakter '/').
3. Untuk beberapa file gambar tidak dapat diunggah jika digunakan enkripsi DES karena ada masalah penamaan (terdapat karakter '/')
4. Proses zip file tidak sempurna (bisa membuka dan mengisi file, tapi tidak bisa menutup) sehingga file zip yang diunduh tidak bisa diekstrak atau dibuka. File juga masih terhitung kosong.