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

### Use case
![usecasediagram](https://github.com/user-attachments/assets/c334eeec-1b50-4b16-8754-9467e0addc7a)

### tabel
<img width="537" alt="tabel" src="https://github.com/user-attachments/assets/552a6cac-9aa9-4cf7-8acb-b83732bfb224" />

### Halaman Utama
<img width="956" alt="halamanutama" src="https://github.com/user-attachments/assets/b8298c59-7a8e-489b-9252-c61a8df76d1c" />

### Halaman Pendaftaran
<img width="958" alt="halamanregister" src="https://github.com/user-attachments/assets/f8bc3f43-4c3f-4733-80d6-beccec092201" />

### Halaman Login
<img width="959" alt="halamanlogin" src="https://github.com/user-attachments/assets/504b3247-3cdc-4c79-bac3-a9dea2ef1917" />

### Halaman Mahasiswa 
<img width="932" alt="halamanmahasiswa" src="https://github.com/user-attachments/assets/83b0d9c5-3a7c-4efb-9049-7b5667b8aa0e" />
<img width="931" alt="halamanmahasiswa2" src="https://github.com/user-attachments/assets/d2dab128-a4dc-4c05-8e6e-195e311b8ce0" />

### Dashboard Admin Bagian User Mahasiswa
<img width="937" alt="adminuser" src="https://github.com/user-attachments/assets/7b02f0b0-0a46-45bc-9d4c-468bc0c58cfb" />

### Dashboard Admin Bagian Formulir
<img width="955" alt="adminformulir" src="https://github.com/user-attachments/assets/dbb4ab7a-1d2c-475a-bb3d-e3e0e78bb689" />

### Dashboard Admin Bagian Informasi
<img width="904" alt="admininformasi" src="https://github.com/user-attachments/assets/4a2397b3-4afe-4d55-b44b-300dadf59c15" />
