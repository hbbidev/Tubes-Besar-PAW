# 🎮 KidPedia - Platform Topup Game

KidPedia adalah aplikasi web berbasis **Laravel** yang menyediakan layanan **topup game otomatis**. Aplikasi ini terintegrasi dengan **Midtrans Payment Gateway** untuk pembayaran instan (QRIS, E-Wallet, Virtual Account) dan dilengkapi dengan **panel admin** untuk manajemen konten dan transaksi.

---

## Fitur Utama

### Halaman Pengguna (Public & Member)

* **Landing Page Modern**
  Desain responsif menggunakan Tailwind CSS, hero slider, dan efek animasi.

* **Pencarian Game**
  Fitur pencarian real-time untuk memudahkan user menemukan game.

* **Sistem Transaksi**

  * Validasi User ID & Server ID
  * Pilihan nominal topup dinamis
  * Integrasi **Midtrans Snap** (popup pembayaran tanpa pindah halaman)

* **Dashboard Member**

  * Riwayat transaksi lengkap
  * Status pembayaran real-time (Pending, Success, Failed)

---

### Panel Admin

* **Dashboard Statistik**
  Ringkasan pendapatan dan jumlah transaksi.

* **Manajemen Game**
  Tambah, edit, dan hapus game serta nominal topup.

* **Manajemen Transaksi**
  Monitoring status pembayaran user secara manual maupun otomatis.

---

## Teknologi yang Digunakan

* **Framework** : Laravel 11
* **Bahasa** : PHP 8.1+
* **Database** : MySQL
* **Frontend** : Blade Templating + Tailwind CSS
* **Payment Gateway** : Midtrans
* **Tools** : Composer, Git

---

## ⚙️ Panduan Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan project ini di **localhost**.

### 1️⃣ Prasyarat

Pastikan sudah terinstall:

* XAMPP / Laragon (MySQL)
* Composer
* Git

---

### 2️⃣ Clone Repository

```bash
git clone https://github.com/USERNAME_GITHUB_ANDA/gamertopup.git
cd gamertopup
```

---

### 3️⃣ Install Dependencies

```bash
composer install
```

---

### 4️⃣ Konfigurasi Environment

Salin file `.env`:

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi berikut:

```env
# Database Config
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_gamertopup
DB_USERNAME=root
DB_PASSWORD=

# Midtrans Config (Sandbox)
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxx
MIDTRANS_IS_PRODUCTION=false
```

> Pastikan database **db_gamertopup** sudah dibuat di phpMyAdmin.

---

### 5️⃣ Generate App Key

```bash
php artisan key:generate
```

---

### 6️⃣ Migrasi & Seeding Database

```bash
php artisan migrate:fresh --seed
```

Seeder akan membuat:

* Akun Admin
* Akun Member
* Data Game & Nominal Topup

---

### 7️⃣ Jalankan Server

```bash
php artisan optimize:clear
php artisan serve
```

Akses aplikasi di browser:

👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 👤 Akun Demo

| Role  | Email                                       | Password    |
| ----- | ------------------------------------------- | ----------- |
| Admin | [admin@toko.com](mailto:admin@toko.com)     | password123 |
| User  | [member@gmail.com](mailto:member@gmail.com) | password123 |

---

## 📡 Setup Webhook Midtrans (Opsional - Localhost)

Agar status transaksi otomatis berubah menjadi **Success**:

1. Jalankan Ngrok:

```bash
ngrok http 8000
```

2. Masuk ke **Midtrans Sandbox Dashboard**
   `Settings → Configuration`

3. Isi **Notification URL**:

```
https://url-ngrok-anda.app/midtrans/callback
```

---

## 📝 Lisensi

Project ini bersifat **open-source** dan dirilis di bawah **MIT License**.

---

✨ *Dikembangkan untuk kebutuhan platform topup game otomatis dengan sistem pembayaran real-time.*
