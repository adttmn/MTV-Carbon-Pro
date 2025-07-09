# Dokumentasi Laporan Order MTV Carbon Pro

## Overview

Sistem laporan order telah diperluas dengan menambahkan fitur laporan berdasarkan status order. Fitur ini memungkinkan admin untuk mencetak laporan order berdasarkan status tertentu dengan opsi filter tanggal yang opsional.

## Fitur yang Tersedia

### 1. Laporan Order Berdasarkan Tanggal (Sudah Ada)

-   **Route**: `backend/laporan/formorder`
-   **Method**: `OrderController@formOrder` dan `OrderController@cetakOrder`
-   **Fitur**: Mencetak laporan order berdasarkan rentang tanggal tertentu

### 2. Laporan Order Berdasarkan Status (Baru)

-   **Route**: `backend/laporan/formorderbystatus`
-   **Method**: `OrderController@formOrderByStatus` dan `OrderController@cetakOrderByStatus`
-   **Fitur**: Mencetak laporan order berdasarkan status dengan filter tanggal opsional

## Status Order yang Tersedia

1. **Pending** - Order yang belum dibayar
2. **Paid** - Order yang sudah dibayar
3. **Processing** - Order sedang diproses
4. **Shipped** - Order sudah dikirim
5. **Delivered** - Order sudah diterima
6. **Cancelled** - Order dibatalkan

## Cara Menggunakan

### 1. Mengakses Laporan Order Berdasarkan Status

1. Login ke admin panel
2. Buka menu "Data Order"
3. Klik tombol "Laporan by Status" di pojok kanan atas
4. Pilih status order yang diinginkan
5. (Opsional) Pilih rentang tanggal jika ingin memfilter berdasarkan waktu
6. Klik "Cetak Laporan"

### 2. Mengakses Laporan Order Berdasarkan Tanggal

1. Login ke admin panel
2. Buka menu "Data Order"
3. Klik tombol "Laporan Order" di pojok kanan atas
4. Pilih tanggal awal dan akhir
5. Klik "Cetak Laporan"

## Struktur File yang Dibuat/Dimodifikasi

### Controller

-   **File**: `app/Http/Controllers/OrderController.php`
-   **Method Baru**:
    -   `formOrderByStatus()` - Menampilkan form laporan berdasarkan status
    -   `cetakOrderByStatus()` - Memproses dan mencetak laporan berdasarkan status
    -   `formOrder()` - Menampilkan form laporan berdasarkan tanggal (sudah ada, diperbaiki)

### Views

-   **File**: `resources/views/backend/v_order/form_status.blade.php` (Baru)
    -   Form untuk memilih status order dan tanggal
-   **File**: `resources/views/backend/v_order/cetak_status.blade.php` (Baru)
    -   Template cetak laporan berdasarkan status
-   **File**: `resources/views/backend/v_order/cetak.blade.php` (Baru)
    -   Template cetak laporan berdasarkan tanggal
-   **File**: `resources/views/backend/v_order/index.blade.php` (Dimodifikasi)
    -   Ditambahkan tombol akses ke laporan

### Routes

-   **File**: `routes/web.php`
-   **Route Baru**:
    -   `GET backend/laporan/formorderbystatus` - Form laporan berdasarkan status
    -   `POST backend/laporan/cetakorderbystatus` - Proses cetak laporan berdasarkan status

## Validasi Input

### Laporan Berdasarkan Status

-   **Status**: Wajib diisi, harus salah satu dari: pending, Paid, processing, shipped, delivered, cancelled
-   **Tanggal Awal**: Opsional, format date
-   **Tanggal Akhir**: Opsional, format date, harus lebih besar atau sama dengan tanggal awal

### Laporan Berdasarkan Tanggal

-   **Tanggal Awal**: Wajib diisi, format date
-   **Tanggal Akhir**: Wajib diisi, format date, harus lebih besar atau sama dengan tanggal awal

## Output Laporan

### Informasi yang Ditampilkan

1. **Header**: Judul laporan, nama perusahaan, tanggal cetak
2. **Info Filter**: Status yang dipilih dan periode tanggal (jika ada)
3. **Tabel Data**:
    - Nomor urut
    - Order ID
    - Nama Customer
    - Tanggal Order
    - Status (dengan warna)
    - Total Harga
    - Kurir
    - Nomor Resi
4. **Total**: Jumlah order dan total pendapatan
5. **Tombol Aksi**: Cetak dan Tutup

### Fitur Cetak

-   Laporan dapat dicetak langsung dari browser
-   Tombol cetak otomatis tersembunyi saat print
-   Layout dioptimalkan untuk kertas A4

## Keamanan

-   Semua route dilindungi dengan middleware `auth`
-   Validasi input untuk mencegah data yang tidak valid
-   Sanitasi data sebelum ditampilkan

## Troubleshooting

### Masalah Umum

1. **Laporan Kosong**: Pastikan ada data order dengan status yang dipilih
2. **Error Validasi**: Periksa format tanggal dan status yang dipilih
3. **Relasi Error**: Pastikan data customer dan user terhubung dengan benar

### Debug

-   Cek log Laravel di `storage/logs/laravel.log`
-   Pastikan semua relasi model sudah benar
-   Verifikasi data di database

## Pengembangan Selanjutnya

1. Export ke PDF
2. Export ke Excel
3. Filter berdasarkan kurir
4. Filter berdasarkan customer
5. Grafik statistik order
6. Email otomatis laporan

## Kontak

Untuk pertanyaan atau masalah teknis, silakan hubungi tim pengembangan.
