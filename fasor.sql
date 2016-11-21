drop database sbd_fasor;
create database sbd_fasor;
use sbd_fasor;

create table lapangan (
    id_lapangan   varchar (12),
    nama_lapangan varchar (30),
    harga_siang   int,
    harga_malam   int,
    bulanan       int,
    tahunan       int,
    primary key (id_lapangan)
);

create table petugas (
    id_petugas     varchar (12),
    nama_petugas   varchar (50),
    alamat_petugas varchar (100),
    no_hp_petugas  varchar (12),
    primary key (id_petugas)
);

create table penyewa (
    id_penyewa     varchar (12),
    nama_penyewa   varchar (50),
    alamat_penyewa varchar (100),
    no_hp_penyewa  varchar (12),
    primary key (id_penyewa)
);

create table paket (
    paket     varchar (7),
    max_pakai int,
    harga     int,
    primary key (paket)
);

create table properti (
    id_properti   varchar (12),
    id_lapangan   varchar (12),
    nama_properti varchar (30),
    keterangan    varchar (100),
    primary key (id_properti),
    foreign key (id_lapangan) references lapangan (id_lapangan)
);

create table daftar_paket (
    id_penyewa varchar (12),
    paket      varchar (7),
    sisa_paket int,
    foreign key (id_penyewa) references penyewa (id_penyewa),
    foreign key (paket) references paket (paket)
);

create table penyewaan_lapangan (
    kode_penyewaan varchar (12),
    id_penyewa     varchar (12),
    id_lapangan    varchar (12),
    id_petugas     varchar (12),
    tanggal_sewa   date,
    lama           int,
    paket          varchar (7),
    total_harga    int,
    jam_mulai      time,
    jam_selesai    time,
    primary key (kode_penyewaan),
    foreign key (id_penyewa) references penyewa (id_penyewa),
    foreign key (id_lapangan) references lapangan (id_lapangan),
    foreign key (id_petugas) references petugas (id_petugas)
    on delete cascade
);

insert into lapangan values
("LB01",  "Lapangan Basket",    45000, 60000,  40000, 35000),
("LF01",  "Lapangan Futsal",    70000, 100000, 65000, 60000),
("LBM01", "Lapangan Badminton", 45000, 60000,  40000, 35000);

insert into petugas values
("PT001", "Wira Mahardika",  "Jalan Keputih Permai III No. 10, Surabaya",  "083114047495"),
("PT002", "Priscilla",       "Jalan Mulyosari BPD No. 9, Surabaya",        "089678554672"),
("PT003", "Maemunah",        "Jalan Keputih Tegal, Surabaya",              "089765789654"),
("PT004", "Mitha Paramitha", "Jalan Mulyosari Tengah No. 26, Surabaya",    "085734758938"),
("PT005", "Muhammad Iqbal",  "Jalan Suterejo Selatan XII No. 2, Surabaya", "087625345678");

insert into penyewa values
("CUST001", "Rina Wijaya", "Jl. Keputih Gang II No. 24A, Surabaya", "081239679679"),
("CUST002", "John Kim",    "Perumahan Galaxy No. 156, Surabaya",    "081777888999"),
("CUST003", "Ayu Delvina", "Jl. Perintis Timur II No. 5, Sidoarjo", "089768765432"),
("CUST004", "Rivaldo",     "Perum Galaxy",                          "089768989876"),
("CUST005", "Laras",       "Perumdos Blok D",                       "087392715372");

insert into paket values 
("Bulanan", 4,  50000),
("Tahunan", 20, 100000);

insert into properti values
("BB01", "LB01",  "Bola Basket", "Dibeli bulan Juni, dalam keadaan baik."),
("BF01", "LF01",  "Bola Futsal", "Dibeli bulan September, dalam keadaan baik."),
("SC01", "LBM01", "Shuttlecock", "Dibeli bulan Januari 2016.");

insert into daftar_paket values
("CUST002", "Bulanan", 4),
("CUST001", "Tahunan", 19),
("CUST004", "Tahunan", 17),
("CUST005", "Bulanan", 0),
("CUST003", "Tahunan", 20);

insert into penyewaan_lapangan values
("TR001", "CUST001", "LB01",  "PT001", "15-12-20", 2, "Bulanan", 40000,  "18:00", "20:00"),
("TR002", "CUST005", "LBM01", "PT002", "15-12-21", 3, "Bulanan", 105000, "19:00", "22:00"),
("TR003", "CUST003", "LF01",  "PT005", "15-12-25", 1, "Tahunan", 60000,  "18:00", "19:00"),
("TR004", "CUST004", "LF01",  "PT003", "15-12-26", 1, "Tahunan", 60000,  "15:00", "16:00");

-- 1
update penyewa
set alamat_penyewa = "Perum Bumi Marina Mas Gang IIC No. 20, Surabay"
where id_penyewa = "CUST004";

-- 2
delete from petugas
where alamat_petugas like "Jalan Keputih Tegal%";

-- 3
insert into lapangan value ("LB02", "Lapangan Basket", 50000, 65000, 350000, 30000);

-- 4
alter table properti
change keterangan keterangan_properti varchar (50);

-- 5
update penyewaan_lapangan
set total_harga = total_harga - 15000
where tanggal_sewa > "15-12-23";