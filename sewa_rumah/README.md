# 🏠 **Nama Project: Sewa Rumah**

## 👥 **Nama Kelompok**
**Niko Saputra Gurusinga**

## 💼 **Nama Tim**
**HALA MADRID**

---

## 🧠 **Deskripsi Singkat Project**
Proyek **Sewa Rumah** adalah aplikasi berbasis web menggunakan **PHP Native** dan **MySQL**.  
Aplikasi ini dirancang untuk mempermudah pemilik rumah dalam mengiklankan properti yang disewakan serta membantu calon penyewa mencari rumah yang sesuai dengan kebutuhan mereka.

Melalui sistem ini:
- Pemilik dapat **mengunggah rumah** beserta informasi dan gambar.
- Pengguna dapat **melihat rumah yang tersedia**.
- Pengguna dapat **melakukan penyewaan rumah** secara langsung.

---

## ⚙️ **Daftar Fitur**
1. 🏡 **Upload Rumah** – Pemilik dapat menambahkan data rumah baru (alamat, harga, deskripsi, dan gambar).  
2. 🛏️ **Sewa Rumah** – Pengguna dapat memilih rumah dan melakukan proses penyewaan.  
3. 📋 **Keterangan Rumah Tersedia** – Sistem menampilkan status setiap rumah (tersedia / disewa).

---

### 📂 Nama Database: `sewa_rumah_db`

Berikut adalah rancangan skema tabel yang digunakan:

#### 1. Tabel `users`
| Kolom         | Tipe Data     | Keterangan                 |
|----------------|----------------|-----------------------------|
| id_user        | INT (11) PK AI | ID unik pengguna            |
| nama           | VARCHAR(100)   | Nama lengkap pengguna       |
| email          | VARCHAR(100)   | Email pengguna              |
| password       | VARCHAR(255)   | Password (tersimpan/hashes) |
| role           | ENUM('admin','pemilik','penyewa') | Peran pengguna |

#### 2. Tabel `rumah`
| Kolom           | Tipe Data     | Keterangan                   |
|------------------|----------------|-------------------------------|
| id_rumah         | INT (11) PK AI | ID unik rumah                 |
| id_pemilik       | INT (11) FK    | Mengacu ke `users(id_user)`   |
| alamat           | VARCHAR(255)   | Alamat rumah                  |
| harga            | DECIMAL(12,2)  | Harga sewa rumah              |
| deskripsi        | TEXT           | Deskripsi rumah               |
| gambar           | VARCHAR(255)   | Nama file gambar rumah        |
| status           | ENUM('tersedia','disewa') | Status rumah             |

#### 3. Tabel `sewa`
| Kolom           | Tipe Data     | Keterangan                     |
|------------------|----------------|---------------------------------|
| id_sewa          | INT (11) PK AI | ID unik transaksi sewa          |
| id_rumah         | INT (11) FK    | Mengacu ke `rumah(id_rumah)`    |
| id_penyewa       | INT (11) FK    | Mengacu ke `users(id_user)`     |
| tanggal_mulai    | DATE           | Tanggal mulai sewa              |
| tanggal_selesai  | DATE           | Tanggal selesai sewa            |
| total_bayar      | DECIMAL(12,2)  | Total biaya sewa                |
| status_pembayaran| ENUM('belum','lunas') | Status pembayaran       |

---


   ```
   http://localhost/sewa_rumah
   ```

## Akun Default (untuk awal testing)
- Admin:
  - Email: admin@gmail.com
  - Password: admin123
- User (penyewa):
  - Email: user@gmail.com
  - Password: user123
