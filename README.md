# Web Enkripsi

## Deskripsi
Situs _web_ untuk mengunggah data, teks dan file, dan menyimpannya menggunakan 3 metode enkripsi berbeda: AES, RC4, dan DES. Serta dapat mengambil data kembali untuk dibaca/dilihat dan diunduh. Belum ada fitur CRUD untuk pengguna. Oleh karena itu, untuk menggunakan, masih memakai akun yang telah disediakan

## Skema Basis Data
Tabel-tabel untuk menyimpan data memiliki kolom rujukan ke tabel **ki_pengguna**, data pribadi (merujuk pada (UU PDP)[https://peraturan.bpk.go.id/Details/229798/uu-no-27-tahun-2022]), dokumen-dokumen, serta untuk IV (_initialization vector_) dan _key_. Terdiri atas 4 tabel: <br />
1. **ki_pengguna** <br />
    Berisi data kredensial pengguna <br />
2. **ki_aes** <br />
    Berisi data yang dienkripsi menggunakan AES <br />
3. **ki_rc4** <br />
    Berisi data yang dienkripsi menggunakan RC4 <br />
4. **ki_des** <br />
    Berisi data yang dienkripsi menggunakan DES <br />
5. **ki_minta_akses** <br />
    Berisi data pengguna yang memohon akses ke data pengguna lain, pengguna yang dimohonkan akses, dan status akses apakah diterima atau tidak <br />
6. **ki_minta_akses** <br />
    Berisi data permintaan akses, rekord data yang bisa diakses, dan kunci untuk enkripsi

## Laman
Pada (hampir) tiap laman, ada pengecekan apakah pengguna yang masuk laman tersebut terdaftar

### index.php
Laman berisi _form_ untuk masuk (_login_) dan daftar akun yang dapat digunakan (data dari tabel **ki_pengguna**)

### baca.php
Jika pengguna yang masuk terdaftar, maka sistem akan membuat folder **data_unggah/**. Segala data yang ditampilkan hanya yang berkaitan dengan pengguna masuk. Terdapat _form_ untuk menambahkan data, termasuk mengunggah file. Isian _form_ wajib diisi semua. Di bawahnya, ada tabel permohonan (permintaan dan pemberian) akses dari tabel ki_minta_akses. Lalu ada tombol-tombol untuk mengunduh file-file yang sebelumnya telah diunggah. Tiga tabel selanjutnya adalah tabel **ki_aes**, **ki_rc4**, **ki_des** yang menampilkan data asli dari tabel pada baris ganjil dan data yang telah didekripsi dari program pada baris genap. Juga untuk data file seperti gambar dan video, dapat langsung dilihat

### tambah.php
Membuat _initialization vector_ dan _encryption key_ untuk tiap jenis enkripsi. Kemudian mengecek isian dari _form_ yang berupa _string_ dan file. File dicek format dan ukurannya, jika tidak memenuhi, tidak bisa mengunggah data. Data isian dienkripsi menggunakan masing-masing jenis enkripsi dan dimasukkan tabel terkait. Selain itu, jika tabelnya adalah **ki_aes** dan pengguna masuk memberi akses ke pengguna lain, data saat itu akan diberikan aksesnya ke pengguna lain tersebut. File yang diunggah akan dibuatkan folder terpisah. Kemudian file akan dienkripsi, juga dengan tiap algoritma. File yang telah dienkripsi juga akan dibuatkan folder terpisah

### unduh.php
Mengambil data dari basisdata. Lalu membuka file zip. Selanjutnya mencari file terenkripsi di direktori yang sebelumnya telah dibuat oleh **tambah.php**. Kemudian melakukan dekripsi sesuai jenis yang diminta. Setelah itu membuat direktori baru untuk file yang datanya telah didekripsi. Berikutnya menyimpan file terdekripsi ke direktori baru yang telah dibuat. Sebelum dapat diunduh, menutup file zip yang masih terbuka. Terakhir, membuat agar file dapat diunduh oleh pengguna

### akses.php
Mengecek terlebih dulu mode akses yang diminta pengguna. Jika meminta (minta) akses, cek dulu apakah ajuan akses sudah ada. Jika belum, buat permintaan (menambah data di tabel ki_minta_akses) dengan status akses 0. Jika memberi (kasih) akses, cek dulu apakah sudah ada ajuan yang disetujui. Jika belum, ubah status akses pada data terkait menjadi 1

## Pengembangan
1. Menambahkan fitur untuk CRUD pengguna
2. Menambahkan fungsi untuk enkripsi menggunakan algoritma RC4
3. Memperbaiki fitur unduh file
4. Mengenkripsi _key_ untuk akses data pengguna lain menggunakan _asymmetric encryption_ 
5. Aktivasi akses menggunakan _key_ yang diberikan pemilik data bukan hanya dari tombol

## Kendala
1. Tidak menemukan _library_ untuk algoritma RC4. OpenSSL tidak lagi menyediakan RC4
2. Proses zip file tidak sempurna (bisa membuka dan mengisi file, tapi tidak bisa menutup) sehingga file zip yang diunduh tidak bisa diekstrak atau dibuka. File juga masih terhitung kosong