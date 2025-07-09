# Dokumentasi Customer Management MTV Carbon Pro

## Overview

Sistem customer management telah diperluas dengan menambahkan fitur detail, edit, dan hapus customer. Fitur ini memungkinkan admin untuk mengelola data customer secara lengkap dengan interface yang user-friendly.

## Fitur yang Tersedia

### 1. **List Customer** (Sudah Ada)

-   **Route**: `GET backend/customer`
-   **Method**: `CustomerController@index`
-   **Fitur**: Menampilkan daftar semua customer dengan informasi lengkap

### 2. **Detail Customer** (Baru)

-   **Route**: `GET backend/customer/{id}`
-   **Method**: `CustomerController@show`
-   **Fitur**: Menampilkan detail lengkap customer termasuk foto profil

### 3. **Edit Customer** (Baru)

-   **Route**: `GET backend/customer/{id}/edit`
-   **Method**: `CustomerController@edit`
-   **Fitur**: Form untuk mengedit data customer

### 4. **Update Customer** (Baru)

-   **Route**: `PUT backend/customer/{id}`
-   **Method**: `CustomerController@update`
-   **Fitur**: Memproses update data customer

### 5. **Delete Customer** (Baru)

-   **Route**: `DELETE backend/customer/{id}`
-   **Method**: `CustomerController@destroy`
-   **Fitur**: Menghapus data customer dan user terkait

## Cara Menggunakan

### 1. Melihat Daftar Customer

1. Login ke admin panel
2. Buka menu "Customer"
3. Sistem akan menampilkan daftar customer dengan foto profil, nama, email, status, dan tanggal registrasi

### 2. Melihat Detail Customer

1. Dari halaman daftar customer, klik tombol **Detail** (ikon mata)
2. Sistem akan menampilkan halaman detail customer dengan informasi lengkap
3. Dari halaman detail, Anda dapat:
    - Klik "Edit Customer" untuk mengedit data
    - Klik "Kembali" untuk kembali ke daftar

### 3. Mengedit Customer

1. Dari halaman daftar customer, klik tombol **Edit** (ikon pensil)
2. Atau dari halaman detail, klik "Edit Customer"
3. Sistem akan menampilkan form edit dengan data yang sudah terisi
4. Ubah data yang diperlukan
5. Upload foto baru jika diperlukan
6. Klik "Simpan Perubahan"

### 4. Menghapus Customer

1. Dari halaman daftar customer, klik tombol **Hapus** (ikon tempat sampah)
2. Sistem akan menampilkan konfirmasi penghapusan
3. Klik "OK" untuk mengkonfirmasi penghapusan

## Struktur File yang Dibuat/Dimodifikasi

### Controller

-   **File**: `app/Http/Controllers/CustomerController.php`
-   **Method Baru**:
    -   `show($id)` - Menampilkan detail customer
    -   `edit($id)` - Menampilkan form edit customer
    -   `update(Request $request, $id)` - Memproses update customer
    -   `destroy($id)` - Menghapus customer
-   **Method yang Dimodifikasi**:
    -   `index()` - Ditambahkan eager loading untuk user

### Views

-   **File**: `resources/views/backend/v_customer/show.blade.php` (Baru)
    -   Halaman detail customer dengan layout yang menarik
-   **File**: `resources/views/backend/v_customer/edit.blade.php` (Baru)
    -   Form edit customer dengan upload foto
-   **File**: `resources/views/backend/v_customer/index.blade.php` (Dimodifikasi)
    -   Ditambahkan kolom status dan tanggal registrasi
    -   Ditambahkan foto profil di daftar
    -   Diperbaiki tombol aksi dengan link yang benar

### Routes

-   **File**: `routes/web.php`
-   **Route**: Sudah menggunakan `Route::resource` yang mencakup semua method CRUD

## Validasi Input

### Form Edit Customer

-   **Nama**: Wajib diisi, maksimal 255 karakter
-   **Email**: Wajib diisi, format email valid, unik (kecuali untuk user yang sedang diedit)
-   **HP**: Wajib diisi, minimal 10 digit, maksimal 13 digit
-   **Alamat**: Wajib diisi
-   **Kode POS**: Wajib diisi
-   **Foto**: Opsional, format JPG/PNG/GIF, maksimal 1MB
-   **Status**: Pilihan Aktif/Tidak Aktif

## Fitur Keamanan

### 1. **Validasi Data**

-   Semua input divalidasi sebelum diproses
-   Pesan error yang informatif
-   Validasi email unik dengan pengecualian untuk user yang sedang diedit

### 2. **File Upload**

-   Validasi tipe file (hanya gambar)
-   Validasi ukuran file (maksimal 1MB)
-   Penghapusan file lama saat upload file baru
-   Resize gambar otomatis menggunakan ImageHelper

### 3. **Penghapusan Data**

-   Konfirmasi sebelum penghapusan
-   Penghapusan file foto terkait
-   Penghapusan user terkait (otomatis melalui model event)

### 4. **Middleware**

-   Semua route dilindungi dengan middleware `auth`
-   Hanya admin yang dapat mengakses

## Informasi yang Ditampilkan

### Halaman List Customer

1. **Foto Profil**: Thumbnail foto customer atau icon default
2. **Nama**: Nama lengkap customer
3. **HP**: Nomor telepon customer
4. **Email**: Alamat email customer
5. **Status**: Badge Aktif/Tidak Aktif
6. **Tanggal Registrasi**: Tanggal customer mendaftar
7. **Tombol Aksi**: Detail, Edit, Hapus

### Halaman Detail Customer

1. **Foto Profil**: Foto customer dalam ukuran besar
2. **Informasi Pribadi**: Nama, email, HP, status
3. **Alamat**: Alamat lengkap customer
4. **Kode POS**: Kode pos customer
5. **Tanggal Registrasi**: Kapan customer mendaftar
6. **Google ID**: Jika customer mendaftar via Google (opsional)

### Form Edit Customer

1. **Upload Foto**: Upload foto baru dengan preview
2. **Data Pribadi**: Nama, email, HP, status
3. **Alamat**: Alamat dan kode POS
4. **Validasi Real-time**: Pesan error yang muncul saat input

## Troubleshooting

### Masalah Umum

1. **Foto tidak muncul**: Pastikan folder `storage/img-customer/` ada dan memiliki permission yang benar
2. **Error upload**: Periksa ukuran dan format file yang diupload
3. **Email duplikat**: Pastikan email yang diinput tidak digunakan customer lain
4. **Relasi error**: Pastikan data user dan customer terhubung dengan benar

### Debug

-   Cek log Laravel di `storage/logs/laravel.log`
-   Pastikan semua relasi model sudah benar
-   Verifikasi data di database
-   Periksa permission folder storage

## Pengembangan Selanjutnya

1. Export data customer ke Excel/PDF
2. Filter customer berdasarkan status
3. Search customer berdasarkan nama/email
4. Bulk action (hapus/update multiple customer)
5. Riwayat aktivitas customer
6. Notifikasi email saat data customer berubah

## Kontak

Untuk pertanyaan atau masalah teknis, silakan hubungi tim pengembangan.
