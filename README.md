📋 PROTASIA — Sistem Informasi Pengelolaan Proyek dan Tugas Mahasiswa

PROTASIA adalah aplikasi berbasis web yang dibangun menggunakan CodeIgniter 4 dan Bootstrap, ditujukan untuk membantu dosen dan mahasiswa dalam mengelola proyek kolaboratif, tugas, dan evaluasi secara sistematis.

*NOTE*
Project ini masih belum 100% sempurna, project ini hasil dari sata belajar Framework Codeigniter 4

📌 Fitur Utama

🧑‍🏫 Dosen
- Membuat dan mengelola proyek
- Menambahkan tugas dan deadline
- Mengunggah file tugas
- Melihat daftar mahasiswa dalam proyek
- Memberi nilai dan catatan evaluasi

🎓 Mahasiswa
- Melihat dan bergabung ke proyek
- Mengerjakan dan mengunggah tugas
- Melihat nilai dan progres
- Mendapatkan notifikasi deadline (H-1 s/d H-7)

🛠️ Admin
- Kelola akun dosen dan mahasiswa (CRUD)
- Monitoring seluruh proyek & tugas
- Laporan PDF/Excel rekap aktivitas

⚙️ Teknologi yang Digunakan
CodeIgniter 4, 
Bootstrap 3/4, 
MySQL/MariaDB, 
Dompdf, 
PhpSpreadsheet, 
SweetAlert

🚀 Cara Install (Localhost)

1. Clone repo:
   git clone https://github.com/itsmeandra/Sistem-Informasi-Pengelolaan-Proyek-dan-Tugas-Mahasiswa.git
   cd protasia

3. Setting environment:
    - Salin .env.example jadi .env
    - Atur konfigurasi DB:
        database.default.hostname = localhost
        database.default.database = protasia_db
        database.default.username = root
        database.default.password =
        database.default.DBDriver = MySQLi

4. Import database:
    - Import file SQL (tersedia di /database/siprotama.sql)

5. Jalankan server:
    - php spark serve
    - Akses di browser: http://localhost:8080

🔪 Akun Dummy

  Role          Username          Password
  Admin         admin             admin
  Dosen         12211221          dosen
  Mahasiswa     11223344          mhs

📝 Struktur Database

Tabel utama:
- users (admin, dosen, mahasiswa)
- projects (proyek kolaborasi)
- project_members (relasi mahasiswa–proyek)
- tasks (tugas yang diberikan dosen)
- submissions (pengumpulan tugas oleh mahasiswa)

📊 Fitur Laporan

- Export seluruh proyek & tugas ke PDF
- Export tugas & progres ke Excel
- Dapat diakses via menu Admin > Laporan

🙋‍♂️ Kontribusi

Pull request sangat terbuka. Silakan fork repo, buat fitur/bugfix, lalu ajukan PR. Gunakan branch sesuai fitur (feature/nama-fitur) dan sertakan deskripsi yang jelas.

📄 Lisensi
MIT License — bebas digunakan, disesuaikan, dan dikembangkan kembali.
