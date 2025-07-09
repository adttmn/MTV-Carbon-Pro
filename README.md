# MTV Carbon Pro

**MTV Carbon Pro** adalah aplikasi web berbasis Laravel yang dirancang untuk memudahkan manajemen produk, kategori, pemesanan, dan pengguna dalam sistem berbasis katalog produk. Proyek ini cocok untuk bisnis yang ingin memiliki sistem pemesanan dan pengelolaan produk secara online.

## 🚀 <u><strong>Fitur Utama</strong></u>

- Autentikasi pengguna (login & logout)
- Manajemen pengguna dan pelanggan
- Manajemen kategori produk
- Manajemen produk dengan upload gambar
- Sistem pemesanan produk dan rincian pesanan
- Middleware untuk pembatasan akses berdasarkan peran
- Desain responsif dan ramah pengguna

---

## 🛠️ <u><strong>Teknologi yang Digunakan</strong></u>

- `Laravel 10.x`
- `PHP 8.1+`
- `MySQL`
- `Blade Template Engine`
- `Bootstrap CSS`
- `Laravel Mix`

---

## 📂 <u><strong>Struktur Proyek (Ringkasan)</strong></u>

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
   Edit `.env` dan sesuaikan:
   ```
    DB_DATABASE=mtv_carbon_pro
    DB_USERNAME=root
    DB_PASSWORD=secret
   ```
5. Migrasi dan Seeder
   ```
   php artisan migrate --seed
   ```
6. Jalankan Server
   ```
   php artisan serve
   ```

   
## 🌐 URL
- `/beranda` untuk user
- `admin/` untuk admin
---


## 👤 Akun Admin
🔐 Admin

Email    : `admin@gmail.com`

Password : `admin`

---



## 👤 Role Akses
Admin
- Mengelola data kategori produk
- Mengelola data produk
- Melihat dan mengelola pesanan
- Mengelola data pelanggan
- Mengakses seluruh halaman backend/admin

 Customer
- Melihat daftar produk
- Melakukan pemesanan
- Melihat status pemesanan
- Hanya mengakses halaman customer/frontend
---





