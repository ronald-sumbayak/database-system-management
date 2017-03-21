create database mbd_praktikum_1;
use mbd_praktikum_1;

create table pegawai (
    id_pegawai    char (10) not null,
    no_ktp        varchar (20),
    nama_pegawai  varchar (100),
    tempat_lahir  varchar (50),
    tgl_lahir     date,
    alamat        varchar (200),
    umur          int (3),
    no_telp       varchar (15),
    jabatan       varchar (50),
    gaji          int,
    jenis_kelamin char (1),
    primary key (id_pegawai)
);

insert into pegawai values
    ('100001','025469863254103','eko baharuddin','mojokerto', '1981/12/08','surabaya','35','08977322486', 'manager',         '10000000','L'),
    ('100002','512469888635214','Nabila Mirdad','Klaten',     '1996/08/12','surabaya','21','081569874562','kasir',           '3000000', 'P'),
    ('100003','356984521369852','Bambang Syahputra','jakarta','1990/06/15','surabaya','27','087869542356','security',        '3000000', 'L'),
    ('100004','365558512458952','Rudi Agung Putra','Padang',  '1998/10/28','surabaya','18','085732564895','cleaning service','2000000', 'L'),
    ('100005','526353563565634','Kelly Camila','Kalimantan',  '1995/05/02','surabaya','22','081245698523','pegawai',         '3000000', 'P'),
    ('100006','258463685743486','Reza Ahmad Putra','Depok',   '1994/05/12','surabaya','23','088852642358','pegawai',         '3000000', 'L'),
    ('100007','012245645263455','Maria Mercedes','Papua',     '1996/05/02','surabaya','23','088852642358','pegawai',         '3000000', 'P'),
    ('100008','214574816846354','Stephanie Putri','Sulawesi', '1995/10/12','surabaya','22','085966354862','pegawai',         '3000000', 'P');

create table studio (
    id_studio char (5) not null,
    no_studio char (3),
    kapasitas int (4),
    primary key (id_studio)
);

insert into studio values
    ('Std1','1','75'),
    ('Std2','2','75'),
    ('Std3','3','75');

create table film (
    id_film            char (10) not null,
    nama_film          varchar (100),
    tahun_pembuatan    varchar (5),
    genre              varchar (50),
    pemain             varchar (100),
    deskripsi_film     varchar (1000),
    tgl_mulai_tayang   date,
    tgl_selesai_tayang date,
    durasi             varchar (15),
    primary key (id_film)
);

insert into film values
    ('FILM0001','LOGAN','2017','action','Hugh Jackman',
        'Pada tahun 2024, Logan (Hugh Jackman) dan Profesor Charles Xavier (Patrick Stewart) harus bertahan tanpa X-Men ketika perusahaan yang dipimpin oleh Nathaniel Essex menghancurkan dunia. ',
        '2017/02/03','2017/03/03','136 menit'),
    ('FILM0002','MAX STEEL','2017','action','Ben Winchell',
        'Max McGrath (Ben Winchell) adalah seorang remaja berusia 16 tahun yang tengah beradaptasi dengan lingkungan barunya. Tidak lama sejak kepindahannya, ia menemukan bahwa sang almarhum ayah yang pernah bekerja sebagai ilmuwan telah mewariskan kekuatan super yang dapat merubah energi di sekelilingnya.',
        '2017/02/28','2017/03/28','92 menit'),
    ('FILM0003','LONDON LOVE STORY','2017','romance','Dimas Anggara',
        'Caramel sangat bahagia. Betapa tidak, impiannya sejak kecil untuk melihat dan bermain salju akhirnya terwujud karena Dave memberinya hadiah kejutan liburan ke Swiss untuk merayakan ulang tahun Caramel.',
        '2017/03/02','2017/04/02', '100 menit'),
    ('FILM0004','DORAEMON THE MOVIE: NOBITA AND THE BIRTH OF JAPAN','2017','animation','Tom cruse',
        'Dalam film Doraemon terbaru, Nobita dan teman-teman menempuh perjalanan waktu untuk kembali ke Jepang di masa prasejarah dimana mereka akan membangun sebuah kota impian. Di waktu yang sama, mereka bertemu dengan seorang bocah bernama Kukuru yang berada dalam masalah karena sukunya ditindas oleh dukun misterius bernama Gigazombie. Mampukah Nobita dan kawan-kawan menyelamatkan Kukuru beserta anggota sukunya yang tertindas?',
        '2017/03/05','2017/04/05','103 menit'),
    ('FILM0005','LION','2017','drama','Nicole Kidman',
        'Ketika Saroo baru berusia lima tahun, ia hidup dalam kemiskinan bersama ibu dan saudara-saudaranya di sebuah kota di India. Saroo dan kakak lelakinya, Guddu sering pergi bersama untuk mengemis di sebuah stasiun kereta. Pada suatu hari, Guddu memberitahu adiknya jika ia akan naik kereta ke kota lain. Mendengar perkataan ini, Saroo memohon kakanya untuk ikut bersamanya. Guddu mengabulkan permohonan adiknya dan pada saat mereka sampai di tempat tujuan, Guddu memberitahu Saroo untuk menunggunya di sebuah peron kereta.',
        '2017/03/01','2017/04/01','118 menit');

create table pemesan (
    id_pemesan            char (10) not null,
    nama_pemesan          varchar (100),
    no_telfon_pemesan     varchar (15),
    tempat_lahir_pemesan  varchar (100),
    tanggal_lahir_pemesan date,
    alamat                varchar (100),
    jenis_kelamin         char (1),
    primary key (id_pemesan)
);

insert into pemesan values
    ('200001','Nadia Rahmatin', '087878854753','Brunei',  '1996/11/06','Keputih gg 2',   'P'),
    ('200002','Nanang Taufan',  '081358696658','Lombok',  '1995/07/15','Perumdos Blok J','L'),
    ('200003','Tiara Anggita',  '085614522258','Jakarta', '1996/12/11','Keputih',        'P'),
    ('200004','Hilman Muhammad','081966585526','Jakarta', '1996/11/24','Mulyosari',      'L'),
    ('200005','Kania Amalia',   '08268563489', 'Jakarta', '1996/09/21','Mulyosari',      'P'),
    ('200006','Fourir Akbar',   '081356893315','Surabaya','1996/04/25','Rungkut',        'L'),
    ('200007','Aditya Gunawan', '082576352869','Surabaya','1996/11/26','Keputih',        'L');

create table memutar (
    id_memutar      char (10) not null,
    id_film         char (10) not null,
    id_studio       char (5),
    waktu_pemutaran time,
    waktu_selesai   time,
    primary key (id_memutar),
    foreign key (id_film)   references film (id_film),
    foreign key (id_studio) references studio (id_studio)
);

insert into memutar values
    ('M001','FILM0001','Std1','0000-00-00 12:00:00','0000-00-00 14:30:00'),
    ('M002','FILM0001','Std1','0000-00-00 15:00:00','0000-00-00 17:30:00'),
    ('M003','FILM0001','Std1','0000-00-00 18:00:00','0000-00-00 20:30:00'),
    ('M004','FILM0002','Std2','0000-00-00 12:00:00','0000-00-00 13:45:00'),
    ('M005','FILM0004','Std2','0000-00-00 14:00:00','0000-00-00 15:45:00'),
    ('M006','FILM0002','Std2','0000-00-00 16:00:00','0000-00-00 17:45:00'),
    ('M007','FILM0002','Std2','0000-00-00 18:00:00','0000-00-00 19:45:00'),
    ('M008','FILM0004','Std2','0000-00-00 20:00:00','0000-00-00 21:45:00'),
    ('M009','FILM0003','Std3','0000-00-00 12:00:00','0000-00-00 14:00:00'),
    ('M010','FILM0005','Std3','0000-00-00 14:30:00','0000-00-00 16:30:00'),
    ('M011','FILM0003','Std3','0000-00-00 17:00:00','0000-00-00 19:00:00'),
    ('M012','FILM0005','Std3','0000-00-00 19:30:00','0000-00-00 21:30:00');


create table menjaga (
    id_jaga      char (10) not null,
    id_pegawai   char (10) not null,
    id_studio    char (5)  not null,
    jam_mulai    time,
    jam_selesai  time,
    tanggal_jaga date,
    primary key (id_jaga),
    foreign key (id_pegawai) references pegawai (id_pegawai),
    foreign key (id_studio)  references studio (id_studio)
);

insert into menjaga values
    ('J001','100005','Std1','0000-00-00 11:00:00','0000-00-00 15:00:00','2017-03-07'),
    ('J002','100008','Std1','0000-00-00 15:00:00','0000-00-00 19:00:00','2017-03-07'),
    ('J003','100005','Std1','0000-00-00 19:00:00','0000-00-00 22:30:00','2017-03-07'),
    ('J004','100006','Std2','0000-00-00 11:00:00','0000-00-00 15:00:00','2017-03-07'),
    ('J005','100006','Std2','0000-00-00 15:00:00','0000-00-00 19:00:00','2017-03-07'),
    ('J006','100008','Std2','0000-00-00 19:00:00','0000-00-00 22:30:00','2017-03-07'),
    ('J007','100007','Std3','0000-00-00 11:00:00','0000-00-00 15:00:00','2017-03-07'),
    ('J008','100007','Std3','0000-00-00 15:00:00','0000-00-00 19:00:00','2017-03-07'),
    ('J009','100007','Std3','0000-00-00 19:00:00','0000-00-00 22:30:00','2017-03-07');

insert into menjaga values
    ('J010','100005','Std1','0000-00-00 11:00:00','0000-00-00 15:00:00','2017-03-08'),
    ('J011','100008','Std1','0000-00-00 15:00:00','0000-00-00 19:00:00','2017-03-08'),
    ('J012','100005','Std1','0000-00-00 19:00:00','0000-00-00 22:30:00','2017-03-08'),
    ('J013','100006','Std2','0000-00-00 11:00:00','0000-00-00 15:00:00','2017-03-08'),
    ('J014','100006','Std2','0000-00-00 15:00:00','0000-00-00 19:00:00','2017-03-08'),
    ('J015','100006','Std2','0000-00-00 19:00:00','0000-00-00 22:30:00','2017-03-08'),
    ('J016','100008','Std3','0000-00-00 11:00:00','0000-00-00 15:00:00','2017-03-08'),
    ('J017','100007','Std3','0000-00-00 15:00:00','0000-00-00 19:00:00','2017-03-08'),
    ('J018','100007','Std3','0000-00-00 19:00:00','0000-00-00 22:30:00','2017-03-08');


create table transaksi (
    id_transaksi      char (10) not null,
    id_pegawai        char (10) not null,
    id_memutar        char (10) not null,
    id_pemesan        char (10) not null,
    jumlah_tiket      int (3),
    harga_pertiket    int,
    tanggal_pembelian date,
    total_pembayaran  int,
    primary key (id_transaksi),
    foreign key (id_pegawai) references pegawai (id_pegawai),
    foreign key (id_memutar) references memutar (id_memutar),
    foreign key (id_pemesan) references pemesan (id_pemesan)
);

insert into transaksi values
    ('T0001','100002','M001','200001','5', '35000','2017-03-06','11'),
    ('T0002','100002','M001','200004','2', '35000','2017-03-06','11'),
    ('T0003','100002','M001','200003','9', '35000','2017-03-06','11'),
    ('T0004','100002','M006','200002','25','35000','2017-03-06','11'),
    ('T0005','100002','M003','200002','2', '35000','2017-03-06','11'),
    ('T0006','100002','M008','200004','7', '35000','2017-03-07','11'),
    ('T0007','100002','M007','200007','4', '35000','2017-03-07','11'),
    ('T0008','100002','M006','200006','2', '35000','2017-03-07','11'),
    ('T0009','100002','M012','200005','6', '35000','2017-03-07','11'),
    ('T0010','100002','M011','200001','4', '35000','2017-03-07','11'),
    ('T0011','100002','M001','200007','8', '35000','2017-03-08','11'),
    ('T0012','100002','M011','200005','6', '35000','2017-03-08','11'),
    ('T0013','100002','M009','200003','10','35000','2017-03-08','11'),
    ('T0014','100002','M003','200002','1', '35000','2017-03-08','11'),
    ('T0015','100002','M010','200007','6', '35000','2017-03-09','11'),
    ('T0016','100002','M004','200006','7', '35000','2017-03-09','11'),
    ('T0017','100002','M002','200001','13','35000','2017-03-10','11'),
    ('T0018','100002','M004','200005','6', '35000','2017-03-10','11'),
    ('T0019','100002','M006','200006','7', '35000','2017-03-11','11'),
    ('T0020','100002','M005','200005','15','35000','2017-03-12','11');


-- Code: D --
-- 1 --
create view film_8_maret
as
    select
        film.nama_film,
        count(*) * transaksi.jumlah_tiket "Jumlah Penonton"
    from
        transaksi
        left join memutar
        on        transaksi.id_memutar = memutar.id_memutar
        left join film
        on        film.id_film = memutar.id_film
    where    tanggal_pembelian = "2017-03-08"
    group by transaksi.id_memutar;

# test
select * from film_8_maret;

-- 2 --
create table log_memutar (
    id_film         char (10),
    nama_film       varchar (100),
    tanggal_mulai   date,
    tanggal_selesai date,
    status_         varchar (100)
);

delimiter $$
create trigger   before_update_memutar
before update on film
for each row
begin
    insert into log_memutar
    values      (old.id_film, old.nama_film, old.tgl_mulai_tayang, old.tgl_selesai_tayang, "BEFORE UPDATE");
end$$
delimiter ;

delimiter $$
create trigger  after_update_memutar
after update on film
for each row
begin
    insert into log_memutar
    values      (new.id_film, new.nama_film, new.tgl_mulai_tayang, new.tgl_selesai_tayang, "AFTER UPDATE");
end$$
delimiter ;

delimiter $$
create trigger  insert_memutar
after insert on film
for each row
begin
    insert into log_memutar
    values      (new.id_film, new.nama_film, new.tgl_mulai_tayang, new.tgl_selesai_tayang, "INSERT");
end$$
delimiter ;

delimiter $$
create trigger   delete_memutar
before delete on film
for each row
begin
    insert into log_memutar
    values      (old.id_film, old.nama_film, old.tgl_mulai_tayang, old.tgl_selesai_tayang, "DELETE");
end$$
delimiter ;

# test
insert into FILM values (
    'FILM6666','Test Film 1','2017','dummy','Ronald Andrean',
    'Just watch it.',
    '2017/02/03','2017/03/03','600 menit'
);
update film set nama_film = "Test Film 1 Revised" where nama_film = "Test Film 1";
delete from film where id_film = "FILM6666";

-- 3 --
delimiter $$
create procedure hapus_film (id char (10))
begin
    delete from memutar where id_film = id;
    delete from film    where id_film = id;
end$$
delimiter ;

# test
insert into FILM values (
    'FILM7777','Test Film 2','2017','dummy','Ronald Andrean',
    'Just watch it.',
    '2017/02/03','2017/03/03','600 menit'
);
call hapus_film ("FILM7777");

-- 4 --
delimiter $$
create function get_bonus (id char (10))
returns         int
deterministic
begin

    declare bonus_ int;
    select sum(bonus)
    from   (
        select (shift-2)*100000 as bonus, bns.id_pegawai
        from   (
            select   count(*) shift, pegawai.id_pegawai
            from     menjaga
                     left join pegawai
                     on        menjaga.id_pegawai = pegawai.id_pegawai
            group by tanggal_jaga, pegawai.id_pegawai
            having   shift > 2
        ) bns
    ) ttl
    where  ttl.id_pegawai = id
    into   bonus_;
    return ifnull (bonus_, 0);

end$$
delimiter ;

# test
insert into menjaga values ('J019','100007','Std3','0000-00-00 19:00:00','0000-00-00 22:30:00','2017-03-08');
select
    pegawai.id_pegawai,
    pegawai.nama_pegawai,
    pegawai.jabatan,
    pegawai.gaji,
    get_bonus (pegawai.id_pegawai) "Bonus"
from pegawai;
