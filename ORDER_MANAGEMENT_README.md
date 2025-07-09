# Order Management System

## Overview

Sistem manajemen order untuk backend admin yang memungkinkan admin untuk:

-   Melihat semua data order
-   Mengedit status order
-   Menambahkan nomor resi
-   Melihat detail lengkap order

## Fitur yang Tersedia

### 1. Halaman Index Order (`/backend/order`)

-   Menampilkan semua order dengan informasi:
    -   Nama customer
    -   Total harga
    -   Status order
    -   Kurir
    -   Nomor resi
    -   Tanggal order
-   Tombol aksi untuk edit dan detail

### 2. Halaman Edit Order (`/backend/order/{id}/edit`)

-   Form untuk mengubah status order
-   Input untuk nomor resi
-   Menampilkan informasi order yang tidak bisa diubah
-   Sidebar dengan detail produk

### 3. Halaman Detail Order (`/backend/order/{id}`)

-   Informasi lengkap order
-   Data customer
-   Detail produk yang dipesan
-   Informasi pengiriman

## Status Order yang Tersedia

-   `pending` - Menunggu pembayaran
-   `paid` - Sudah dibayar
-   `processing` - Sedang diproses
-   `shipped` - Sudah dikirim
-   `delivered` - Sudah diterima
-   `cancelled` - Dibatalkan

## Routes yang Tersedia

```php
// Menampilkan semua order
GET /backend/order

// Menampilkan form edit order
GET /backend/order/{id}/edit

// Mengupdate status order
PUT /backend/order/{id}

// Menampilkan detail order
GET /backend/order/{id}
```

## Controller Methods

### OrderController

#### `index()`

-   Menampilkan semua order dengan relasi customer dan user
-   Diurutkan berdasarkan tanggal terbaru

#### `edit($id)`

-   Menampilkan form edit untuk order tertentu
-   Load relasi customer, user, dan order items

#### `update(Request $request, $id)`

-   Validasi input status dan nomor resi
-   Update data order
-   Redirect dengan pesan sukses

#### `show($id)`

-   Menampilkan detail lengkap order
-   Load semua relasi yang diperlukan

## Views

### `resources/views/backend/v_order/index.blade.php`

-   Tabel responsive dengan DataTables
-   Badge status dengan warna berbeda
-   Tombol aksi untuk edit dan detail

### `resources/views/backend/v_order/edit.blade.php`

-   Form edit dengan validasi
-   Sidebar detail produk
-   Alert untuk pesan sukses/error

### `resources/views/backend/v_order/show.blade.php`

-   Layout 2 kolom (informasi + detail produk)
-   Card terpisah untuk setiap section
-   Informasi lengkap order dan customer

## Middleware

Semua route menggunakan middleware `auth` untuk memastikan hanya admin yang bisa mengakses.

## Validasi

-   Status order harus salah satu dari: pending, paid, processing, shipped, delivered, cancelled
-   Nomor resi bersifat opsional dengan maksimal 255 karakter

## Relasi Database

-   `Order` belongs to `Customer`
-   `Customer` belongs to `User`
-   `Order` has many `OrderItem`
-   `OrderItem` belongs to `Produk`

## Cara Penggunaan

1. **Akses halaman order**: Login sebagai admin dan kunjungi `/backend/order`
2. **Edit status order**: Klik tombol edit pada baris order yang ingin diubah
3. **Lihat detail**: Klik tombol detail untuk melihat informasi lengkap order
4. **Update status**: Pilih status baru dan masukkan nomor resi jika diperlukan
5. **Simpan perubahan**: Klik tombol "Update Status"

## Catatan

-   Pastikan semua relasi database sudah benar
-   Field yang digunakan: `nama` (bukan `name`) untuk nama user
-   Field `hp` untuk nomor telepon user
-   Semua view menggunakan layout `backend.v_layouts.app`
