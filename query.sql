CREATE TABLE [user] (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role TINYINT CHECK (role IN (1, 2, 3)) NOT NULL
);

CREATE TABLE dosen (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  user_id INTEGER ,
  nip VARCHAR(255) NOT NULL,
  nama VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES [dbo].[user](id) ON DELETE CASCADE
);

CREATE TABLE mahasiswa (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  user_id INTEGER ,
  nama VARCHAR(255) NOT NULL,
  nim VARCHAR(255) NOT NULL,
  prodi VARCHAR(255) NOT NULL,
  tahun_masuk VARCHAR(4) NOT NULL,
  total_skor VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES [dbo].[user](id) ON DELETE CASCADE
);

CREATE TABLE tingkat_lomba (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  tingkat_lomba VARCHAR(255) NOT NULL,
  skor INTEGER NOT NULL
);

CREATE TABLE jenis_lomba (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  jenis_lomba VARCHAR(255) NOT NULL
);

CREATE TABLE peringkat (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  peringkat INTEGER NOT NULL,
  skor INTEGER NOT NULL
);

CREATE TABLE detail_prestasi (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  id_jenis_kompetisi INTEGER NOT NULL,
  id_tingkat_kompetisi INTEGER NOT NULL,
  id_mahasiswa INTEGER NOT NULL,
  id_dosen INTEGER,
  id_peringkat INTEGER NOT NULL,
  tim BIT NOT NULL DEFAULT 0,
  judul_kompetisi VARCHAR(255) NOT NULL,
  judul_kompetisi_en VARCHAR(255) NOT NULL,
  tempat_kompetisi VARCHAR(255) NOT NULL,
  tempat_kompetisi_en VARCHAR(255) NOT NULL,
  url_kompetisi VARCHAR(255) NOT NULL,
  tanggal_mulai DATE NOT NULL,
  tanggal_akhir DATE NOT NULL,
  jumlah_pt INTEGER NOT NULL,
  jumlah_peserta INTEGER NOT NULL,
  no_surat_tugas VARCHAR(255) NOT NULL,
  tanggal_surat_tugas DATE NOT NULL,
  file_surat_tugas VARCHAR(255) NOT NULL,
  file_sertifikat VARCHAR(255) NOT NULL,
  foto_kegiatan VARCHAR(255) NOT NULL,
  file_poster VARCHAR(255) NOT NULL,
  validasi BIT NOT NULL DEFAULT 0,
  FOREIGN KEY (id_jenis_kompetisi) REFERENCES jenis_lomba(id),
  FOREIGN KEY (id_tingkat_kompetisi) REFERENCES tingkat_lomba(id),
  FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id),
  FOREIGN KEY (id_dosen) REFERENCES dosen(id),
  FOREIGN KEY (id_peringkat) REFERENCES peringkat(id)
);

CREATE TABLE log_data (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  id_user INTEGER NOT NULL,
  id_perubahan INTEGER NOT NULL,
  tabel_perubahan VARCHAR(255) NOT NULL,
  keterangan_kegiatan TEXT NOT NULL,
  tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_user) REFERENCES [user](id)
);

CREATE TABLE info_lomba (
  id INTEGER IDENTITY(1,1) PRIMARY KEY NOT NULL,
  judul VARCHAR(255) NOT NULL,
  deskripsi_lomba TEXT NOT NULL,
  tanggal_akhir_pendaftaran DATE NOT NULL,
  link_perlombaan VARCHAR(255) NOT NULL,
  file_poster VARCHAR(255) NOT NULL
);