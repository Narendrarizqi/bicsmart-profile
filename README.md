# Website Profil & CMS BiC-SMART

**Bio-Control Strategy, Modeling & Adaptive Readiness Technologies**: website pengenalan program dan dokumentasi kegiatan harian, dilengkapi panel CMS untuk tim UMP.

- **Stack:** Laravel 11 · Filament 3 (CMS) · Tailwind CSS 3 · Alpine.js · MySQL
- **Desain:** Modern Health-Tech Bento Grid (Deep Navy `#0A2864` · Emerald `#10B981` · Cyan `#06B6D4`), font Montserrat + Inter (disimpan lokal, tanpa Google Fonts)

---

## 1. Instalasi di Laragon (Windows)

Prasyarat: Laragon dengan PHP 8.2+, MySQL 8, Composer, dan Node.js 18+.

1. Ekstrak folder `bicsmart-profile` ke `C:\laragon\www\bicsmart-profile`.
2. Buat database: buka HeidiSQL / phpMyAdmin di Laragon, lalu buat database baru bernama **`bicsmart`** (collation `utf8mb4_unicode_ci`).
3. Buka **Terminal Laragon**, lalu jalankan:

   ```bash
   cd C:\laragon\www\bicsmart-profile
   composer install
   copy .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   ```

4. *(Opsional, hanya jika mengubah tampilan/CSS)* `npm install` lalu `npm run build`.
   File hasil build sudah disertakan di `public/build`, jadi langkah ini tidak wajib.
5. Klik **Reload** di Laragon. Website dapat diakses di **http://bicsmart.test**.

> Jika tidak memakai virtual host Laragon, jalankan `php artisan serve` lalu buka http://127.0.0.1:8000 (ubah `APP_URL` di `.env` sesuai alamat yang dipakai agar gambar tampil).

### Login CMS

- Alamat: **http://bicsmart.test/admin**
- Akun login sesuai nilai `ADMIN_EMAIL` dan `ADMIN_PASSWORD` yang Anda tentukan di `.env` sebelum menjalankan seeder.

**Segera ganti password** setelah login pertama (menu *Pengguna & Hak Akses*).

---

## 2. Halaman Publik

| URL | Isi |
|---|---|
| `/` | Beranda: hero maskot "Pantau Jentik", pilar program (Bento Grid), roadmap 2030, edukasi interaktif, berita & dokumentasi terbaru, logo konsorsium |
| `/tentang` | Latar belakang, legalitas & etik, Work Package, tim peneliti & pelaksana, konsorsium |
| `/edukasi` | Penjelasan Wolbachia, cara kerja, bukti ilmiah, FAQ |
| `/dokumentasi` | Linimasa kegiatan harian, dapat difilter per kategori, desa, dan bulan |
| `/dokumentasi/{slug}` | Detail kegiatan + galeri foto (lightbox) |
| `/berita`, `/berita/{slug}` | Berita, rilis media, dan artikel edukasi |
| `/peta-sebaran` | 12 desa mitra per kecamatan (tanpa data pribadi/koordinat rumah) |
| `/kontak` | Alamat & email sekretariat |
| `/sitemap.xml` | Sitemap otomatis untuk mesin pencari |

Widget **"Tanya Pantau Jentik"** (maskot di pojok kanan bawah) muncul di semua halaman. Isinya diambil dari menu *FAQ Maskot* di CMS.

---

## 3. Modul CMS (`/admin`)

| Menu | Fungsi |
|---|---|
| **Dokumentasi Harian** | Catatan kegiatan per hari: tanggal, kategori, desa, deskripsi, dan banyak foto (otomatis diperkecil ke lebar 1600 px). Ada tombol **Terbitkan** untuk draf. |
| **Berita & Artikel** | Editor teks lengkap, gambar utama (crop 16:9), galeri, kategori, jadwal terbit, berita utama beranda |
| **FAQ Maskot** | Tanya-jawab untuk widget maskot & halaman Edukasi (urutan bisa di-*drag*) |
| **Tim Peneliti** | Nama, jabatan, bidang, foto (crop 1:1), urutan tampil |
| **Desa Mitra** | 12 desa, kode, kecamatan |
| **Pengguna & Hak Akses** | Kelola akun dan peran |

### Peran pengguna

| Peran | Hak akses |
|---|---|
| `super_admin` (PMO / Tim TI) | Semua menu, termasuk manajemen pengguna |
| `editor` (Peneliti / Humas) | Kelola & terbitkan Berita, Dokumentasi, FAQ, Tim, Desa |
| `kontributor` (Tim lapangan / kader) | Hanya membuat catatan Dokumentasi Harian. Catatan berstatus **draf** dan baru tampil di website setelah diterbitkan Editor. Kontributor hanya melihat & mengubah catatannya sendiri selama masih draf. |

**Kategori dokumentasi:** WP1 · Kesiapan Sosial, WP1.5/WP3 · Surveilans Ovitrap, Sosialisasi Warga, Pelatihan, Rapat Koordinasi. Daftar ini bisa diubah di `app/Models/Activity.php` (konstanta `CATEGORIES`).

---

## 4. Mengubah Konten Tetap

| Yang diubah | Lokasi |
|---|---|
| Alamat, email, legalitas, daftar & urutan logo mitra | `config/bicsmart.php` |
| Nomor WhatsApp / Instagram / YouTube | `.env` → `BICSMART_WHATSAPP`, dst. (format WA: `628xxxxxxxxxx`) |
| Logo & maskot | `public/images/` dan `public/images/logos/` (ganti file dengan nama yang sama) |
| Warna, font, radius | `tailwind.config.js` & `resources/css/app.css` (lalu `npm run build`) |
| Teks halaman Tentang / Edukasi | `resources/views/pages/about.blade.php`, `education.blade.php` |

Setelah mengubah file di `config/`, jalankan `php artisan config:clear`.

---

## 5. Struktur Database

| Tabel | Kolom utama |
|---|---|
| `users` | name, email, password, **role**, is_active |
| `villages` | slug, code, name, district, description, order_index |
| `team_members` | name, position, expertise, group (`peneliti`/`pelaksana`), institution, bio, photo, order_index, is_active |
| `articles` | title, slug, category, summary, content, featured_image, gallery (JSON), author_id → users, status, published_at, is_featured |
| `activities` | title, slug, activity_date, category, village_id → villages, location, description, photos (JSON), author_id → users, status |
| `faqs` | question, answer, category, order_index, show_in_widget, is_active |

Relasi: `Village hasMany Activity` · `User hasMany Article/Activity` (sebagai penulis).

---

## 6. Deploy ke Hosting (ringkas)

1. Upload proyek, arahkan *document root* domain ke folder `public/`.
2. Atur `.env`: `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://domain-anda`, kredensial database.
3. Jalankan:

   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan migrate --seed --force
   php artisan storage:link
   php artisan optimize
   php artisan filament:optimize
   ```

4. Pastikan folder `storage/` dan `bootstrap/cache/` dapat ditulis server.

---

## 7. Catatan

- Naskah 3 berita awal adalah **draf** yang disusun dari judul & fakta program. Mohon disunting tim Humas dan ditambah foto lewat CMS.
- Empat catatan dokumentasi awal (10 Okt – 3 Nov 2026) dibuat dari agenda program. Silakan lengkapi fotonya.
- Data yang tampil di publik hanya agregat desa. Jangan mengunggah nama, alamat, atau foto wajah warga tanpa izin.
