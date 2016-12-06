create database sbd_rental_2;
use sbd_rental_2;

create table supplier (
    sup_id     char (4),
    sup_nama   varchar (30),
    sup_kota   varchar (20),
    sup_telp   varchar (12),
    sup_email  varchar (35),
    sup_alamat varchar (40),
    primary key (sup_id)
);

create table kategori_mobil (
    kat_id                  char (1),
    kat_nama                varchar (20),
    kat_kapasitas_penumpang int,
    kat_harga_sewa          int,
    primary key (kat_id)
);

create table keanggotaan (
    tipe_keanggotaan char (3),
    nama_keanggotaan varchar (10),
    diskon           int,
    primary key (tipe_keanggotaan)
);

create table pelanggan (
    pgn_nama         varchar (25),
    pgn_kota         varchar (20),
    pgn_email        varchar (25),
    tipe_keanggotaan char (3),
    pgn_ktp          varchar (16),
    pgn_hp           varchar (12),
    pgn_password     varchar (10),
    primary key (pgn_email),
    foreign key (tipe_keanggotaan) references keanggotaan (tipe_keanggotaan)
);

create table mobil (
    mbl_id     char (4),
    kat_id     char (1),
    sup_id     char (4),
    mbl_merk   varchar (20),
    mbl_nopol  varchar (9),
    mbl_rating int,
    mbl_warna  varchar (10),
    primary key (mbl_id)
);

create table booking (
    booking_no     varchar (6),
    mbl_id         char (4),
    pgn_email      varchar (25),
    lokasi_ambil   varchar (20),
    waktu_ambil    date,
    lokasi_kembali varchar (20),
    waktu_kembali  date,
    driver_nama    varchar (20),
    driver_email   varchar (25),
    driver_telp    varchar (12),
    driver_sim     varchar (10),
    driver_ktp     varchar (16),
    rating_mobil   int,
    primary key (booking_no),
    foreign key (mbl_id) references mobil (mbl_id),
    foreign key (pgn_email) references pelanggan (pgn_email)
);

insert into supplier values
("S001", "Sejahtera Buana Trada",      "Surabaya",  "082234901957", "buana_trada@gmail.com",             "Komplek RMI blok L35 Ngagel Surabaya"),
("S002", "PT Central Nusantara Niaga", "Mojokerto", "0321392028",   "central_nusantara_niaga@yahoo.com", "Jl. Hayam Wuruk No 21, Mojokerto"),
("S003", "PT Armada Auto Tara",        "Denpasar",  "0361255736",   "armada_auto_tara@gmail.com",        "Jl. Raya Seminyak 69 Denpasar"),
("S004", "PT Berlian Motor",           "Denpasar",  "0361730804",   "berlian_motor@yahoo.co.id",         "Jl. Imam Bonjol 253/8 Denpasar"),
("S005", "PT Dunia Barusa",            "Malang",    "0341491583",   "dunia_barusa@gmail.com",            "Jl. Letjen Sutoyo 78-80 Malang");

insert into kategori_mobil values
("A", "SUV",       8, 750000),
("B", "MPV",       7, 600000),
("C", "Hatchback", 4, 500000),
("D", "Sedan",     4, 400000),
("E", "Pick Up",   2, 300000);

insert into keanggotaan values
("A01", "Bronze", 3),
("A02", "Silver", 4),
("A03", "Gold",   6);

insert into pelanggan values
("Komang Nikita",   "Surabaya",  "nikita99@yahoo.com",   "A03", "5098263183940123", "085764532718", "abc123ee"),
("Audrina",         "Surabaya",  "audri_na@gmail.com",   null,  "4098274629120384", "089112987341", "Zxy987qq"),
("Wira Aditya",     "Denpasar",  "wira_tuch@gmail.com",  "A01", "2917400287381301", "087510735289", "Hsnll001"),
("Fandy Mahardika", "Malang",    "fandyxx1@hotmail.com", "A01", "3028461830183615", "081338790256", "psAxk101"),
("Krishna",         "Mojokerto", "krishna96@yahoo.com",  "A02", "5281047163610173", "085737100283", "008ppxxyy");

insert into mobil values
("M001", "A", "S003", "Toyota Fortuner", "DK1602XY",  10, "Putih"),
("M002", "C", "S004", "Honda Jazz",      "DK1409MN",  7,  "Putih"),
("M003", "B", "S003", "Grand Livina",    "DK1800KL",  8,  "Hitam"),
("M004", "C", "S005", "Toyota Yaris",    "N1661HH",   8,  "Putih"),
("M005", "D", "S001", "Honda City",      "L1328YY",   7,  "Putih"),
("M006", "E", "S001", "Gran Max",        "L1947YZ",   7,  "Hitam"),
("M007", "B", "S004", "Honda Stream",    "DK1101IR",  8,  "Putih"),
("M008", "D", "S005", "Toyota Vios",     "N1773TY",   6,  "Hitam"),
("M009", "A", "S002", "Daihatsu Terios", "L1799JK",   9,  "Hitam"),
("M010", "A", "S001", "Honda CRV",       "Honda CRV", 10, "Hitam");

insert into booking values
("BO0001", "M002", "fandyxx1@hotmail.com", "Denpasar",  "16-11-25", "Denpasar",  "16-11-26", "Mail",            "mail99@yahoo.com",     "089726381628", "8918201529", "2019273610927172", 8),
("BO0002", "M003", "wira_tuch@gmail.com",  "Denpasar",  "16-11-30", "Denpasar",  "16-12-02", "Wira Aditya",     "wira_tuch@gmail.com",  "087510735289", "7890261728", "2917400287381301", 8),
("BO0003", "M006", "audri_na@gmail.com",   "Surabaya",  "16-11-20", "Surabaya",  "16-11-22", "Audrina",         "audri_na@gmail.com",   "089112987341", "9617281508", "4098274629120384", 6),
("BO0004", "M010", "nikita99@yahoo.com",   "Surabaya",  "16-11-21", "Surabaya",  "16-11-22", "Komang Nikita",   "nikita99@yahoo.com",   "085764532718", "8217510281", "5098263183940123", 10),
("BO0005", "M001", "fandyxx1@hotmail.com", "Denpasar",  "16-11-26", "Denpasar",  "16-11-29", "Fandy Mahardika", "fandyxx1@hotmail.com", "081338799256", "2639102719", "3028461830183615", 7),
("BO0006", "M009", "krishna96@yahoo.com",  "Mojokerto", "16-11-29", "Mojokerto", "16-11-30", "Krishna",         "krishna96@yahoo.com",  "085737100283", "9012739172", "5281047163610173", 7),
("BO0007", "M005", "nikita99@yahoo.com",   "Surabaya",  "16-11-12", "Surabaya",  "16-11-15", "Sunarno",         "narno12@yahoo.com",    "081928361829", "6719281027", "5029128120127351", 5);

-- 1
select * from pelanggan;

-- 2
select mobil.*, kat_nama from mobil left join kategori_mobil on mobil.kat_id = kategori_mobil.kat_id;

-- 3
select * from pelanggan
where pgn_email = (
    select pgn_email from booking
    where booking_no = "BO0007"
);

-- 4
select * from pelanggan
where pgn_email in (
    select pgn_email from booking
    having rating_mobil > (select avg (rating_mobil)from booking)
);

-- 5
select * from mobil
where sup_id in (select sup_id from supplier where sup_kota = "Surabaya");

-- 6
select mbl_merk from mobil
where mbl_id in (select mbl_id from booking where waktu_kembali > "2016-11-25");

-- 7
select * from pelanggan
where pgn_email in (
    select pgn_email from booking
    where mbl_id in (select mbl_id from mobil where mbl_warna = "Hitam")
);

-- 8
select pgn_nama, mbl_merk, waktu_ambil, waktu_kembali
from booking
    left join pelanggan on booking.pgn_email = pelanggan.pgn_email
    left join mobil on booking.mbl_id = mobil.mbl_id;

-- 9
select pgn_nama from pelanggan
where pgn_email in (
    select pgn_email from booking
    where month(waktu_ambil) - month(waktu_kembali) = 0
          &&
          mbl_id in (select mbl_id from mobil where mbl_warna = "Putih" and mbl_nopol like "DK%")
);

-- 10
select * from booking
where mbl_id in (
    select mbl_id from mobil
    where kat_id in (
        select kat_id from kategori_mobil
        where kat_harga_sewa = (select min(kat_harga_sewa) from kategori_mobil)
              ||
              kat_harga_sewa = (select max(kat_harga_sewa) from kategori_mobil)
    )
);

-- 11
select mbl_merk, sup_nama, kat_nama
from supplier
    left join mobil on supplier.sup_id = mobil.sup_id
    left join kategori_mobil on kategori_mobil.kat_id = mobil.kat_id
where mbl_id in (
    select mbl_id from booking
    where rating_mobil > 1
          ||
          rating_mobil = (select avg(rating_mobil) from booking)
);

-- 12
select booking.pgn_email, pgn_nama, pgn_kota, nama_keanggotaan, mobil.sup_id, booking.mbl_id
from booking
    left join pelanggan on booking.pgn_email = pelanggan.pgn_email
    left join mobil on mobil.mbl_id = booking.mbl_id
    left join supplier on mobil.sup_id = supplier.sup_id
    left join keanggotaan on pelanggan.tipe_keanggotaan = keanggotaan.tipe_keanggotaan
where booking.mbl_id in (
    select mbl_id from mobil where right(mbl_id, 3) = right(sup_id, 3)
);

-- 13
select pgn_nama, pgn_kota, booking.pgn_email, driver_nama
from booking left join pelanggan on booking.pgn_email = pelanggan.pgn_email
where booking.pgn_email != booking.driver_email
      &&
      mbl_id in (
          select mbl_id
          from mobil left join kategori_mobil on mobil.kat_id = kategori_mobil.kat_id
          where mbl_warna != "Hitam"
                &&
                kat_harga_sewa != (select min(kat_harga_sewa) from kategori_mobil)
      );

-- 14
select sum(kat_harga_sewa) as "Total Harga Booking"
from booking
    left join mobil on booking.mbl_id = mobil.mbl_id
    left join kategori_mobil on mobil.kat_id = kategori_mobil.kat_id
where month(waktu_kembali) = 12;


-- 15
select * from booking
where datediff(waktu_kembali, waktu_ambil) <= 5
      &&
      mbl_id in (select mbl_id from mobil where mbl_warna = "Hitam" && mbl_merk like "Toyota%")