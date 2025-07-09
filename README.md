# MTV Carbon Pro

**MTV Carbon Pro** adalah aplikasi web berbasis Laravel yang dirancang untuk memudahkan manajemen produk, kategori, pemesanan, dan pengguna dalam sistem berbasis katalog produk. Proyek ini cocok untuk bisnis yang ingin memiliki sistem pemesanan dan pengelolaan produk secara online.

## 🚀 Fitur Utama

- Autentikasi pengguna (login & logout)
- Manajemen pengguna dan pelanggan
- Manajemen kategori produk
- Manajemen produk dengan upload gambar
- Sistem pemesanan produk dan rincian pesanan
- Middleware untuk pembatasan akses berdasarkan peran
- Responsif dan ramah pengguna

## 🛠️ Teknologi yang Digunakan

- **Framework:** Laravel
- **Database:** MySQL
- **Frontend:** Blade Template, Bootstrap CSS
- **Bahasa Pemrograman:** PHP, HTML, JavaScript
- **Manajemen Aset:** Laravel Mix

## 📂 Struktur Proyek (Ringkasan)

```plaintext
MTV Carbon Pro/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Providers/
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/
├── public/
│   └── backend/dist/css/
├── resources/
│   ├── views/
├── routes/
│   └── web.php
├── .env.example
├── composer.json
```
⚙️ Instalasi
1. Clone Repository
   ```
   git clone https://github.com/username/mtv-carbon-pro.git
   cd mtv-carbon-pro
   ```
2. Install Depedency
   ```
   composer install
   npm install && npm run dev
   ```
3. Salin File Environment
   ```
   cp .env.example .env
   php artisan key:generate
   ```
4. Konfigurasi Database
   Edit .env dan sesuaikan:
   ```
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=password

   ```
5. Migrasi dan Seeder
   ```
   php artisan migrate --seed
   ```
6. Jalankan Server
   ```
   php artisan serve
   ```



⚙️ URL
```
/ untuk User.
/admin untuk Admin.
/simulator untuk simulasi kode.
```

👤 Role Akses
Customer: Melihat produk, melakukan pemesanan

Admin: Mengelola produk, kategori, pesanan, dan pengguna


