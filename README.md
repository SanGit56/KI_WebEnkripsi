# KI_WebEnkripsi
Web enkripsi sebagai tugas mata kuliah Keamanan Informasi
## Kebutuhan
1. Skema basis data
2. _Frontend_<br />
    Dibagi menjadi panel-panel:<br />
    ![Layout](layout.png)<br />
    a. Panel 1 berisi formulir isian _username_ dan _password_<br />
    b. Panel 2 berisi data mentah dari tabel pada _database_ (data terenkripsi)<br />
    c. Panel 3 berisi data yang telah diterjemahkan<br />
3. _Backend_<br />
    a. Validasi _form_ cukup pakai HTML<br />
    b. Jumlah pengguna tetap (tidak ada fitur CRUD untuk pengguna), telah tersedia di sistem, dan akan ditulis informasi untuk _login_-nya di situs<br />
    c. Sistem hanya untuk mengunggah data, menyimpannya menggunakan 3 metode enkripsi berbeda, dan mengambil kembali data untuk dibaca atau diunduh