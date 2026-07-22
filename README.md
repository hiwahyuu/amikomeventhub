# 🎫 AmikomEventHub

Platform manajemen tiket event berbasis web menggunakan Laravel MVC dengan integrasi Payment Gateway Midtrans, sistem kupon diskon, ulasan interaktif, dan cetak E-Certificate PDF otomatis.

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

## ✅ Fitur Aplikasi (Lengkap UTS & Update UAS)

| No | Modul | Fitur | Status |
|----|-------|-------|--------|
| 1 | Kategori | CRUD lengkap + Search | ✅ Selesai |
| 2 | Partner | CRUD lengkap + Search | ✅ Selesai |
| 3 | Public View | Partner & Kategori tampil dinamis di homepage | ✅ Selesai |
| 4 | Filter Data | Pemfilteran event berdasarkan kategori (UI/UX dinamis) | ✅ Selesai |
| 5 | Authentication | Login & Logout Admin (Multi-Tenant Role) | ✅ Selesai |
| 6 | SSO Google | Login instan menggunakan akun Google (Laravel Socialite) | ✅ Selesai 🔥 |
| 7 | Middleware | Proteksi route admin & user | ✅ Selesai |
| 8 | Checkout | Guest checkout pemesanan tiket event | ✅ Selesai |
| 9 | Kupon Diskon | Sistem kode promo/kupon diskon & Bypass otomatis (Rp 0) | ✅ Selesai 🔥 |
| 10 | Transaksi | Laporan data transaksi lengkap di panel admin | ✅ Selesai |
| 11 | Order ID | Generate kode unik transaksi format `TRX-xxx` | ✅ Selesai |
| 12 | Payment Gateway | Integrasi Pembayaran Midtrans (Snap Popup) | ✅ Selesai |
| 13 | State Handling | Penanganan status pembayaran (Success, Pending, Gagal) | ✅ Selesai |
| 14 | Midtrans Webhook | Update status otomatis dari *background* via API Callback | ✅ Selesai |
| 15 | Manajemen Kuota | Pemotongan kuota & penambahan tiket terjual otomatis | ✅ Selesai |
| 16 | Rating & Review | Sistem ulasan dan rating bintang interaktif oleh pembeli | ✅ Selesai 🔥 |
| 17 | Notifikasi Email | Pengiriman E-Ticket otomatis via email (Local Log Mode) | ✅ Selesai |
| 18 | E-Certificate PDF | Cetak dan unduh sertifikat partisipasi instan berformat PDF | ✅ Selesai 🔥 |

---

## 🎥 Video Demonstrasi

*   **UTS:** [Tonton Video UTS](https://youtu.be/k21u-2oewSo)
*   **UAS (Final Version):** *Integrasi Fitur Google SSO, Kupon Diskon, Rating, & E-Certificate PDF.*

---

## 🛠️ Teknologi

| Teknologi | Keterangan |
|-----------|------------|
| Laravel 11 | Framework PHP |
| MySQL | Database |
| Tailwind CSS | Styling Framework |
| Midtrans API | Payment Gateway (Sandbox) |
| Barryvdh DomPDF | Library Pembuatan File PDF Otomatis |
| Laravel Socialite| Integrasi OAuth Google |
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

# --------------------------------------------------
# KONFIGURASI PENTING DI FILE .ENV
# --------------------------------------------------
# 1. Konfigurasi Midtrans (Dapatkan dari Dashboard Sandbox Midtrans)
# MIDTRANS_SERVER_KEY="SB-Mid-server-xxxxxxxxx"
# MIDTRANS_CLIENT_KEY="SB-Mid-client-xxxxxxxxx"
# MIDTRANS_IS_PRODUCTION=false

# 2. Konfigurasi Google SSO (Laravel Socialite)
# GOOGLE_CLIENT_ID="xxxx.apps.googleusercontent.com"
# GOOGLE_CLIENT_SECRET="xxxx"
# GOOGLE_REDIRECT_URI="[http://127.0.0.1:8000/auth/google/callback](http://127.0.0.1:8000/auth/google/callback)"

# 3. Konfigurasi Email lokal (Bypass blokir jaringan)
# MAIL_MAILER=log
# --------------------------------------------------

# Bersihkan cache konfigurasi setelah mengubah .env
php artisan config:clear

# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# Storage link (Penting untuk akses poster & asset)
php artisan storage:link

# Jalankan server
php artisan serve
