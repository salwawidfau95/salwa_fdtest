# 📚 Book Management App — Laravel Fullstack Developer Test

Aplikasi ini dikembangkan untuk menyelesaikan challenge Fullstack Developer — *FAN IT*.  
Tujuannya adalah membuat sistem manajemen buku dengan autentikasi dan CRUD berbasis Laravel.

Semua fitur frontend dibuat secara **manual menggunakan Blade + Tailwind CSS**, **tanpa Breeze atau starter kit**.

---

## 🚀 Fitur Aplikasi

### 🧑‍💻 1. Autentikasi Pengguna (Manual)
- Register, Login, Logout
- Validasi form di sisi server
- Redirect setelah login ke dashboard
- Status verifikasi email (dummy / tidak real email SMTP)

### 📚 2. Manajemen Buku (CRUD)
- Tambah, lihat, edit, dan hapus buku
- Field buku:
  - Title
  - Author
  - Description
  - Rating (1–5)
  - Cover image (upload ke storage)
- Setiap buku hanya bisa dimodifikasi oleh user yang membuatnya

### 🏠 3. Dashboard
- Menampilkan:
  - Nama dan email user
  - Status verifikasi email
  - Statistik:
    - Total buku
    - Rata-rata rating
    - Buku terakhir ditambahkan
- Tautan cepat ke halaman `Book Management`

### 👥 4. Halaman User List
- Menampilkan semua user terdaftar
- Fitur pencarian berdasarkan nama/email
- Filter user berdasarkan status verifikasi email

---

## 🧪 Unit Test

- ✅ Test untuk fitur Book:
  - Guest tidak bisa akses dashboard
  - User bisa melihat daftar buku miliknya

- ⚠️ Test untuk Auth (register/login/logout):
  - Sudah dibuat (`AuthTest.php`)
  - Namun **mengalami error CSRF token 419** meskipun middleware telah dicoba dinonaktifkan
  - **Fitur berjalan normal secara manual**, namun test otomatis gagal karena Laravel CSRF strict

---

## 🛠️ Teknologi

| Stack       | Detail                                     |
|-------------|--------------------------------------------|
| Backend     | Laravel 12                                 |
| Frontend    | Blade templating engine                    |
| Styling     | Tailwind CSS CDN                           |
| Auth        | Manual controller & route, validasi form   |
| Database    | PostgreSQL / SQLite (bisa disesuaikan)     |
| Upload File | Disimpan di `storage/app/public/covers`    |

---

## 📂 Struktur Folder Penting

app/
├── Http/
│ ├── Controllers/
│ │ ├── BookController.php
│ │ └── UserController.php
├── Models/
│ ├── Book.php
│ └── User.php
resources/
├── views/
│ ├── books/ ← index, create, edit, show
│ ├── users/ ← user list
│ ├── auth/ ← login, register, forgot-password
│ └── dashboard.blade.php
routes/
└── web.php

---

## ▶️ Cara Menjalankan Aplikasi

Untuk menjalankan aplikasi ini, cukup ikuti proses standar Laravel:

- Setelah meng-clone repository, jalankan `composer install` dan `npm install` untuk menginstal dependensi.
- Salin file `.env.example` ke `.env` dan jalankan `php artisan key:generate`.
- Lakukan migrasi database menggunakan `php artisan migrate`.
- Jalankan server lokal menggunakan `php artisan serve`.
- Jika ingin melihat cover image yang di-upload, jalankan juga `php artisan storage:link`.

Semua dependensi frontend (Tailwind CSS) telah disiapkan menggunakan CDN, sehingga tidak perlu konfigurasi tambahan.

---

## ✅ Checklist Fitur

| Fitur                                      | Status |
|--------------------------------------------|--------|
| Autentikasi Manual (register, login)       | ✅     |
| Validasi dan verifikasi email dummy        | ✅     |
| Manajemen Buku (CRUD lengkap)              | ✅     |
| Upload & tampilkan gambar cover            | ✅     |
| Dashboard statistik user                   | ✅     |
| Daftar user dengan pencarian & filter      | ✅     |
| Proteksi data buku hanya untuk pemiliknya  | ✅     |
| Frontend manual pakai Blade + Tailwind CDN | ✅     |
| Unit test (fitur buku)                     | ✅     |
| Unit test auth (error CSRF Laravel 10+)    | ⚠️     |

---

## 👤 Developer

**Nama:** Salwa Widfa Utami  
**Kebutuhan:** Tes Tehnikal PT. FAN Integrasi Teknologi
**Tanggal Selesai:** Juni 2025

---

## 📝 Catatan Penutup

Semua fitur yang diminta telah berhasil diselesaikan dan berjalan dengan baik.  
Aplikasi dibangun tanpa starter kit seperti Breeze, menggunakan pendekatan manual agar lebih fleksibel dan menunjukkan pemahaman penuh terhadap Laravel.  

Unit test untuk autentikasi mengalami kendala CSRF Token Laravel versi modern, namun fitur tetap berjalan dengan baik dan diuji secara manual.

Terima kasih 🙏