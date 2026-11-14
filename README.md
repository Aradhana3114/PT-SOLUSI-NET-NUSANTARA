# PT Solusi Net Nusantara
### Company Profile Website

Website company profile untuk **PT Solusi Nusantara**, dibangun menggunakan Laravel dengan Filament sebagai dashboard admin untuk mengelola konten website secara dinamis.

---

## Tech Stack

| Technology | Version / Usage |
|---|---|
| Laravel | Latest |
| PHP | 8.2+ |
| Filament | 5.x |
| MySQL | Database |
| Tailwind CSS | CDN |

---

## Getting Started

Ikuti langkah berikut untuk menjalankan project pada lingkungan lokal.

### 1. Create Laravel Project

```bash
composer create-project laravel/laravel solusi-koneksi-anda

cd solusi-koneksi-anda
```

### 2. Install Filament 5

```bash
composer require filament/filament:"^5.0"

php artisan filament:install --panels
```

Gunakan ID panel:

```text
admin
```

Buat symbolic link untuk penyimpanan file:

```bash
php artisan storage:link
```

### 3. Install Project Overlay

Project ini menggunakan sistem **overlay**, yaitu kumpulan file kustom yang ditambahkan ke project Laravel baru.

Salin folder berikut ke root project Laravel:

```text
app/
database/
resources/
routes/
```

Timpa file yang memiliki nama sama, termasuk:

- `routes/web.php`
- `app/Providers/AppServiceProvider.php`
- `database/seeders/DatabaseSeeder.php`

### 4. Database Configuration

Buat database MySQL dengan nama: pt-solusi-net-nusantara

```text
pt-solusi-net-nusantara
```

Kemudian sesuaikan konfigurasi `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pt-solusi-net-nusantara
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migration & Seeder

Jalankan perintah berikut:

```bash
php artisan migrate --seed
```

### 6. Run Development Server

```bash
php artisan serve
```

Website sekarang dapat diakses melalui browser.

---

## Admin Dashboard

Dashboard admin menggunakan **Filament 5** untuk mengelola konten dan konfigurasi website.

Buka file:

```text
app/Providers/Filament/AdminPanelProvider.php
```

Sesuaikan konfigurasi panel:

```php
->brandName('PT Solusi Net Nusantara')
->path('admin')
```

Untuk production, implementasikan `FilamentUser` pada model `User` dan batasi akses panel melalui method `canAccessPanel()`.

---

## Application Access

| Page | URL |
|---|---|
| Website | http://localhost:8000 |
| Admin Dashboard | http://localhost:8000/admin |

**Default Admin Account**

| Credential | Value |
|---|---|
| Email | `admin@solusikoneksianda.com` |
| Password | `password` |

> **Security Notice:** Segera ganti password default sebelum aplikasi digunakan pada lingkungan production.

---

## Website Features

### Frontend

- **Home** — Halaman utama website.
- **Company Profile** — Informasi dan profil perusahaan.
- **Products** — Informasi produk dengan navigasi dropdown.
- **Articles** — Daftar artikel beserta halaman detail.
- **Activity Gallery** — Galeri dokumentasi kegiatan perusahaan.
- **Contact Us** — Informasi dan kontak perusahaan.

### Admin Dashboard

Pengelolaan konten website melalui Filament 5.

| Menu | Description |
|---|---|
| Articles | Mengelola artikel website |
| Modules | Mengelola modul konten |
| Module Objects | Mengelola objek pada setiap modul |
| Tags | Mengelola tag artikel |
| Settings | Mengelola profil, kontak, dan media sosial |

---

## Database Structure

Project ini menggunakan MySQL dengan struktur tabel berikut:

```text
database/
├── site_settings
├── modules
├── module_objects
├── tags
├── articles
├── article_tag
└── users
```

**Database Relationships**

- `articles` memiliki relasi many-to-many dengan `tags` melalui tabel pivot `article_tag`.
- `modules` memiliki relasi one-to-many dengan `module_objects`.
- `users` digunakan untuk autentikasi dashboard admin.

---

## Project Structure

```text
pt-solusi-net-nusantara/
├── app/
│   ├── Filament/
│   ├── Models/
│   ├── Providers/
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── public/
├── storage/
└── .env
```

---

## Notes

- Frontend menggunakan **Tailwind CSS CDN** sehingga tidak memerlukan proses build pada tahap development.
- Untuk production, disarankan memindahkan Tailwind CSS ke konfigurasi **Vite**.
- Pastikan konfigurasi database sudah benar sebelum menjalankan migration.
- Pastikan symbolic link storage sudah dibuat agar file media dapat diakses.
- Jangan gunakan kredensial default pada lingkungan production.

---

<p align="center">
  <strong>PT Solusi Net Nusantara</strong><br>
  Company Profile Website
</p>
