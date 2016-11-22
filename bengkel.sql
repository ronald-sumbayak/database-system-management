create database sbd_bengkel;
use sbd_bengkel;

-- a
create table pelanggan (
    plg_id      char (6),
    plg_nama    varchar (15),
    plg_alamat  varchar (160),
    plg_jk      char (1),
    plg_nohp    varchar (15),
    plg_notelp  varchar (15),
    nopol       varchar (10),
    no_rangka   varchar (20),
    no_mesin    varchar (20),
    warna       varchar (50),
    type_mobil  varchar (25),
    tahun_mobil integer,
    primary key (plg_id)
);

create table pegawai (
    peg_id      char (6),
    peg_nama    varchar (150),
    peg_alamat  varchar (100),
    peg_jabatan varchar (30),
    peg_gaji    numeric,
    primary key (peg_id)
);

create table jenis_pekerjaan (
    kode_pek       char (6),
    nama_pek       varchar (100),
    tarif_pek      numeric,
    keterangan_pek varchar (250),
    primary key (kode_pek)
);

create table jenis_layanan (
    jl_kode      char (5),
    jl_nama      varchar (100),
    jl_deskripsi varchar (250),
    primary key (jl_kode)
);

create table suku_cadang (
    kode_sc  char (6),
    nama_sc  varchar (100),
    merk_sc  varchar (50),
    harga_sc numeric,
    primary key (kode_sc)
);

create table transaksi_servis (
    srv_id  char (6),
    peg_id  char (6),
    plg_id  char (6),
    jl_kode char (5),
    srv_tgl date,
    srv_jam time,
    km      integer,
    primary key (srv_id),
    -- foreign key (peg_id) references pegawai (peg_id),
    foreign key (plg_id) references pelanggan (plg_id),
    foreign key (jl_kode) references jenis_layanan (jl_kode)
);

create table test_drive (
    id_td     integer,
    plg_id    char (6),
    tgl_pesan date,
    tgl_td    date,
    jam_td    time,
    primary key (id_td),
    foreign key (plg_id) references pelanggan (plg_id)
);

create table detil_suku_cadang (
    kode_sc char (6),
    srv_id  char (6),
    jumlah  integer,
    foreign key (kode_sc) references suku_cadang (kode_sc),
    foreign key (srv_id) references transaksi_servis (srv_id)
);

create table detil_pekerjaan (
    kode_pek char (6),
    srv_id   char (6),
    peg_id   char (6),
    foreign key (kode_pek) references jenis_pekerjaan (kode_pek),
    foreign key (srv_id) references transaksi_servis (srv_id),
    foreign key (peg_id) references pegawai (peg_id)
);

-- b.1
rename table transaksi_servis to transaksi;

-- b.2
alter table transaksi
add foreign key (peg_id) references pegawai (peg_id)
on delete cascade;

-- b.3
alter table jenis_pekerjaan
drop keterangan_pek;

-- b.4
alter table pelanggan
modify plg_nama varchar (50);

-- c
insert into pelanggan values
("PLG001", "Ulin Nuha",           "Jl. Siwalankerto Timur III No. 9 Surabaya", "P", "085645082052", "0315683733", "L 1996 YZ", "TYT001", "ALP001", "Black",         "Toyota Alphard",        2016),
("PLG002", "Kevin Andrea",        "Jl. Kalikepiting No. 163 W2",               "L", "083806400018", "0312880020", "L 1357 UY", "HND001", "MBL001", "Modern Steel",  "Honda Mobilio",         2016),
("PLG003", "Dicky Ramadhan",      "Tambak Medokan Ayu IV/18",                  "L", "08885030180",  "0315404116", "L 7003 AP", "DHS001", "LXO001", "Grey Metallic", "Daihatsu Luxio",        2016),
("PLG004", "Windi Astuti",        "Keputih Gg Makam blok B2",                  "P", "083849879126", "0312950777", "L 1999 YZ", "MCS001", "BCC001", "Silver",        "Mercedes Benz C-Class", 2016),
("PLG005", "Reynaldi Tejakesuma", "Jl. Sutorejo Utara Baru No. 42",            "L", "0896966294",   "0313293364", "L 838 AS",  "SZK001", "APV001", "Light Grey",    "Suzuki APV",            2016);

insert into pegawai values
("PEG001", "Iqbal Noverio Praditya",  "Asrama ITS Blok I - 311 Kampus ITS Sukolilo", "Manager", 2000000),
("PEG002", "Noviana Ully",            "Asrama ITS Blok G No. 315",                   "Kasir",   1500000),
("PEG003", "Dio Putra Santoso",       "Asrama ITS Blok I - 311 Kampus ITS Sukolilo", "Montir",  1000000),
("PEG004", "Gregorius Audimas",       "Jalan Gebang Kidul nomor 34",                 "Montir",  1000000),
("PEG005", "Muhammad Zulfikar Fauzi", "Bumi Marina Emas Blok E no 73",               "Montir",  1000000);

insert into jenis_pekerjaan values
("PEK001", "Cuci dan vacum mobil", 30000),
("PEK002", "Periksa air radiator", 50000);

insert into jenis_layanan values
("JL001", "Cover Body", "Bongkar pasang cover body"),
("JL002", "Cuci",       "Cuci mobil"),
("JL003", "Mesin",      "Perawatan mesin"),
("JL004", "Servis",     "Servis ringan"),
("JL005", "Test",       "Test Drive");

insert into suku_cadang values
("SC001", "DH ID249 Silver Machine",          "HSR Wheel",         5088000),
("SC002", "NS60L MF Aki Mobil",               "FB Battery",        1000000),
("SC003", "Foglamp Bohlam Lampu Kabut Mobil", "H11 Led",           142500),
("SC004", "DRL Plasma - Biru",                "Fortuna Lampu Led", 45000),
("SC005", "SW/30 Oli Pelumas",                "Mobil Super 2000",  108888);

insert into transaksi values
("SRV001", "PEG005", "PLG001", "JL001", "2016-09-25", "07:00:00", 5),
("SRV002", "PEG004", "PLG002", "JL004", "2016-10-01", "10:00:00", 10),
("SRV003", "PEG003", "PLG003", "JL002", "2016-10-10", "10:00:00", 15),
("SRV004", "PEG002", "PLG004", "JL005", "2016-11-01", "12:00:00", 20),
("SRV005", "PEG001", "PLG005", "JL003", "2016-11-03", "15:00:00", 25);

insert into test_drive values
(1, "PLG001", "2016-10-01", "2016-10-05", "07:00:00"),
(2, "PLG002", "2016-10-07", "2016-10-11", "10:00:00"),
(3, "PLG003", "2016-10-15", "2016-10-21", "12:00:00"),
(4, "PLG004", "2016-11-03", "2016-11-07", "15:00:00"),
(5, "PLG005", "2016-11-05", "2016-11-10", "18:00:00");

insert into detil_suku_cadang values
("SC001", "SRV001", 1),
("SC002", "SRV001", 1),
("SC002", "SRV002", 2),
("SC003", "SRV003", 3),
("SC004", "SRV003", 1),
("SC004", "SRV004", 2),
("SC005", "SRV005", 2);

insert into detil_pekerjaan values
("PEK001", "SRV001", "PEG005"),
("PEK002", "SRV002", "PEG004"),
("PEK001", "SRV003", "PEG003"),
("PEK002", "SRV004", "PEG002"),
("PEK001", "SRV005", "PEG001");

-- d
update suku_cadang
set harga_sc = 150000
where kode_sc = "SC003";

-- e
delete from test_drive
where tgl_pesan < "2016-11-01";
