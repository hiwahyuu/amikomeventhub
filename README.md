# 🎫 AmikomEventHub

Platform manajemen tiket event berbasis web menggunakan Laravel MVC dengan integrasi Payment Gateway Midtrans.

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
| 3 | Public View | Partner & Kategori tampil dinamis di homepage | ✅ Selesai |
| 4 | Filter Data | Pemfilteran event berdasarkan kategori (UI/UX dinamis) | ✅ Selesai |
| 5 | Authentication | Login & Logout Admin | ✅ Selesai |
| 6 | Middleware | Proteksi route admin | ✅ Selesai |
| 7 | Checkout | Guest checkout tanpa login | ✅ Selesai |
| 8 | Transaksi | Laporan transaksi di panel admin | ✅ Selesai |
| 9 | Order ID | Generate kode unik TRX-xxx | ✅ Selesai |
| 10 | Payment Gateway | Integrasi Pembayaran Midtrans (Snap Popup) | ✅ Selesai |
| 11 | State Handling | Penanganan status pembayaran (Success, Pending, Batal) | ✅ Selesai |

---

## 🎥 Video Demonstrasi UTS

[Klik untuk menonton](https://youtu.be/k21u-2oewSo) *(Catatan: Video direkam sebelum pembaruan fitur Midtrans)*

---

## 🛠️ Teknologi

| Teknologi | Keterangan |
|-----------|------------|
| Laravel 11 | Framework PHP |
| MySQL | Database |
| Tailwind CSS | Styling Framework |
| Midtrans API | Payment Gateway (Sandbox) |
| Git & GitHub | Version Control |

---

## 🚀 Cara Menjalankan

```bash
# Clone repositori
git clone [https://github.com/hiwahyuu/amikomeventhub.git](https://github.com/hiwahyuu/amikomeventhub.git)

# Masuk ke folder
cd amikomeventhub

# Install dependencies
composer install

# Copy file env
cp .env.example .env

# Generate key
php artisan key:generate

# Konfigurasi Midtrans di .env
# Tambahkan baris ini di file .env Anda dan masukkan Server Key dari Dashboard Sandbox Midtrans
# MIDTRANS_SERVER_KEY="SB-Mid-server-xxxxxxxxx"
# MIDTRANS_CLIENT_KEY="SB-Mid-client-xxxxxxxxx"
# MIDTRANS_IS_PRODUCTION=false

# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# Storage link
php artisan storage:link

# Jalankan server
php artisan serve
