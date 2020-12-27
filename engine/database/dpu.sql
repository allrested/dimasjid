/*
 Navicat Premium Data Transfer

 Source Server         : pglocal
 Source Server Type    : PostgreSQL
 Source Server Version : 100003
 Source Host           : localhost:5432
 Source Catalog        : dpu
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 100003
 File Encoding         : 65001

 Date: 05/06/2020 13:59:36
*/

-- ----------------------------
-- Table structure for agendas
-- ----------------------------
DROP TABLE IF EXISTS "public"."agendas";
CREATE TABLE "public"."agendas" (
  "id" int8 NOT NULL DEFAULT nextval('agendas_id_seq'::regclass),
  "id_user" int4 NOT NULL,
  "title" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "content" text COLLATE "pg_catalog"."default" NOT NULL,
  "location" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "time_start" timestamp(0) NOT NULL,
  "time_end" timestamp(0) NOT NULL,
  "banner_img" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "id_bidang" int4
)
;

-- ----------------------------
-- Table structure for announces
-- ----------------------------
DROP TABLE IF EXISTS "public"."announces";
CREATE TABLE "public"."announces" (
  "id" int8 NOT NULL DEFAULT nextval('announces_id_seq'::regclass),
  "title" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "caption" text COLLATE "pg_catalog"."default" NOT NULL,
  "image" varchar(191) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for balais
-- ----------------------------
DROP TABLE IF EXISTS "public"."balais";
CREATE TABLE "public"."balais" (
  "id" int8 NOT NULL DEFAULT nextval('balais_id_seq'::regclass),
  "area_name" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "area_address" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "leader_name" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "leader_contact" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "leader_address" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "deleted_at" varchar(191) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS "public"."banners";
CREATE TABLE "public"."banners" (
  "id" int8 NOT NULL DEFAULT nextval('banners_id_seq'::regclass),
  "title" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "caption" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "image" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "status" bool NOT NULL,
  "deleted_at" varchar(191) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS "public"."berita";
CREATE TABLE "public"."berita" (
  "id" int8 NOT NULL DEFAULT nextval('berita_id_seq'::regclass),
  "berita_judul" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "berita_slug" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "berita_subjudul" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "berita_isi" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_by" int4 NOT NULL,
  "is_publish" int4 NOT NULL DEFAULT 0,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "berita_gambar" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "berita_kategori" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "pinned" int4 NOT NULL DEFAULT 0,
  "berita_type" varchar(191) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for beritas
-- ----------------------------
DROP TABLE IF EXISTS "public"."beritas";
CREATE TABLE "public"."beritas" (
  "id" int8 NOT NULL DEFAULT nextval('beritas_id_seq'::regclass),
  "id_user" int4 NOT NULL,
  "title" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "slug" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "content" text COLLATE "pg_catalog"."default" NOT NULL,
  "category" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "image" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "status" int4 NOT NULL,
  "deleted_at" varchar(191) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for bidang
-- ----------------------------
DROP TABLE IF EXISTS "public"."bidang";
CREATE TABLE "public"."bidang" (
  "id" int8 NOT NULL DEFAULT nextval('bidang_id_seq'::regclass),
  "kode_bidang" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_bidang" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_fungsi" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Table structure for bidang_utama
-- ----------------------------
DROP TABLE IF EXISTS "public"."bidang_utama";
CREATE TABLE "public"."bidang_utama" (
  "id" int8 NOT NULL DEFAULT nextval('bidang_utama_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "general_info" text COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of bidang_utama
-- ----------------------------
INSERT INTO "public"."bidang_utama" VALUES (2, 'Bidang Jalan dan Jembatan', '2020-05-07 05:01:52', '2020-05-07 10:24:22', '<p>Bidang Jalan dan Jembatan</p>');
INSERT INTO "public"."bidang_utama" VALUES (3, 'Bidang Penerangan Jalan Umum', '2020-05-07 05:01:53', '2020-05-07 10:24:23', '<p>Bidang Penerangan Jalan Umum</p>');
INSERT INTO "public"."bidang_utama" VALUES (4, 'Bidang Sumber Daya Air', '2020-05-07 05:01:54', '2020-05-07 10:24:24', '<p>Bidang Sumber Daya Air</p>');
INSERT INTO "public"."bidang_utama" VALUES (1, 'sekretariat', '2020-05-07 05:01:51', '2020-05-07 07:02:09', '<p>Sekretariat Dinas dipimpin oleh seorang Sekretaris
Dinas.</p><p>Sekretaris Dinas mempunyai tugas melaksanakan
sebagian tugas Kepala Dinas lingkup kesekretariatan
yang meliputi pengelolaan umum dan kepegawaian,
pengelolaan keuangan, pengoordinasian penyusunan
program, data dan informasi serta pengoordinasian
tugas-tugas bidang;</p><p>Sekretaris Dinas menyelenggarakan
fungsi:</p><p>a. pengoordinasian penyusunan rencana dan program
kerja kesekretariatan dan Dinas;</p><p>b. pengoordinasian bahan perumusan kebijakan
lingkup kesekretariatan dan Dinas;</p><p>c. pengoordinasian pelaksanaan kebijakan lingkup
kesekretariatan dan Dinas;</p><p>d. pengoordinasian pelaksanaan evaluasi dan
pelaporan lingkup kesekretariatan dan Dinas;</p><p>e. pengoordinasian pelaksanaan administrasi lingkup
kesekretariatan dan Dinas; dan</p><p>f. pelaksanaan fungsi lain yang diberikan oleh atasan
terkait dengan tugas dan fungsinya.&nbsp;<br></p><p>Mencakup kesekretariatan DInas Pekerjaan Umum (DPU) yang membantu segala urusan DPU.</p><p>Sekretariat, yang membawahkan:</p><p>1. Sub Bagian Umum dan Kepegawaian;</p><p>2. Sub Bagian Keuangan; dan</p><p>3. Sub Bagian Program, Data dan Informasi</p>');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS "public"."comments";
CREATE TABLE "public"."comments" (
  "id" int8 NOT NULL DEFAULT nextval('comments_id_seq'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "comment" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "id_berita" int4 NOT NULL
)
;

-- ----------------------------
-- Table structure for evaluasis
-- ----------------------------
DROP TABLE IF EXISTS "public"."evaluasis";
CREATE TABLE "public"."evaluasis" (
  "id" int8 NOT NULL DEFAULT nextval('evaluasis_id_seq'::regclass),
  "tahun" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "faktor_pendukung" text COLLATE "pg_catalog"."default" NOT NULL,
  "faktor_penghambat" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS "public"."events";
CREATE TABLE "public"."events" (
  "id" int4 NOT NULL DEFAULT nextval('events_id_seq'::regclass),
  "title" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "start_date" date NOT NULL,
  "end_date" date NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "idprogram" int4 NOT NULL DEFAULT 1,
  "deskripsi" text COLLATE "pg_catalog"."default",
  "ispublic" int4
)
;

-- ----------------------------
-- Table structure for fungsi
-- ----------------------------
DROP TABLE IF EXISTS "public"."fungsi";
CREATE TABLE "public"."fungsi" (
  "id" int8 NOT NULL DEFAULT nextval('fungsi_id_seq'::regclass),
  "kode_fungsi" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_fungsi" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Table structure for galleries
-- ----------------------------
DROP TABLE IF EXISTS "public"."galleries";
CREATE TABLE "public"."galleries" (
  "id" int8 NOT NULL DEFAULT nextval('galleries_id_seq'::regclass),
  "id_album" int4 NOT NULL,
  "title" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "image" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "id_bidang" int4,
  "is_public" varchar(1) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for gallery
-- ----------------------------
DROP TABLE IF EXISTS "public"."gallery";
CREATE TABLE "public"."gallery" (
  "id" int8 NOT NULL DEFAULT nextval('gallery_id_seq'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "deskripsi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "gambar" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "idkategori" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "ispublic" int4
)
;

-- ----------------------------
-- Table structure for info_bidang
-- ----------------------------
DROP TABLE IF EXISTS "public"."info_bidang";
CREATE TABLE "public"."info_bidang" (
  "id" int8 NOT NULL DEFAULT nextval('info_bidang_id_seq'::regclass),
  "description" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of info_bidang
-- ----------------------------
INSERT INTO "public"."info_bidang" VALUES (1, '-', '2020-01-02 10:52:40', '2020-02-04 14:05:42');
INSERT INTO "public"."info_bidang" VALUES (2, '-', '2020-01-06 05:25:44', '2020-01-27 04:33:20');
INSERT INTO "public"."info_bidang" VALUES (3, '-', '2020-01-27 04:32:32', '2020-01-27 04:33:00');
INSERT INTO "public"."info_bidang" VALUES (4, '-', '2020-01-27 04:31:46', '2020-01-27 04:32:28');

-- ----------------------------
-- Table structure for informasi_publik
-- ----------------------------
DROP TABLE IF EXISTS "public"."informasi_publik";
CREATE TABLE "public"."informasi_publik" (
  "id" int8 NOT NULL DEFAULT nextval('informasi_publik_id_seq'::regclass),
  "judul" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "deskripsi" text COLLATE "pg_catalog"."default",
  "file" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for informasi_publik_detail
-- ----------------------------
DROP TABLE IF EXISTS "public"."informasi_publik_detail";
CREATE TABLE "public"."informasi_publik_detail" (
  "id" int8 NOT NULL DEFAULT nextval('informasi_publik_detail_id_seq'::regclass),
  "file" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "deskripsi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "idkategori" int4 NOT NULL,
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Table structure for jabatans
-- ----------------------------
DROP TABLE IF EXISTS "public"."jabatans";
CREATE TABLE "public"."jabatans" (
  "id" int8 NOT NULL DEFAULT nextval('jabatans_id_seq'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "tanggal" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "foto" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "jabatan" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "idbidang" int4
)
;

-- ----------------------------
-- Table structure for kampungkb
-- ----------------------------
DROP TABLE IF EXISTS "public"."kampungkb";
CREATE TABLE "public"."kampungkb" (
  "id" int8 NOT NULL DEFAULT nextval('kampungkb_id_seq'::regclass),
  "kecamatan" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "desa" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "plkb" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for kegiatan
-- ----------------------------
DROP TABLE IF EXISTS "public"."kegiatan";
CREATE TABLE "public"."kegiatan" (
  "id" int8 NOT NULL DEFAULT nextval('kegiatan_id_seq'::regclass),
  "kode_kegiatan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_kegiatan" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0,
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_fungsi" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_bidang" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_program" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_unit" varchar(10) COLLATE "pg_catalog"."default",
  "kode_subunit" varchar(10) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for keuangan_target
-- ----------------------------
DROP TABLE IF EXISTS "public"."keuangan_target";
CREATE TABLE "public"."keuangan_target" (
  "id" int8 NOT NULL DEFAULT nextval('keuangan_target_id_seq'::regclass),
  "kinerja_id" int4 NOT NULL,
  "target" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "realisasi_total" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi1" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi2" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi3" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi4" float8 NOT NULL DEFAULT (0)::double precision,
  "is_delete" int4 NOT NULL DEFAULT 0,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "indikator" varchar(191) COLLATE "pg_catalog"."default",
  "anggaran_kegiatan" float8 NOT NULL DEFAULT (0)::double precision,
  "tahun" varchar(4) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Table structure for keuangan_temp
-- ----------------------------
DROP TABLE IF EXISTS "public"."keuangan_temp";
CREATE TABLE "public"."keuangan_temp" (
  "id" int8 NOT NULL DEFAULT nextval('keuangan_temp_id_seq'::regclass),
  "tahun" varchar(4) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "realisasi_skpd" float8 NOT NULL,
  "anggaran_skpd" float8 NOT NULL,
  "kode_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "realisasi_program" float8 NOT NULL,
  "anggaran_program" float8 NOT NULL,
  "kode_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "realisasi_kegiatan" float8 NOT NULL,
  "anggaran_kegiatan" float8 NOT NULL,
  "realisasi1" float8 NOT NULL,
  "realisasi2" float8 NOT NULL,
  "realisasi3" float8 NOT NULL,
  "realisasi4" float8 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for kinerja
-- ----------------------------
DROP TABLE IF EXISTS "public"."kinerja";
CREATE TABLE "public"."kinerja" (
  "kode_urusan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_urusan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_bidang" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_bidang" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_sub_unit" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_sub_unit" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "hasil" varchar(191) COLLATE "pg_catalog"."default",
  "capaian" varchar(191) COLLATE "pg_catalog"."default",
  "anggaran_kegiatan" float8,
  "keluaran" varchar(191) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "id" int8 NOT NULL DEFAULT nextval('kinerja_id_seq'::regclass),
  "tahun" varchar(5) COLLATE "pg_catalog"."default",
  "masalah1" varchar(191) COLLATE "pg_catalog"."default",
  "solusi1" varchar(191) COLLATE "pg_catalog"."default",
  "masalah2" varchar(191) COLLATE "pg_catalog"."default",
  "solusi2" varchar(191) COLLATE "pg_catalog"."default",
  "masalah3" varchar(191) COLLATE "pg_catalog"."default",
  "solusi3" varchar(191) COLLATE "pg_catalog"."default",
  "masalah4" varchar(191) COLLATE "pg_catalog"."default",
  "solusi4" varchar(191) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for kinerja_new
-- ----------------------------
DROP TABLE IF EXISTS "public"."kinerja_new";
CREATE TABLE "public"."kinerja_new" (
  "id" int8 NOT NULL DEFAULT nextval('kinerja_new_id_seq'::regclass),
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_skpd" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_sub_unit" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_sub_unit" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_program" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_kegiatan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "hasil" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "anggaran_kegiatan" float8 NOT NULL,
  "keluaran" text COLLATE "pg_catalog"."default" NOT NULL,
  "tahun" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "masalah1" varchar(191) COLLATE "pg_catalog"."default",
  "solusi1" varchar(191) COLLATE "pg_catalog"."default",
  "masalah2" varchar(191) COLLATE "pg_catalog"."default",
  "solusi2" varchar(191) COLLATE "pg_catalog"."default",
  "masalah3" varchar(191) COLLATE "pg_catalog"."default",
  "solusi3" varchar(191) COLLATE "pg_catalog"."default",
  "masalah4" varchar(191) COLLATE "pg_catalog"."default",
  "solusi4" varchar(191) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "id_eval" varchar(4) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Table structure for kinerja_target
-- ----------------------------
DROP TABLE IF EXISTS "public"."kinerja_target";
CREATE TABLE "public"."kinerja_target" (
  "id" int8 NOT NULL DEFAULT nextval('kinerja_target_id_seq'::regclass),
  "kinerja_id" int4 NOT NULL,
  "target" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "satuan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "is_delete" int4 NOT NULL DEFAULT 0,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "realisasi1" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi2" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi3" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi4" float8 NOT NULL DEFAULT (0)::double precision,
  "realisasi_total" float8 NOT NULL DEFAULT (0)::double precision,
  "tipe_satuan" varchar(50) COLLATE "pg_catalog"."default",
  "indikator" varchar(191) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for kinerja_temp
-- ----------------------------
DROP TABLE IF EXISTS "public"."kinerja_temp";
CREATE TABLE "public"."kinerja_temp" (
  "id" int8 NOT NULL DEFAULT nextval('kinerja_temp_id_seq'::regclass),
  "kode_urusan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_urusan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_bidang" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_bidang" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_sub_unit" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_sub_unit" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "hasil" varchar(191) COLLATE "pg_catalog"."default",
  "capaian" varchar(191) COLLATE "pg_catalog"."default",
  "anggaran_kegiatan" float8,
  "keluaran" varchar(191) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_update" bool NOT NULL DEFAULT false,
  "tahun" varchar(4) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for kinerja_temp_new
-- ----------------------------
DROP TABLE IF EXISTS "public"."kinerja_temp_new";
CREATE TABLE "public"."kinerja_temp_new" (
  "id" int8 NOT NULL DEFAULT nextval('kinerja_temp_new_id_seq'::regclass),
  "kode_urusan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_skpd" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_sub_unit" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_sub_unit" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_program" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_kegiatan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "hasil" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "anggaran_kegiatan" float8 NOT NULL,
  "keluaran" text COLLATE "pg_catalog"."default" NOT NULL,
  "tahun" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "is_update" int2 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for kontak_kami
-- ----------------------------
DROP TABLE IF EXISTS "public"."kontak_kami";
CREATE TABLE "public"."kontak_kami" (
  "id" int8 NOT NULL DEFAULT nextval('kontak_kami_id_seq'::regclass),
  "nama" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "komentar" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of kontak_kami
-- ----------------------------
INSERT INTO "public"."kontak_kami" VALUES (1, 'Administrator', 'admin@gmail.com', 'enya', '2020-04-16 07:53:31', '2020-04-16 07:53:31');

-- ----------------------------
-- Table structure for laporan
-- ----------------------------
DROP TABLE IF EXISTS "public"."laporan";
CREATE TABLE "public"."laporan" (
  "id" int8 NOT NULL DEFAULT nextval('laporan_id_seq'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "file" varchar(255) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "ispublic" int4
)
;

-- ----------------------------
-- Table structure for layanan_publik_genre
-- ----------------------------
DROP TABLE IF EXISTS "public"."layanan_publik_genre";
CREATE TABLE "public"."layanan_publik_genre" (
  "id" int8 NOT NULL DEFAULT nextval('layanan_publik_genre_id_seq'::regclass),
  "idjalur" int4 NOT NULL,
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "alamat" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "nohp" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "usia" int4 NOT NULL,
  "instansi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "instagram" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for layanan_publik_kampung
-- ----------------------------
DROP TABLE IF EXISTS "public"."layanan_publik_kampung";
CREATE TABLE "public"."layanan_publik_kampung" (
  "id" int8 NOT NULL DEFAULT nextval('layanan_publik_kampung_id_seq'::regclass),
  "nama" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "nohp" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "keluhan" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for layanan_publik_pelayanan
-- ----------------------------
DROP TABLE IF EXISTS "public"."layanan_publik_pelayanan";
CREATE TABLE "public"."layanan_publik_pelayanan" (
  "id" int8 NOT NULL DEFAULT nextval('layanan_publik_pelayanan_id_seq'::regclass),
  "idalat" int4 NOT NULL,
  "nik" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "alamat" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "nohp" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "usia" int4 NOT NULL,
  "anak" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for layanan_publiks
-- ----------------------------
DROP TABLE IF EXISTS "public"."layanan_publiks";
CREATE TABLE "public"."layanan_publiks" (
  "id" int8 NOT NULL DEFAULT nextval('layanan_publiks_id_seq'::regclass),
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "keluhan" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS "public"."link";
CREATE TABLE "public"."link" (
  "id" int8 NOT NULL DEFAULT nextval('link_id_seq'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "link" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "icon" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS "public"."links";
CREATE TABLE "public"."links" (
  "id" int8 NOT NULL DEFAULT nextval('links_id_seq'::regclass),
  "nama" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "link" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "icon" varchar(191) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO "public"."links" VALUES (1, 'Covid19 Bandung', 'https://covid19.bandung.go.id/', '2020-04-16 09:58:19', '2020-04-16 09:58:19', 'Covid19-Bandung.jpg');

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_role";
CREATE TABLE "public"."m_role" (
  "id" int8 NOT NULL DEFAULT nextval('m_role_id_seq'::regclass),
  "name" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "desc" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for master_temp
-- ----------------------------
DROP TABLE IF EXISTS "public"."master_temp";
CREATE TABLE "public"."master_temp" (
  "id" int8 NOT NULL DEFAULT nextval('master_temp_id_seq'::regclass),
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_urusan" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_bidang" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_bidang" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_unit" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_unit" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_subunit" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_subunit" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_program" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_program" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_kegiatan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_kegiatan" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_rekening" varchar(15) COLLATE "pg_catalog"."default" NOT NULL,
  "jenis_belanja" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_rekening" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "anggaran_kegiatan" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS "public"."migrations";
CREATE TABLE "public"."migrations" (
  "id" int4 NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
  "migration" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "batch" int4 NOT NULL
)
;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO "public"."migrations" VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO "public"."migrations" VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO "public"."migrations" VALUES (3, '2019_05_21_054421_create_table_role', 1);
INSERT INTO "public"."migrations" VALUES (4, '2019_05_23_084036_alter_user_add_is_delete', 1);
INSERT INTO "public"."migrations" VALUES (5, '2019_05_23_164402_create_urusan_table', 1);
INSERT INTO "public"."migrations" VALUES (6, '2019_05_23_164450_create_fungsi_table', 1);
INSERT INTO "public"."migrations" VALUES (7, '2019_05_23_164505_create_bidang_table', 1);
INSERT INTO "public"."migrations" VALUES (8, '2019_05_23_222817_alter_urusan_add_is_delete', 1);
INSERT INTO "public"."migrations" VALUES (9, '2019_05_23_222922_alter_fungsi_add_is_delete', 1);
INSERT INTO "public"."migrations" VALUES (10, '2019_05_23_222932_alter_bidang_add_is_delete', 1);
INSERT INTO "public"."migrations" VALUES (11, '2019_05_24_060713_alter_fungsi_drop_tahun', 1);
INSERT INTO "public"."migrations" VALUES (12, '2019_05_24_060845_alter_bidang_drop_tahun', 1);
INSERT INTO "public"."migrations" VALUES (13, '2019_06_02_060404_create_programs_table', 1);
INSERT INTO "public"."migrations" VALUES (14, '2019_06_02_060859_create_kegiatans_table', 1);
INSERT INTO "public"."migrations" VALUES (15, '2019_06_02_061749_alter_program_add_kode', 1);
INSERT INTO "public"."migrations" VALUES (16, '2019_06_02_061807_alter_kegiatan_add_kode', 1);
INSERT INTO "public"."migrations" VALUES (17, '2019_06_02_064149_alter_kegiatan_drop_tahun', 1);
INSERT INTO "public"."migrations" VALUES (18, '2019_06_02_064202_alter_program_drop_tahun', 1);
INSERT INTO "public"."migrations" VALUES (19, '2019_06_04_072046_create_units_table', 1);
INSERT INTO "public"."migrations" VALUES (20, '2019_06_04_072110_create_sub_units_table', 1);
INSERT INTO "public"."migrations" VALUES (21, '2019_06_13_140252_create_role_table', 1);
INSERT INTO "public"."migrations" VALUES (22, '2019_06_13_140407_alter_user_add_is_superuser', 1);
INSERT INTO "public"."migrations" VALUES (23, '2019_06_13_141655_alter_username', 1);
INSERT INTO "public"."migrations" VALUES (24, '2019_06_13_181243_alter_kegiatan_add_column_new', 1);
INSERT INTO "public"."migrations" VALUES (25, '2019_06_14_015411_alter_kegiatan_add_unit_subunit', 1);
INSERT INTO "public"."migrations" VALUES (26, '2019_06_14_065457_create_table_kinerja', 1);
INSERT INTO "public"."migrations" VALUES (27, '2019_06_14_065514_create_table_kinerja_target', 1);
INSERT INTO "public"."migrations" VALUES (28, '2019_06_14_153534_alter_kinerja_add_tahun', 1);
INSERT INTO "public"."migrations" VALUES (29, '2019_06_15_084405_alter_kegiatan_delete_useless_column', 1);
INSERT INTO "public"."migrations" VALUES (30, '2019_06_17_163550_alter_kinerja_add_kode', 1);
INSERT INTO "public"."migrations" VALUES (31, '2019_06_17_163857_alter_kinerja_drop_id', 1);
INSERT INTO "public"."migrations" VALUES (32, '2019_06_18_121612_alter_kinerja_add_kode_kegiatan', 1);
INSERT INTO "public"."migrations" VALUES (33, '2019_06_18_171022_create_table_keuangan_target', 1);
INSERT INTO "public"."migrations" VALUES (34, '2019_06_18_184406_alter_kinerjatarget_drop_realisasi', 1);
INSERT INTO "public"."migrations" VALUES (35, '2019_06_18_184655_alter_kinerjatarget_add_realisasi', 1);
INSERT INTO "public"."migrations" VALUES (36, '2019_06_21_082806_create_table_satuan', 1);
INSERT INTO "public"."migrations" VALUES (37, '2019_06_21_085411_alter_table_kinerja_target_add_tipe_satuan', 1);
INSERT INTO "public"."migrations" VALUES (38, '2019_06_22_142624_create_table_tahapan', 1);
INSERT INTO "public"."migrations" VALUES (39, '2019_06_22_163428_alter_table_tahapan_drop_waktu_add_waktu_tanggal_jam', 1);
INSERT INTO "public"."migrations" VALUES (40, '2019_06_22_171721_create_table_get_api_schedule', 1);
INSERT INTO "public"."migrations" VALUES (41, '2019_06_22_173543_drop_table_kinerja', 1);
INSERT INTO "public"."migrations" VALUES (42, '2019_06_22_173547_alter_table_kinerja_add_column_api', 1);
INSERT INTO "public"."migrations" VALUES (43, '2019_06_22_180719_alter_table_kinerja_add_timestamps', 1);
INSERT INTO "public"."migrations" VALUES (44, '2019_06_22_180840_alter_table_kinerja_add_id', 1);
INSERT INTO "public"."migrations" VALUES (45, '2019_06_22_183430_alter_table_kinerja_target_add_indikator', 1);
INSERT INTO "public"."migrations" VALUES (46, '2019_06_22_230322_alter_keuangan_target_add_indikator', 1);
INSERT INTO "public"."migrations" VALUES (47, '2019_06_22_235135_create_table_master_temp', 1);
INSERT INTO "public"."migrations" VALUES (48, '2019_06_23_045602_alter_kinerja_add_column_tahun', 1);
INSERT INTO "public"."migrations" VALUES (49, '2019_06_26_104640_create_table_kinerja_temp', 1);
INSERT INTO "public"."migrations" VALUES (50, '2019_06_28_104950_alter_kinerja_temp_add_is_update', 1);
INSERT INTO "public"."migrations" VALUES (51, '2019_06_28_110457_alter_kinerja_temp_add_tahun', 1);
INSERT INTO "public"."migrations" VALUES (52, '2019_07_01_165222_alter_kinerja_temp_drop_kode_rekening_nama_rekening', 1);
INSERT INTO "public"."migrations" VALUES (53, '2019_07_01_165242_alter_kinerja_drop_kode_rekening_nama_rekening', 1);
INSERT INTO "public"."migrations" VALUES (54, '2019_07_15_182055_create_settings_table', 1);
INSERT INTO "public"."migrations" VALUES (55, '2019_07_16_072441_create_beritas_table', 1);
INSERT INTO "public"."migrations" VALUES (56, '2019_07_16_075741_alter_berita_add_berita_image', 1);
INSERT INTO "public"."migrations" VALUES (57, '2019_07_16_080242_alter_berita_add_berita_kategori', 1);
INSERT INTO "public"."migrations" VALUES (58, '2019_07_23_082708_create_keuangan_temps_table', 1);
INSERT INTO "public"."migrations" VALUES (59, '2019_07_25_074129_alter_table_kinerja_add_solusi_masalah', 1);
INSERT INTO "public"."migrations" VALUES (60, '2019_07_30_104349_alter_keuangan_target_add_anggaran', 1);
INSERT INTO "public"."migrations" VALUES (61, '2019_08_18_045351_create_slides_table', 1);
INSERT INTO "public"."migrations" VALUES (62, '2019_08_24_032438_create_layanan_publiks_table', 1);
INSERT INTO "public"."migrations" VALUES (63, '2019_08_26_081529_add_columm_pinned', 1);
INSERT INTO "public"."migrations" VALUES (64, '2019_08_26_132203_create_table_informasi_publik', 1);
INSERT INTO "public"."migrations" VALUES (65, '2019_08_26_132236_create_table_informasi_publik_detail', 1);
INSERT INTO "public"."migrations" VALUES (66, '2019_08_27_081053_alter_informasi_publik_detail_add_kategori', 1);
INSERT INTO "public"."migrations" VALUES (67, '2019_08_27_083747_alter_informasi_publik_detail_add_nama', 1);
INSERT INTO "public"."migrations" VALUES (68, '2019_09_07_141905_create_kampung_k_b_s_table', 1);
INSERT INTO "public"."migrations" VALUES (69, '2019_09_08_044257_alter_table_informasi_detail_not_null_image', 1);
INSERT INTO "public"."migrations" VALUES (70, '2019_09_12_174738_create_galleries_table', 1);
INSERT INTO "public"."migrations" VALUES (71, '2019_09_12_175418_create_comments_table', 1);
INSERT INTO "public"."migrations" VALUES (72, '2019_09_12_180012_add_column_idkategori_comments', 1);
INSERT INTO "public"."migrations" VALUES (73, '2019_09_12_180442_create_pendaftarans_table', 1);
INSERT INTO "public"."migrations" VALUES (74, '2019_09_17_052620_alter_kampungkb_add_plkb_column', 1);
INSERT INTO "public"."migrations" VALUES (75, '2019_09_29_071107_create_program_utamas_table', 1);
INSERT INTO "public"."migrations" VALUES (76, '2019_10_03_080439_create_videos_table', 1);
INSERT INTO "public"."migrations" VALUES (77, '2019_10_04_063206_create_table_link', 1);
INSERT INTO "public"."migrations" VALUES (78, '2019_10_13_021408_create_events_table', 1);
INSERT INTO "public"."migrations" VALUES (79, '2019_10_13_034626_add_idprogram_to_events', 1);
INSERT INTO "public"."migrations" VALUES (80, '2019_10_13_051712_add_column_deskripsi_to_events', 1);
INSERT INTO "public"."migrations" VALUES (81, '2019_10_17_015417_create_jabatans_table', 1);
INSERT INTO "public"."migrations" VALUES (82, '2019_10_17_015812_add_jabatan_to_jabatans_table', 1);
INSERT INTO "public"."migrations" VALUES (83, '2019_12_21_034656_layanan_publik_pelayanan', 2);
INSERT INTO "public"."migrations" VALUES (84, '2019_12_21_034720_layanan_publik_genre', 2);
INSERT INTO "public"."migrations" VALUES (85, '2020_01_02_071628_create_informasi_bidangs_table', 2);
INSERT INTO "public"."migrations" VALUES (86, '2020_01_02_072326_create_bidang_utamas_table', 2);
INSERT INTO "public"."migrations" VALUES (87, '2020_01_02_080511_add_ispublik_to_gallery_tables', 2);
INSERT INTO "public"."migrations" VALUES (88, '2020_01_02_081802_add_ispublik_to_events', 2);
INSERT INTO "public"."migrations" VALUES (89, '2020_01_03_072801_create_pengumumen_table', 3);
INSERT INTO "public"."migrations" VALUES (90, '2020_01_03_101114_create_laporans_table', 3);
INSERT INTO "public"."migrations" VALUES (91, '2020_01_03_104134_add_column_ispublic_to_laporan', 3);
INSERT INTO "public"."migrations" VALUES (92, '2020_01_04_182358_add_idbidang_to_jabatan', 3);
INSERT INTO "public"."migrations" VALUES (93, '2020_01_27_091046_add_type_to_berita', 4);
INSERT INTO "public"."migrations" VALUES (94, '2020_01_30_134930_create_kinerja_temp_new', 5);
INSERT INTO "public"."migrations" VALUES (95, '2020_01_30_134952_create_kinerja_new', 6);
INSERT INTO "public"."migrations" VALUES (96, '2020_01_31_130633_add_tahun_to_keuangan_target', 7);
INSERT INTO "public"."migrations" VALUES (97, '2020_02_01_080516_create_evaluasis_table', 8);
INSERT INTO "public"."migrations" VALUES (98, '2020_02_01_101110_edit_coloumn_size_kinerja_new', 9);
INSERT INTO "public"."migrations" VALUES (99, '2020_02_01_145435_create_sosmeds_table', 10);
INSERT INTO "public"."migrations" VALUES (100, '2020_02_01_081459_add_id_eval_to_kinerja', 11);
INSERT INTO "public"."migrations" VALUES (101, '2020_01_04_035641_create_agendas_table', 12);
INSERT INTO "public"."migrations" VALUES (102, '2020_01_04_035522_create_banners_table', 13);
INSERT INTO "public"."migrations" VALUES (103, '2020_01_09_143647_create_announce_table', 14);
INSERT INTO "public"."migrations" VALUES (104, '2020_01_04_035624_create_beritas_table', 15);
INSERT INTO "public"."migrations" VALUES (105, '2020_02_07_121136_create_links_table', 16);
INSERT INTO "public"."migrations" VALUES (106, '2020_01_09_155231_create_gallery_table', 17);
INSERT INTO "public"."migrations" VALUES (107, '2020_01_09_065614_create_balais_table', 18);
INSERT INTO "public"."migrations" VALUES (108, '2020_02_07_121136_create_layanan_publik_kampung_table', 19);
INSERT INTO "public"."migrations" VALUES (110, '2020_02_29_073522_drop_file_column_on_kampung_genre_table', 20);
INSERT INTO "public"."migrations" VALUES (111, '2020_02_29_121138_add_icon_coloumn_to_links', 21);
INSERT INTO "public"."migrations" VALUES (112, '2020_03_04_070250_add_info_umum_column_on_bidang_utama', 22);
INSERT INTO "public"."migrations" VALUES (113, '2020_03_04_063510_change_coloumn_on_galleries', 23);
INSERT INTO "public"."migrations" VALUES (114, '2020_03_04_063205_change_coloumn_on_agendas', 24);
INSERT INTO "public"."migrations" VALUES (115, '2020_03_05_055243_change_id_bidang_column_on_gallery', 25);
INSERT INTO "public"."migrations" VALUES (116, '2020_03_10_125321_add_is_public_to_galleries', 26);
INSERT INTO "public"."migrations" VALUES (117, '2020_04_16_064544_update_comments_table_column', 27);
INSERT INTO "public"."migrations" VALUES (118, '2020_04_16_071323_create_kontak_kamis_table', 28);
INSERT INTO "public"."migrations" VALUES (119, '2020_04_16_155105_update_informasi_publik_table', 29);
INSERT INTO "public"."migrations" VALUES (120, '2020_04_16_135451_create_informasi_publik_table', 30);
INSERT INTO "public"."migrations" VALUES (121, '2020_04_27_024559_edit_column_keluaran_on_kinerja_temp_new_table', 31);
INSERT INTO "public"."migrations" VALUES (122, '2020_04_27_031404_edit_column_keluaran_on_kinerja_new_table', 32);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS "public"."password_resets";
CREATE TABLE "public"."password_resets" (
  "email" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "token" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for pendaftarans
-- ----------------------------
DROP TABLE IF EXISTS "public"."pendaftarans";
CREATE TABLE "public"."pendaftarans" (
  "id" int8 NOT NULL DEFAULT nextval('pendaftarans_id_seq'::regclass),
  "nik" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "nama" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "alamat" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "idkategori" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for pengumuman
-- ----------------------------
DROP TABLE IF EXISTS "public"."pengumuman";
CREATE TABLE "public"."pengumuman" (
  "id" int8 NOT NULL DEFAULT nextval('pengumuman_id_seq'::regclass),
  "text" varchar(255) COLLATE "pg_catalog"."default",
  "ispublic" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of pengumuman
-- ----------------------------
INSERT INTO "public"."pengumuman" VALUES (1, 'Selamat datang di website terbaru DPU 2020', 1, '2020-01-08 00:12:22', '2020-01-08 00:12:22');

-- ----------------------------
-- Table structure for program
-- ----------------------------
DROP TABLE IF EXISTS "public"."program";
CREATE TABLE "public"."program" (
  "id" int8 NOT NULL DEFAULT nextval('program_id_seq'::regclass),
  "kode_program" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_program" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0,
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_fungsi" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_bidang" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_unit" varchar(10) COLLATE "pg_catalog"."default",
  "kode_subunit" varchar(10) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for program_utama
-- ----------------------------
DROP TABLE IF EXISTS "public"."program_utama";
CREATE TABLE "public"."program_utama" (
  "id" int8 NOT NULL DEFAULT nextval('program_utama_id_seq'::regclass),
  "menu" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "role" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS "public"."role";
CREATE TABLE "public"."role" (
  "id" int8 NOT NULL DEFAULT nextval('role_id_seq'::regclass),
  "name" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "desc" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO "public"."role" VALUES (2, 'Admin', 'Super User dan bisa manage semua menu', '2019-09-29 02:53:14', '2019-09-29 02:53:14');
INSERT INTO "public"."role" VALUES (3, 'Sekretariat DPU', 'Hanya bisa membuka menu master data & laporan', '2019-09-29 02:55:43', '2019-09-29 02:55:43');
INSERT INTO "public"."role" VALUES (4, 'Bidang Jalan dan Jembatan', 'Khusus untuk menu Bidang Penyuluhan dan Penggerakkan saja', '2019-09-29 02:56:03', '2019-09-29 02:56:03');
INSERT INTO "public"."role" VALUES (5, 'Bidang Penerangan Jalan Umum', 'Khusus untuk bidang Keluarga Berencana saja', '2019-09-29 02:56:25', '2019-09-29 02:56:25');
INSERT INTO "public"."role" VALUES (6, 'Bidang Sumber Daya Air', 'Khusus untuk menu Bidang Ketahanan dan Kesejahteraan', '2019-09-29 02:56:51', '2019-09-29 02:56:51');

-- ----------------------------
-- Table structure for satuan
-- ----------------------------
DROP TABLE IF EXISTS "public"."satuan";
CREATE TABLE "public"."satuan" (
  "id" int8 NOT NULL DEFAULT nextval('satuan_id_seq'::regclass),
  "nama_satuan" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS "public"."settings";
CREATE TABLE "public"."settings" (
  "id" int8 NOT NULL DEFAULT nextval('settings_id_seq'::regclass),
  "name" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "data" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO "public"."settings" VALUES (3, 'isi-visi', '-', '2020-03-14 05:16:58', '2020-03-20 06:39:22');
INSERT INTO "public"."settings" VALUES (12, 'isi-misi', '-', '2020-03-14 05:28:15', '2020-03-14 05:28:15');
INSERT INTO "public"."settings" VALUES (11, 'headline-misi', '-', '2020-03-14 05:27:55', '2020-03-14 05:27:55');
INSERT INTO "public"."settings" VALUES (2, 'headline-visi', '-', '2020-03-14 05:16:49', '2020-03-14 05:16:49');
INSERT INTO "public"."settings" VALUES (6, 'visi', '-', '2020-01-10 14:56:46', '2020-01-16 08:26:35');
INSERT INTO "public"."settings" VALUES (21, 'fungsi-tupoksi', '-', '2020-04-16 08:20:50', '2020-04-16 08:20:50');
INSERT INTO "public"."settings" VALUES (9, 'headline-tujuan-sasaran', '-', '2020-03-14 05:22:05', '2020-04-16 08:30:02');
INSERT INTO "public"."settings" VALUES (10, 'isi-tujuan-sasaran', '-', '2020-03-14 05:22:13', '2020-04-16 08:30:02');
INSERT INTO "public"."settings" VALUES (26, 'tugas-tupoksi', '-', '2020-04-20 01:09:49', '2020-04-20 01:09:49');

-- ----------------------------
-- Table structure for slides
-- ----------------------------
DROP TABLE IF EXISTS "public"."slides";
CREATE TABLE "public"."slides" (
  "id" int8 NOT NULL DEFAULT nextval('slides_id_seq'::regclass),
  "judul" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "alt" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "subjudul" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "gambar" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "posisi" int4 NOT NULL,
  "created_by" int4 NOT NULL,
  "is_publish" int4 NOT NULL DEFAULT 0,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for sosmeds
-- ----------------------------
DROP TABLE IF EXISTS "public"."sosmeds";
CREATE TABLE "public"."sosmeds" (
  "id" int8 NOT NULL DEFAULT nextval('sosmeds_id_seq'::regclass),
  "nama" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "username" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(250) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of sosmeds
-- ----------------------------
INSERT INTO "public"."sosmeds" VALUES (1, 'twitter', '', NULL, '2020-02-02 12:21:07', '2020-02-02 12:21:07');

-- ----------------------------
-- Table structure for sub_unit
-- ----------------------------
DROP TABLE IF EXISTS "public"."sub_unit";
CREATE TABLE "public"."sub_unit" (
  "id" int8 NOT NULL DEFAULT nextval('sub_unit_id_seq'::regclass),
  "kode_subunit" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_subunit" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_fungsi" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_bidang" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_unit" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Records of sub_unit
-- ----------------------------
INSERT INTO "public"."sub_unit" VALUES (1, '01', 'Dinas Pekerjaan Umum', '1', '01', '03', '01', '2019-11-26 02:16:22', '2019-11-26 02:16:22', 0);

-- ----------------------------
-- Table structure for sync_api_schedule
-- ----------------------------
DROP TABLE IF EXISTS "public"."sync_api_schedule";
CREATE TABLE "public"."sync_api_schedule" (
  "id" int8 NOT NULL DEFAULT nextval('sync_api_schedule_id_seq'::regclass),
  "name" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "date" date NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of sync_api_schedule
-- ----------------------------
INSERT INTO "public"."sync_api_schedule" VALUES (2, 'kinerja_api', '2020-02-02', '2020-02-02 12:10:28', '2020-02-02 12:10:28');
INSERT INTO "public"."sync_api_schedule" VALUES (1, 'kinerja_api', '2020-02-02', '2020-02-01 04:23:56', '2020-02-02 12:10:40');
INSERT INTO "public"."sync_api_schedule" VALUES (3, 'kinerja_api', '2020-02-17', '2020-02-17 14:44:41', '2020-02-17 14:44:41');
INSERT INTO "public"."sync_api_schedule" VALUES (4, 'kinerja_api', '2020-02-20', '2020-02-20 04:40:21', '2020-02-20 04:40:21');
INSERT INTO "public"."sync_api_schedule" VALUES (5, 'kinerja_api', '2020-02-20', '2020-02-20 04:41:01', '2020-02-20 04:41:01');
INSERT INTO "public"."sync_api_schedule" VALUES (6, 'kinerja_api', '2020-02-20', '2020-02-20 04:46:53', '2020-02-20 04:46:53');

-- ----------------------------
-- Table structure for tahapan
-- ----------------------------
DROP TABLE IF EXISTS "public"."tahapan";
CREATE TABLE "public"."tahapan" (
  "id" int8 NOT NULL DEFAULT nextval('tahapan_id_seq'::regclass),
  "nama_tahapan" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "tipe" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "triwulan" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "waktu_awal_tanggal" date NOT NULL,
  "waktu_awal_jam" varchar(12) COLLATE "pg_catalog"."default" NOT NULL,
  "waktu_akhir_tanggal" date NOT NULL,
  "waktu_akhir_jam" varchar(12) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Table structure for unit
-- ----------------------------
DROP TABLE IF EXISTS "public"."unit";
CREATE TABLE "public"."unit" (
  "id" int8 NOT NULL DEFAULT nextval('unit_id_seq'::regclass),
  "kode_unit" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_unit" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_fungsi" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "kode_bidang" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Table structure for urusan
-- ----------------------------
DROP TABLE IF EXISTS "public"."urusan";
CREATE TABLE "public"."urusan" (
  "id" int8 NOT NULL DEFAULT nextval('urusan_id_seq'::regclass),
  "kode_urusan" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "nama_urusan" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "tahun" varchar(4) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" int8 NOT NULL DEFAULT nextval('users_id_seq'::regclass),
  "name" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "email_verified_at" timestamp(0),
  "password" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "role" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "remember_token" varchar(100) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "is_delete" int4 NOT NULL DEFAULT 0,
  "is_superuser" int4 NOT NULL DEFAULT 0,
  "is_active" int4 NOT NULL DEFAULT 0,
  "username" varchar(191) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (4, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$oDOpQp8JIQkStQxRKP/uPuLOg8qYYBRWyblH95odj0.ngqlF93ysS', '2', 'emdUNa12QdlhWCUUEVIjxcKFE7oN4rOaIZjWTjnCGle0eTjpePAV6JdxBB4p', '2019-06-13 13:40:00', '2019-09-29 04:21:33', 0, 0, 1, 'admin');
INSERT INTO "public"."users" VALUES (1, 'Sekretariat 1 DPU', 'sekretariatdpu@gmail.com', NULL, '$2y$10$oDOpQp8JIQkStQxRKP/uPuLOg8qYYBRWyblH95odj0.ngqlF93ysS', '3', NULL, '2019-09-29 04:20:58', '2019-09-29 04:21:27', 0, 0, 1, 'sekretariat');
INSERT INTO "public"."users" VALUES (2, 'Bidang Jalan dan Jembatan', 'bidang1dpu@gmail.com', NULL, '$2y$10$oDOpQp8JIQkStQxRKP/uPuLOg8qYYBRWyblH95odj0.ngqlF93ysS', '4', NULL, '2019-09-29 04:26:57', '2019-09-29 04:26:57', 0, 0, 0, 'bidang1');
INSERT INTO "public"."users" VALUES (3, 'Bidang Penerangan Jalan Umum', 'bidang2dpu@gmail.com', NULL, '$2y$10$oDOpQp8JIQkStQxRKP/uPuLOg8qYYBRWyblH95odj0.ngqlF93ysS', '5', NULL, '2019-09-29 04:28:05', '2019-09-29 04:28:05', 0, 0, 0, 'bidang2');
INSERT INTO "public"."users" VALUES (5, 'Bidang Sumber Daya Air', 'bidang3dpu@gmail.com', NULL, '$2y$10$oDOpQp8JIQkStQxRKP/uPuLOg8qYYBRWyblH95odj0.ngqlF93ysS', '6', NULL, '2019-09-29 04:29:45', '2019-09-29 04:29:45', 0, 0, 0, 'bidang3');
INSERT INTO "public"."users" VALUES (6, 'Bidang 4', 'bidang4dpu@gmail.com', NULL, '$2y$10$oDOpQp8JIQkStQxRKP/uPuLOg8qYYBRWyblH95odj0.ngqlF93ysS', '7', NULL, '2019-09-29 04:31:19', '2019-09-29 04:31:19', 0, 0, 0, 'bidang4');
INSERT INTO "public"."users" VALUES (7, 'Admin', 'admin@admin.com', '2020-02-29 07:13:16', '$2y$10$oDOpQp8JIQkStQxRKP/uPuLOg8qYYBRWyblH95odj0.ngqlF93ysS', '1', NULL, '2020-02-29 07:13:16', '2020-02-29 07:13:16', 0, 0, 0, NULL);

-- ----------------------------
-- Table structure for videos
-- ----------------------------
DROP TABLE IF EXISTS "public"."videos";
CREATE TABLE "public"."videos" (
  "id" int8 NOT NULL DEFAULT nextval('videos_id_seq'::regclass),
  "judul" varchar(255) COLLATE "pg_catalog"."default",
  "link" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Primary Key structure for table agendas
-- ----------------------------
ALTER TABLE "public"."agendas" ADD CONSTRAINT "agendas_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table announces
-- ----------------------------
ALTER TABLE "public"."announces" ADD CONSTRAINT "announces_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table balais
-- ----------------------------
ALTER TABLE "public"."balais" ADD CONSTRAINT "balais_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table banners
-- ----------------------------
ALTER TABLE "public"."banners" ADD CONSTRAINT "banners_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table berita
-- ----------------------------
ALTER TABLE "public"."berita" ADD CONSTRAINT "berita_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table beritas
-- ----------------------------
ALTER TABLE "public"."beritas" ADD CONSTRAINT "beritas_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table bidang
-- ----------------------------
ALTER TABLE "public"."bidang" ADD CONSTRAINT "bidang_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table bidang_utama
-- ----------------------------
ALTER TABLE "public"."bidang_utama" ADD CONSTRAINT "bidang_utama_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table comments
-- ----------------------------
ALTER TABLE "public"."comments" ADD CONSTRAINT "comments_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table evaluasis
-- ----------------------------
ALTER TABLE "public"."evaluasis" ADD CONSTRAINT "evaluasis_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table events
-- ----------------------------
ALTER TABLE "public"."events" ADD CONSTRAINT "events_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table fungsi
-- ----------------------------
ALTER TABLE "public"."fungsi" ADD CONSTRAINT "fungsi_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table galleries
-- ----------------------------
ALTER TABLE "public"."galleries" ADD CONSTRAINT "galleries_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table gallery
-- ----------------------------
ALTER TABLE "public"."gallery" ADD CONSTRAINT "gallery_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table info_bidang
-- ----------------------------
ALTER TABLE "public"."info_bidang" ADD CONSTRAINT "info_bidang_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table informasi_publik
-- ----------------------------
ALTER TABLE "public"."informasi_publik" ADD CONSTRAINT "informasi_publik_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table informasi_publik_detail
-- ----------------------------
ALTER TABLE "public"."informasi_publik_detail" ADD CONSTRAINT "informasi_publik_detail_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table jabatans
-- ----------------------------
ALTER TABLE "public"."jabatans" ADD CONSTRAINT "jabatans_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kampungkb
-- ----------------------------
ALTER TABLE "public"."kampungkb" ADD CONSTRAINT "kampungkb_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kegiatan
-- ----------------------------
ALTER TABLE "public"."kegiatan" ADD CONSTRAINT "kegiatan_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table keuangan_target
-- ----------------------------
ALTER TABLE "public"."keuangan_target" ADD CONSTRAINT "keuangan_target_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table keuangan_temp
-- ----------------------------
ALTER TABLE "public"."keuangan_temp" ADD CONSTRAINT "keuangan_temp_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kinerja
-- ----------------------------
ALTER TABLE "public"."kinerja" ADD CONSTRAINT "kinerja_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kinerja_new
-- ----------------------------
ALTER TABLE "public"."kinerja_new" ADD CONSTRAINT "kinerja_new_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kinerja_target
-- ----------------------------
ALTER TABLE "public"."kinerja_target" ADD CONSTRAINT "kinerja_target_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kinerja_temp
-- ----------------------------
ALTER TABLE "public"."kinerja_temp" ADD CONSTRAINT "kinerja_temp_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kinerja_temp_new
-- ----------------------------
ALTER TABLE "public"."kinerja_temp_new" ADD CONSTRAINT "kinerja_temp_new_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table kontak_kami
-- ----------------------------
ALTER TABLE "public"."kontak_kami" ADD CONSTRAINT "kontak_kami_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table laporan
-- ----------------------------
ALTER TABLE "public"."laporan" ADD CONSTRAINT "laporan_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table layanan_publik_genre
-- ----------------------------
ALTER TABLE "public"."layanan_publik_genre" ADD CONSTRAINT "layanan_publik_genre_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table layanan_publik_kampung
-- ----------------------------
ALTER TABLE "public"."layanan_publik_kampung" ADD CONSTRAINT "layanan_publik_kampung_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table layanan_publik_pelayanan
-- ----------------------------
ALTER TABLE "public"."layanan_publik_pelayanan" ADD CONSTRAINT "layanan_publik_pelayanan_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table layanan_publiks
-- ----------------------------
ALTER TABLE "public"."layanan_publiks" ADD CONSTRAINT "layanan_publiks_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table link
-- ----------------------------
ALTER TABLE "public"."link" ADD CONSTRAINT "link_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table links
-- ----------------------------
ALTER TABLE "public"."links" ADD CONSTRAINT "links_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table m_role
-- ----------------------------
ALTER TABLE "public"."m_role" ADD CONSTRAINT "m_role_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table master_temp
-- ----------------------------
ALTER TABLE "public"."master_temp" ADD CONSTRAINT "master_temp_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table migrations
-- ----------------------------
ALTER TABLE "public"."migrations" ADD CONSTRAINT "migrations_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table password_resets
-- ----------------------------
CREATE INDEX "password_resets_email_index" ON "public"."password_resets" USING btree (
  "email" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table pendaftarans
-- ----------------------------
ALTER TABLE "public"."pendaftarans" ADD CONSTRAINT "pendaftarans_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table pengumuman
-- ----------------------------
ALTER TABLE "public"."pengumuman" ADD CONSTRAINT "pengumuman_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table program
-- ----------------------------
ALTER TABLE "public"."program" ADD CONSTRAINT "program_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table program_utama
-- ----------------------------
ALTER TABLE "public"."program_utama" ADD CONSTRAINT "program_utama_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table role
-- ----------------------------
ALTER TABLE "public"."role" ADD CONSTRAINT "role_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table satuan
-- ----------------------------
ALTER TABLE "public"."satuan" ADD CONSTRAINT "satuan_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table settings
-- ----------------------------
ALTER TABLE "public"."settings" ADD CONSTRAINT "settings_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table slides
-- ----------------------------
ALTER TABLE "public"."slides" ADD CONSTRAINT "slides_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sosmeds
-- ----------------------------
ALTER TABLE "public"."sosmeds" ADD CONSTRAINT "sosmeds_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sub_unit
-- ----------------------------
ALTER TABLE "public"."sub_unit" ADD CONSTRAINT "sub_unit_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sync_api_schedule
-- ----------------------------
ALTER TABLE "public"."sync_api_schedule" ADD CONSTRAINT "sync_api_schedule_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tahapan
-- ----------------------------
ALTER TABLE "public"."tahapan" ADD CONSTRAINT "tahapan_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table unit
-- ----------------------------
ALTER TABLE "public"."unit" ADD CONSTRAINT "unit_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table urusan
-- ----------------------------
ALTER TABLE "public"."urusan" ADD CONSTRAINT "urusan_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_email_unique" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table videos
-- ----------------------------
ALTER TABLE "public"."videos" ADD CONSTRAINT "videos_pkey" PRIMARY KEY ("id");
