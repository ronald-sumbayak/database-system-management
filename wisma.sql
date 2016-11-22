create database sbd_wisma;
use sbd_wisma;

create table wisma (
    id_wisma   varchar (6),
    nama_wisma varchar (20),
    primary key (id_wisma)
);

create table penginap (
    no_ktp          varchar (16),
    nama_penginap   varchar (20),
    alamat_penginap varchar (30),
    telp_penginap   varchar (13),
    tanggal_lahir   date,
    primary key (no_ktp)
);

create table petugas (
    id_petugas     varchar (6),
    nama_petugas   varchar (20),
    alamat_petugas varchar (30),
    telp_petugas   varchar (13),
    password_login char (6),
    primary key (id_petugas)
);

create table tipe_kamar (
    id_tipe     varchar (20),
    nama_tipe   varchar (20),
    harga_kamar numeric,
    primary key (id_tipe)
);

create table kamar (
    id_kamar varchar (6),
    id_tipe  varchar (20),
    primary key (id_kamar),
    foreign key (id_tipe) references tipe_kamar (id_tipe)
);

create table transaksi (
    id_transaksi     numeric,
    id_wisma         varchar (6),
    id_petugas       varchar (6),
    no_ktp           varchar (16),
    tanggal_checkin  date,
    tanggal_checkout date,
    total_pembayaran numeric,
    primary key (id_transaksi),
    foreign key (no_ktp) references penginap (no_ktp),
    foreign key (id_wisma) references wisma (id_wisma),
    constraint fk_transaksi_petugas foreign key (id_petugas) references petugas (id_petugas)
);

create table kamar_dipesan (
    id_kamar     char (6),
    id_transaksi numeric,
    foreign key (id_kamar) references kamar (id_kamar),
    foreign key (id_transaksi) references transaksi (id_transaksi)
);

insert into wisma values
("WMA001", "Flamboyan"),
("WMA002", "Bougenville"),
("WMA003", "Jasmine");

insert into penginap values
("5171035405960003", "Nindya Dewi",     "Jalan Gunung Rinjani",    "080807070606", "89-02-21"),
("5171035405960001", "Ali Davito",      "Jalan Cokroaminoto",      "088008800880", "14-11-14"),
("5171035405960002", "Alanis Dizza",    "Jalan Palapa II No. 2",   "089089089089", "10-11-10"),
("5171035405960004", "Trining Hastuti", "Jalan Arif Rahman Hakim", "083308083308", "65-04-01"),
("5171035405960006", "Hadi Subito",     "Jalan Gatsu Barat",       "087878787878", "60-11-15");

insert into petugas values
("PTG001", "Rina Wijaya",      "Keputih Gang II No. 24A",     "081239679679", "PAS001"),
("PTG002", "Anne Annisa",      "Surabaya",                    "081234567898", "PAS002"),
("PTG003", "Kadek Winda",      "Perumdos Blok C No. 16",      "081232323232", "PAS003"),
("PTG004", "Kharisma Monika",  "Perum Menunggal Jaya No. 2B", "081343434343", "PAS004"),
("PTG005", "Riyadlatin Nufus", "Keputih Gang I No. 2",        "082020202020", "PAS005");

insert into tipe_kamar values
("TPK001", "Standar",    150000),
("TPK002", "Eksekutif",  200000),
("TPK003", "VIP",        300000),
("TPK004", "Sewa Rumah", 600000);

insert into kamar values
("KMR001", "TPK001"),
("KMR002", "TPK002"),
("KMR003", "TPK003"),
("KMR004", "TPK004"),
("KMR005", "TPK001"),
("KMR006", "TPK002"),
("KMR007", "TPK003");

insert into transaksi values
("51001", "WMA001", "PTG001", "5171035405960003", "15-11-09", "15-11-12", 1200000),
("51002", "WMA002", "PTG002", "5171035405960001", "15-11-09", "15-11-12", 600000),
("51003", "WMA003", "PTG003", "5171035405960002", "15-11-10", "15-11-11", 1200000),
("51004", "WMA001", "PTG004", "5171035405960004", "15-11-08", "15-11-09", 600000),
("51005", "WMA002", "PTG005", "5171035405960006", "15-11-08", "15-11-09", 800000);

insert into kamar_dipesan VALUES
("KMR001", "51001"),
("KMR005", "51001"),
("KMR001", "51002"),
("KMR004", "51003"),
("KMR003", "51004"),
("KMR002", "51005"),
("KMR006", "51005");

-- 1
alter table tipe_kamar
change harga_kamar harga_tipe numeric;

-- 2
alter table penginap
add jenis_kelamin varchar (1);

-- 3
update transaksi
set total_pembayaran = total_pembayaran - (10000 * datediff (tanggal_checkout, tanggal_checkin))
where tanggal_checkin = "15-11-10";

-- 4
alter table transaksi drop foreign key fk_transaksi_petugas;
alter table transaksi drop index fk_transaksi_petugas;
delete from petugas where nama_petugas like "k%";

-- 5
update penginap
set jenis_kelamin = if (year (tanggal_lahir) < 2000, "P", "L");