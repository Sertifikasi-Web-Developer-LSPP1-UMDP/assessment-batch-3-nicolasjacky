[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/UwpJJG2e)

# Aplikasi Pendaftaran Mahasiswa Baru

Sistem Pendaftaran Mahasiswa adalah aplikasi berbasis web yang memungkinkan mahasiswa untuk mendaftar akun untuk mengisi formulir sebagai calon mahasiswa batu. Aplikasi ini juga menyediakan antarmuka untuk admin untuk memverifikasi pendaftaran mahasiswa dan mengelola informasi.

## Fitur

- **Register Mahasiswa**: Mahasiswa dapat membuat akun terlebih dahulu
- **Login**: Mahasiswa dan admin dapat masuk ke sistem menggunakan email dan password.
- **Pendaftaran Mahasiswa**: Mahasiswa dapat mendaftar dengan mengisi formulir pendaftaran.
- **Verifikasi Akun**: Admin dapat memverifikasi atau membatalkan verifikasi akun mahasiswa.
- **Status Pendaftaran**: Mahasiswa dapat melihat status pendaftaran mereka setelah akun diverifikasi oleh admin.
- **Manajemen Informasi**: Admin dapat mengelola informasi yang ditampilkan di aplikasi.
- **CRUD**: Fitur tambah, edit, dan hapus informasi yang dapat dilakukan oleh admin
- **ubah status pendaftaran mahasiswa**: Admin dapat mengubah status pendaftaran mahasiswa (pending, ditolak, dan diterima)

## Teknologi yang Digunakan

- **Laravel**: Framework PHP untuk pengembangan aplikasi web.
- **Bootstrap**: Framework CSS untuk desain aplikasi web.
- **MySQL**: Database untuk menyimpan data pengguna dan pendaftaran.

## Instalasi

1. Clone Repository : git clone (https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/UwpJJG2e)
2. cd repo-name
3. composer install ： Menginstal semua dependensi PHP yang didefinisikan di file composer.json.
Dependensi ini mencakup Laravel framework dan library tambahan seperti illuminate/auth, illuminate/routing, dll.
4. npm install ： Digunakan untuk frontend (CSS, JavaScript) seperti Bootstrap, Tailwind, Vue.js, atau React.
5. Atur konfigurasi database di file .env: 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=username_database
    DB_PASSWORD=password_database

6. php artisan key:generate ： Menghasilkan kunci aplikasi unik untuk Laravel.
Kunci ini digunakan untuk enkripsi data, termasuk session, cookie, dan token.
7. php artisan migrate ： Menjalankan file migrasi yang ada di folder database/migrations （membuat tabel)
9. php artisan serve : Menjalankan server bawaan Laravel untuk mengembangkan dan menguji aplikasi secara lokal.


## Spesifikasi 
Web Server: Apache 
Sistem operasi : Windows 11
Database: MySQL 


## Depedensi
PHP: Versi 8.2.4 atau lebih baru
laravel: Versi 11.35.0


## Route inti
### **Route Publik**
- `/start`: Halaman utama aplikasi.
- `/daftar`: Halaman pendaftaran mahasiswa.
- `/login`: Halaman login untuk mahasiswa dan admin.

### **Route Fitur Mahasiswa**
- `/status-pendaftaran/{userId}`: Mahasiswa dapat melihat status pendaftaran mereka setelah diverifikasi.

### **Route Fitur Admin**
- `/admin`: Dashboard admin untuk mengelola informasin pendaftaran calon mahasiswa dan memverifikasi akun calon mahasiswa
- `/verifikasi/{id}`: Admin dapat memverifikasi akun mahasiswa.
- `/batalkan-verifikasi/{id}`: Admin dapat membatalkan verifikasi akun mahasiswa.
- `/simpan-informasi`: Admin dapat menambah informasi baru.
- `/edit-informasi/{id}`: Admin dapat mengedit informasi tertentu.
- `/hapus-informasi/{id}`: Admin dapat menghapus informasi tertentu.


## Dokumentasi gambar

### Halaman Utama
![Halaman Utama](https://raw.githubusercontent.com/Sertifikasi-Web-Developer-LSPP1-UMDP/assessment-batch-3-nicolasjacky/refs/heads/main/lsp_2125250033/halamanutama.png?token=GHSAT0AAAAAAC32QRDLN5CKZTUKYYW5IOCSZ25CNJA)

### Halaman Pendaftaran
![Halaman Pendaftaran](screenshots/registration.png)

### Halaman Login
![Halaman Login](screenshots/login.png)

### Dashboard Admin
![Dashboard Admin](screenshots/admin-dashboard.png)