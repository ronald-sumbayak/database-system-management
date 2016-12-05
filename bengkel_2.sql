drop database sbd_bengkel_2;
create database sbd_bengkel_2;
use sbd_bengkel_2;

create table pelanggan (
    plg_id      char (6),
    plg_nama    varchar (50),
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
    kode_pek  char (6),
    nama_pek  varchar (100),
    tarif_pek numeric,
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
    foreign key (plg_id) references pelanggan (plg_id),
    foreign key (peg_id) references pegawai (peg_id),
    foreign key (jl_kode) references jenis_layanan (jl_kode)
);

create table test_drive (
    id_td     char (5),
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
    kode_pek   char (6),
    srv_id     char (6),
    peg_id     char (6),
    peg_peg_id char (6),
    foreign key (kode_pek) references jenis_pekerjaan (kode_pek),
    foreign key (srv_id) references transaksi_servis (srv_id),
    foreign key (peg_id) references pegawai (peg_id),
    foreign key (peg_peg_id) references pegawai (peg_id)
);

insert into pelanggan values
("PLG001", "Ulin Nuha",           "Jl. Siwalankerto Timur III No. 9 Surabaya", "P", "085645082052", "0315683733", "L 1996 YZ", "TYT001", "ALP001", "Black",         "Toyota Alphard",        2016),
("PLG002", "Kevin Andrea",        "Jl. Kalikepiting No. 163 W2",               "L", "083806400018", "0312880020", "L 1357 UY", "HND001", "MBL001", "Modern Steel",  "Honda Mobilio",         2016),
("PLG003", "Dicky Ramadhan",      "Tambak Medokan Ayu IV/18",                  "L", "08885030180",  "0315404116", "L 7003 AP", "DHS001", "LXO001", "Grey Metallic", "Daihatsu Luxio",        2016),
("PLG004", "Windi Astuti",        "Keputih Gg Makam blok B2",                  "P", "083849879126", "0312950777", "L 1999 YZ", "MCS001", "BCC001", "Silver",        "Mercedes Benz C-Class", 2016),
("PLG005", "Reynaldi Tejakesuma", "Jl. Sutorejo Utara Baru No. 42",            "L", "0896966294",   "0313293364", "L 838 AS",  "SZK001", "APV001", "Light Grey",    "Suzuki APV",            2016),
("PLG006", "Kukuh Rilo",          "Keputih Gg I No 3",                         "L", "0890890890",   "0319999999", null,        null,     null,     null,            null,                    null),
("PLG007", "Wawan",               "Asrama Haji",                               "L", "0876767676",   "0318888888", null,        null,     null,     null,            null,                    null),
("PLG008", "Dimas Pala",          "Gubeng",                                    "L", "0987654321",   "0317777777", null,        null,     null,     null,            null,                    null);

insert into pegawai values
("PEG001", "Iqbal Noverio Praditya",  "Asrama ITS Blok I - 311 Kampus ITS Sukolilo", "Manager", 2000000),
("PEG002", "Noviana Ully",            "Asrama ITS Blok G No. 315",                   "Kasir",   1000000),
("PEG003", "Dio Putra Santoso",       "Asrama ITS Blok I - 311 Kampus ITS Sukolilo", "Montir",  1000000),
("PEG004", "Gregorius Audimas",       "Jalan Gebang Kidul nomor 34",                 "Montir",  1000000),
("PEG005", "Muhammad Zulfikar Fauzi", "Bumi Marina Emas Blok E no 73",               "Montir",  1000000),
("PEG006", "Rosadi Mahmud",           "Keputih",                                     "Montir",  1000000);

insert into jenis_pekerjaan values
("PEK001", "Cuci dan vacum mobil",     30000),
("PEK002", "Periksa air radiator",     20000),
("PEK003", "Periksa level minyak rem", 30000),
("PEK004", "Ganti oli",                20000),
("PEK005", "Dempul",                   5000),
("PEK006", "Poles",                    10000),
("PEK007", "Penggantian suku cadang",  30000);

insert into jenis_layanan values
("JL001", "Perawatan Body",  "Bongkar pasang cover body"),
("JL002", "Cuci Mobil",      "Cuci mobil"),
("JL003", "Perawatan Mesin", "Perawatan mesin"),
("JL004", "Test Drive",      "Test drive");

insert into suku_cadang values
("SC001", "DH JD249 Silver Machine",          "HSR Wheel",         5088000),
("SC002", "NS60L MF Aki Mobil",               "FB Battery",        1000000),
("SC003", "Foglamp Bohlam Lampu Kabut Mobil", "H11 Led",           142500),
("SC004", "DRL Plasma - Biru",                "Fortuna Lampu Led", 45000),
("SC005", "5W/30 Oli Pelumas",                "Mobil Super 2000",  108000);

insert into transaksi_servis values
("SRV001", "PEG003", "PLG001", "JL001", "2016-09-25", "07:00:00", 5),
("SRV002", "PEG004", "PLG002", "JL002", "2016-10-01", "10:00:00", 10),
("SRV003", "PEG005", "PLG003", "JL003", "2016-10-10", "10:00:00", 15),
("SRV004", "PEG006", "PLG004", "JL001", "2016-11-01", "12:00:00", 20),
("SRV005", "PEG003", "PLG005", "JL003", "2016-11-03", "15:00:00", 25),
("SRV006", "PEG004", "PLG006", "JL004", "2016-11-03", "08:00:00", null),
("SRV007", "PEG005", "PLG007", "JL004", "2016-11-09", "07:00:00", null),
("SRV008", "PEG006", "PLG008", "JL004", "2016-11-24", "10:00:00", null),
("SRV009", "PEG003", "PLG001", "JL004", "2016-09-25", "07:00:00", null),
("SRV010", "PEG004", "PLG002", "JL004", "2016-10-01", "10:00:00", null),
("SRV011", "PEG005", "PLG003", "JL004", "2016-11-01", "10:00:00", null);

insert into test_drive values
("TD001", "PLG001", "2016-09-25", "2016-10-01", "07:00:00"),
("TD002", "PLG002", "2016-10-01", "2016-10-08", "10:00:00"),
("TD003", "PLG003", "2016-11-01", "2016-11-08", "12:00:00"),
("TD004", "PLG006", "2016-11-03", "2016-11-10", "15:00:00"),
("TD005", "PLG007", "2016-11-09", "2016-11-17", "18:00:00"),
("TD006", "PLG008", "2016-11-24", "2016-11-25", "14:00:00");

insert into detil_suku_cadang values
("SC001", "SRV001", 1),
("SC002", "SRV001", 1),
("SC002", "SRV002", 3),
("SC003", "SRV002", 3),
("SC004", "SRV003", 3),
("SC004", "SRV003", 3),
("SC005", "SRV004", 2),
("SC003", "SRV004", 1),
("SC004", "SRV004", 2),
("SC005", "SRV005", 1),
("SC002", "SRV005", 2);

insert into detil_pekerjaan values
("PEK001", "SRV001", "PEG003", "PEG004"),
("PEK002", "SRV001", "PEG006", "PEG006"),
("PEK007", "SRV001", "PEG003", "PEG004"),
("PEK003", "SRV002", "PEG005", "PEG006"),
("PEK004", "SRV002", "PEG003", "PEG004"),
("PEK007", "SRV002", "PEG005", "PEG006"),
("PEK001", "SRV003", "PEG003", "PEG004"),
("PEK007", "SRV003", "PEG005", "PEG006"),
("PEK003", "SRV004", "PEG003", "PEG004"),
("PEK007", "SRV004", "PEG005", "PEG006"),
("PEK002", "SRV005", "PEG003", "PEG004"),
("PEK006", "SRV005", "PEG005", "PEG006"),
("PEK007", "SRV005", "PEG003", "PEG004");

-- 1
select * from pelanggan;

-- 2
select pelanggan.plg_nama, test_drive.*
from pelanggan, test_drive
where pelanggan.plg_id = test_drive.plg_id;

-- 3
select * from pelanggan
where plg_id in (select plg_id from transaksi_servis where srv_id = "SRV005");

-- 4
select * from pelanggan
where plg_id in (select plg_id from transaksi_servis where km < (select avg(km) from transaksi_servis));

-- 5
select * from transaksi_servis
where peg_id in (select peg_id from pegawai where peg_alamat like "%Asrama%");

-- 6
select * from pelanggan
where plg_id in (select plg_id from test_drive where datediff(tgl_td, tgl_pesan) <= 7);

-- 7
select plg_nama from pelanggan
where plg_id in (select plg_id from transaksi_servis where jl_kode = "JL002");

-- 8
select plg_nama from pelanggan
where plg_id in (
    select plg_id from transaksi_servis
    where peg_id in (
        select peg_id from pegawai
        where peg_alamat in (
            select peg_alamat from pegawai
            group by peg_alamat having count(1) > 1
        )
    )
);

-- 9
select * from transaksi_servis
where transaksi_servis.srv_id in (
    select srv_id
    from (select distinct srv_id, sum(detil_suku_cadang.jumlah * suku_cadang.harga_sc) as total_harga
          from detil_suku_cadang join suku_cadang on detil_suku_cadang.kode_sc = suku_cadang.kode_sc
          group by srv_id) as total -- return total parts payment per transaction
        
    where
        total_harga <= (select min(total_harga) from ( -- should be optimized :/
                            select distinct srv_id, sum(detil_suku_cadang.jumlah * suku_cadang.harga_sc) as total_harga
                            from detil_suku_cadang join suku_cadang on detil_suku_cadang.kode_sc = suku_cadang.kode_sc
                            group by srv_id) as total)
        || -- or :D
        total_harga >= (select max(total_harga) from (
                            select distinct srv_id, sum(detil_suku_cadang.jumlah * suku_cadang.harga_sc) as total_harga
                            from detil_suku_cadang join suku_cadang on detil_suku_cadang.kode_sc = suku_cadang.kode_sc
                            group by srv_id) as total)
);


-- 10
select count(*) / (
    select sum(peg1.total) + sum(peg2.total) from
        (select count(1) as total from (select count(1) from detil_pekerjaan group by peg_id) as peg1) as peg1,
        (select count(1) as total from (select count(1) from detil_pekerjaan group by peg_peg_id) as peg2) as peg2
) as "Average Service per Emloyee"
from detil_pekerjaan;

-- 11
select plg_nama, srv_id
from pelanggan join transaksi_servis on pelanggan.plg_id = transaksi_servis.plg_id
where
    srv_id in (select srv_id
               from detil_suku_cadang
               group by srv_id having sum(jumlah) >= 3
    )
    && -- and :D
    srv_id in (select srv_id
               from (select distinct srv_id, sum(detil_suku_cadang.jumlah * suku_cadang.harga_sc) as total_harga
                     from detil_suku_cadang join suku_cadang on detil_suku_cadang.kode_sc = suku_cadang.kode_sc
                     group by srv_id) as total
               where total_harga >= (select avg(harga_sc) from suku_cadang)
    );

-- 12
select plg_nama from pelanggan
where
    plg_id in (select plg_id
               from (
                   select plg_id, count(1) as total_service
                   from transaksi_servis
                   group by peg_id
                   having total_service <= avg(total_service)
               ) as service
    )
    && -- and
    plg_id in (select plg_id
               from transaksi_servis
               where peg_id in (
                   select peg_id
                   from pegawai
                   where peg_gaji <= (select avg(peg_gaji) from pegawai)
               )
    );

-- 13
select *
from pegawai
where
    peg_id in (select peg_id
               from (
                   select peg_id, sum(tarif_pek) as total_fee
                   from detil_pekerjaan left join jenis_pekerjaan on detil_pekerjaan.kode_pek = jenis_pekerjaan.kode_pek
                   group by peg_id) as peg1
               where
                   total_fee > (select avg(tarif_pek)
                                from detil_pekerjaan left join jenis_pekerjaan on detil_pekerjaan.kode_pek = jenis_pekerjaan.kode_pek
               )
    )        
    ||
    peg_id in (select peg_id
               from (
                   select peg_id, sum(tarif_pek) as total_fee
                   from detil_pekerjaan left join jenis_pekerjaan on detil_pekerjaan.kode_pek = jenis_pekerjaan.kode_pek
                   group by peg_peg_id) as peg1
               where
                   total_fee > (select avg(tarif_pek)
                                from detil_pekerjaan left join jenis_pekerjaan on detil_pekerjaan.kode_pek = jenis_pekerjaan.kode_pek
               )
    );

-- 14
select *
from pelanggan
where plg_id in (
    select plg_id
    from transaksi_servis
    where srv_id in (
        select srv_id
        from (
            select *, sum(jumlah) as total_parts
            from detil_suku_cadang
            group by srv_id) as trans_parts
        where
            total_parts > (
                select avg(jumlah)
                from detil_suku_cadang
            )
    )
);

-- 15
select *
from pelanggan
where
    plg_id in (
        select plg_id
        from transaksi_servis
        where
            srv_id in (
                select srv_id
                from (
                    select *, count(1) as freq
                    from transaksi_servis
                    group by plg_id having freq > avg (freq)
                ) as trans
            )
            &&
            srv_id in (select srv_id from transaksi_servis where srv_jam > "08:00:00")
    )
    ||
    plg_id in (
        select plg_id
        from transaksi_servis
        where
            srv_id in (
                select srv_id
                from (
                    select detil_suku_cadang.*, sum(harga_sc * jumlah) as total
                    from detil_suku_cadang left join suku_cadang on detil_suku_cadang.kode_sc = suku_cadang.kode_sc
                    group by srv_id
                    having total > 1000000
                ) as total_parts
            )
            &&
            srv_id in (select plg_id from transaksi_servis where srv_jam > "10:00:00")
    );