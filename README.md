# 🎫 AmikomEventHub

Platform manajemen tiket event berbasis web menggunakan Laravel MVC.

---

## 👤 Identitas

| Keterangan | Detail |
|------------|--------|
| NIM | 24.12.3304 |
| Nama | Wahyu Fadhil Atsani |
| Program Studi | Sistem Informasi |
| Fakultas | Ilmu Komputer |
| Universitas | Universitas Amikom Yogyakarta |
| Mata Kuliah | Digital Bisnis (SI148) |

---

## 🔗 Demo Aplikasi

| Halaman | URL |
|---------|-----|
| 🏠 Beranda | [Lihat](https://amikomeventhub-main-b0pcqc.free.laravel.cloud/) |
| 📊 Dashboard Admin | [Lihat](https://amikomeventhub-main-b0pcqc.free.laravel.cloud/admin/) |
| 📅 Manajemen Event | [Lihat](https://amikomeventhub-main-b0pcqc.free.laravel.cloud/admin/events) |
| 💳 Laporan Transaksi | [Lihat](https://amikomeventhub-main-b0pcqc.free.laravel.cloud/admin/transactions) |
| 🏷️ Kategori | [Lihat](https://amikomeventhub-main-b0pcqc.free.laravel.cloud/admin/categories) |
| 🤝 Partner | [Lihat](https://amikomeventhub-main-b0pcqc.free.laravel.cloud/admin/partners) |
| 🔐 Login Admin | [Lihat](https://amikomeventhub-main-b0pcqc.free.laravel.cloud/admin/login) |

---

## ✅ Fitur Aplikasi

| No | Modul | Fitur | Status |
|----|-------|-------|--------|
| 1 | Kategori | CRUD lengkap + Search | ✅ Selesai |
| 2 | Partner | CRUD lengkap + Search | ✅ Selesai |
| 3 | Public View | Partner & Kategori tampil di homepage | ✅ Selesai |
| 4 | Authentication | Login & Logout Admin | ✅ Selesai |
| 5 | Middleware | Proteksi route admin | ✅ Selesai |
| 6 | Checkout | Guest checkout tanpa login | ✅ Selesai |
| 7 | Transaksi | Laporan transaksi di panel admin | ✅ Selesai |
| 8 | Order ID | Generate kode unik TRX-xxx | ✅ Selesai |

---

## 🎥 Video Demonstrasi UTS

[Klik untuk menonton](https://youtu.be/k21u-2oewSo)

---

## 🛠️ Teknologi

| Teknologi | Keterangan |
|-----------|------------|
| Laravel 11 | Framework PHP |
| MySQL | Database |
| Tailwind CSS | Styling |
| Git & GitHub | Version Control |

---

## 🚀 Cara Menjalankan

```bash
# Clone repositori
git clone https://github.com/hiwahyuu/amikomeventhub.git

# Masuk ke folder
cd amikomeventhub

# Install dependencies
composer install

# Copy file env
cp .env.example .env

# Generate key
php artisan key:generate

# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# Storage link
php artisan storage:link

# Jalankan server
php artisan serve
```

---

## 🔑 Akun Admin Default

| Email | Password |
|-------|----------|
| admin@amikom.ac.id | password |
