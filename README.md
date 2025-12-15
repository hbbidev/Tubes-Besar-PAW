Panduan Instalasi & Menjalankan Project (Clone to Serve)

Panduan ini digunakan jika Anda ingin menjalankan project ini di komputer lain atau setelah mendownloadnya dari GitHub.

Prasyarat (Wajib Install Dulu)

XAMPP (Untuk Database MySQL).

Composer (Untuk install library PHP).

Git (Untuk clone repository).

Langkah 1: Clone Repository

Buka terminal (CMD / Git Bash) di folder di mana Anda ingin menyimpan project, lalu jalankan:

git clone [https://github.com/USERNAME_GITHUB/NAMA_REPO.git](https://github.com/USERNAME_GITHUB/NAMA_REPO.git)
cd gamertopup


(Ganti URL dengan link repository GitHub Anda).

Langkah 2: Install Dependencies (Library)

Karena folder /vendor tidak ikut diupload ke GitHub, kita harus menginstallnya ulang.

composer install


Tunggu hingga proses download selesai.

Langkah 3: Konfigurasi Environment (.env)

File .env berisi settingan rahasia (password database, API Key) yang tidak ada di GitHub. Kita harus membuatnya dari file contoh.

Duplikat file contoh:

cp .env.example .env


(Jika di Windows CMD tidak bisa perintah cp, lakukan copy-paste manual file .env.example, lalu rename hasil copy menjadi .env).

Generate App Key:

php artisan key:generate


Edit file .env:
Buka file .env dengan text editor (Notepad/VS Code), lalu atur bagian ini:

A. Database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_gamertopup  <-- Pastikan nama ini sama dengan di phpMyAdmin
DB_USERNAME=root
DB_PASSWORD=


B. Midtrans (Wajib diisi agar tidak error):

MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxx
MIDTRANS_IS_PRODUCTION=false


Langkah 4: Siapkan Database

Nyalakan XAMPP (Apache & MySQL).

Buka browser ke http://localhost/phpmyadmin.

Buat database baru dengan nama: db_gamertopup.

Langkah 5: Migrasi & Seeding

Ini akan membuat tabel-tabel di database dan mengisinya dengan data awal (Admin, Game, Payment).

php artisan migrate:fresh --seed


Jika berhasil, akan muncul tulisan "DONE" hijau banyak dan "Seeding database completed".

Langkah 6: Jalankan Server (Serve)

Terakhir, jalankan server Laravel.

Bersihkan cache dulu (supaya settingan .env terbaca):

php artisan optimize:clear


Jalankan server:

php artisan serve


Buka browser dan akses: http://127.0.0.1:8000

🎉 Akun Login

Gunakan akun ini untuk masuk:

Role

Email

Password

Admin

admin@toko.com

password123

Member

member@gmail.com

password123
