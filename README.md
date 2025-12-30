# 🎮 KidPedia - Platform Topup Game

KidPedia adalah aplikasi web berbasis **Laravel** yang menyediakan layanan **topup game otomatis**. Aplikasi ini terintegrasi dengan **Midtrans Payment Gateway** untuk pembayaran instan (QRIS, E-Wallet, Virtual Account) dan dilengkapi dengan **panel admin** untuk manajemen konten dan transaksi.

---

## ✨ Fitur Utama

### 👤 Halaman Pengguna (Public & Member)

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

### 🛡️ Panel Admin

* **Dashboard Statistik**
  Ringkasan pendapatan dan jumlah transaksi.

* **Manajemen Game**
  Tambah, edit, dan hapus game serta nominal topup.

* **Manajemen Transaksi**
  Monitoring status pembayaran user secara manual maupun otomatis.

---

## 🛠️ Teknologi yang Digunakan

* **Framework** : Laravel 10 / 11
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
git clone https://github.com/hbbidev/Tubes-Besar-PAW.git
cd Tubes-Besar-PAW
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

## 🖥️ Setup Deployment di Server Linux (Production)

Panduan singkat untuk menjalankan **GamerTopup** di server Linux (Ubuntu 20.04 / 22.04 / 24.04).

---

### 1️⃣ Spesifikasi & Prasyarat Server

Pastikan server memiliki:

* OS: Ubuntu Server 20.04+ / 22.04 / 24.04
* PHP: 8.1+
* Web Server: Nginx / Apache
* Database: MySQL / MariaDB
* Composer
* Git

---

### 2️⃣ Install Paket Dasar

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx git unzip curl mysql-server
```

---

### 3️⃣ Install PHP & Extension

```bash
sudo apt install -y php php-cli php-fpm php-mysql php-mbstring php-xml php-bcmath php-curl php-zip
```

Cek versi PHP:

```bash
php -v
```

---

### 4️⃣ Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

---

### 5️⃣ Clone Project ke Server

```bash
cd /var/www
git clone https://github.com/hbbidev/Tubes-Besar-PAW.git
cd Tubes-Besar-PAW
```

---

### 6️⃣ Install Dependency Laravel

```bash
composer install --no-dev --optimize-autoloader
```

---

### 7️⃣ Konfigurasi Environment Server

```bash
cp .env.example .env
nano .env
```

Sesuaikan konfigurasi **production**:

```env
APP_NAME=GamerTopup
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_gamertopup
DB_USERNAME=db_user
DB_PASSWORD=db_password

MIDTRANS_SERVER_KEY=Mid-server-production-xxxx
MIDTRANS_CLIENT_KEY=Mid-client-production-xxxx
MIDTRANS_IS_PRODUCTION=true
```

---

### 8️⃣ Generate Key & Migrasi Database

```bash
php artisan key:generate
php artisan migrate --force
```

---

### 9️⃣ Permission Folder Laravel

```bash
sudo chown -R www-data:www-data /var/www/kidpedia
sudo chmod -R 775 storage bootstrap/cache
```

---

### 🔟 Konfigurasi Nginx

Buat config virtual host:

```bash
sudo nano /etc/nginx/sites-available/kidpedia
```

Isi konfigurasi:

```nginx
server {
    listen 80;
    server_name domain-anda.com;
    root /var/www/kidpedia/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
    }

    location ~ /\. {
        deny all;
    }
}
```

Aktifkan site:

```bash
sudo ln -s /etc/nginx/sites-available/kidpedia /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

### 1️⃣1️⃣ Optimasi Laravel Production

```bash
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

### 1️⃣2️⃣ (Opsional) Setup HTTPS SSL

Gunakan **Certbot** untuk SSL gratis:

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d domain-anda.com
```

---

### ✅ Selesai

Aplikasi dapat diakses melalui:

👉 **[https://domain-anda.com](https://domain-anda.com)**

---

## 📝 Lisensi

Project ini bersifat **open-source** dan dirilis di bawah **MIT License**.

---

🚀 **KidPedia siap dijalankan di Localhost maupun Production Server Linux.**

---

✨ *Dikembangkan untuk kebutuhan platform topup game otomatis dengan sistem pembayaran real-time.*
