-- kode soal: B

# 
# !! ATTENTION !!
# 
# Query yang ada dummy gausah dijalanin :v
# Semangat :v
# :v :v
# 

# 1
select film.nama_film,
       memutar.waktu_pemutaran,
       memutar.waktu_selesai,
       studio.no_studio
from   memutar
       left join film
       on        memutar.id_film = film.id_film
       left join studio
       on        memutar.id_studio = studio.id_studio;


# 2
select   pegawai.nama_pegawai,
         count(*) "Jumlah Shift"
from     menjaga
         inner join pegawai
         on         menjaga.id_pegawai = pegawai.id_pegawai
group by pegawai.id_pegawai;


# 3
select p1.nama_pegawai,
       p1.umur,
       p2.nama_pegawai,
       p2.umur
from   pegawai p1
       join pegawai p2
       on   p1.umur > p2.umur;

# 4
delimiter $$
create or replace procedure penonton_logan ()
begin
    select distinct pemesan.nama_pemesan
    from   transaksi
           left join pemesan
           on        transaksi.id_pemesan = pemesan.id_pemesan
           left join memutar
           on        transaksi.id_memutar = memutar.id_memutar
           left join film
           on        memutar.id_film = film.id_film
    where  film.id_film = "FILM0001";
end$$
delimiter ;

call penonton_logan ();

# 5
delimiter $$
create or replace procedure explicit_cursor ()
begin
    declare _idtransk char (10);
    declare _jmltiket int;
    declare done      bool default false;

    declare transaksi_cursor cursor
    for     select id_transaksi, jumlah_tiket
            from   transaksi;

    declare continue handler
    for     not found
            set done = true;

    open transaksi_cursor;

    retrieve_transaksi: loop
        fetch transaksi_cursor into _idtransk, _jmltiket;
        if done = true then
            leave retrieve_transaksi;
        end if;
        if _jmltiket > 10 then
            update transaksi
            set    total_pembayaran = total_pembayaran * 0.9
            where  id_transaksi = _idtransk;
        end if;
    end loop retrieve_transaksi;

    close transaksi_cursor;
end$$
delimiter ;

call explicit_cursor ();


# 6
delimiter $$
create or replace procedure create_dummy ()
begin
    declare i int default 0;
    
    myloop: loop
        if i = 10000 then
            leave myloop;
        end if;
        set i = i + 1;
        insert into   transaksi (id_pegawai, id_memutar, id_pemesan, jumlah_tiket, harga_pertiket, tanggal_pembelian, total_pembayaran)
        values        ("100010", "M016", "200002", "9", 35000, "21-04-2017", 315000);
    end loop myloop;
end $$
delimiter ;

call create_dummy ()
select * from transaksi;
create index index_transaksi on transaksi (id_transaksi);
select * from transaksi;


# 7
delimiter $$
create or replace procedure create_dummy_2 ()
begin
    declare i int default 0;
    
    myloop: loop
        if i = 10000 then
            leave myloop;
        end if;
        set i = i + 1;
        insert into   menjaga (id_pegawai, id_studio, jam_mulai, jam_selesai, tanggal_jaga)
               values ("100012", "Std4", "11:00:00", "15:00:00", "08-03-2017");
    end loop myloop;
end $$
delimiter ;

call create_dummy_2 ();
select * from menjaga;
create index index_menjaga on menjaga (id_jaga);
select * from menjaga;


# 8
select pemesan.nama_pemesan
from   transaksi
       left join pemesan
       on        transaksi.id_pemesan = pemesan.id_pemesan
       left join memutar
       on transaksi.id_memutar = memutar.id_memutar
where  id_film = "FILM0006"
union
select pemesan.nama_pemesan
from   transaksi
       left join pemesan
       on        transaksi.id_pemesan = pemesan.id_pemesan
       left join memutar
       on        transaksi.id_memutar = memutar.id_memutar
where  id_film = "FILM0007";


# 9
select *
from   pemesan
where  id_pemesan in (
       select pemesan.id_pemesan
       from transaksi
            left join pemesan
            on        transaksi.id_pemesan = pemesan.id_pemesan
            left join memutar
            on        transaksi.id_memutar = memutar.id_memutar
            where  id_film = "FILM0007")
                   and
                   id_pemesan not in (
                      select pemesan.id_pemesan
                      from   transaksi
                             left join pemesan
                             on        transaksi.id_pemesan = pemesan.id_pemesan
                             left join memutar
                             on        transaksi.id_memutar = memutar.id_memutar
                      where id_film = "FILM0001");


# 10
select pemesan.nama_pemesan,
       pegawai.nama_pegawai,
       film.nama_film,
       studio.no_studio,
       memutar.waktu_pemutaran
from   memutar
       left join transaksi
       on        transaksi.id_memutar = memutar.id_memutar
       left join pemesan
       on        transaksi.id_pemesan = pemesan.id_pemesan
       left join film
       on        memutar.id_film = film.id_film
       left join studio
       on        memutar.id_studio = studio.id_studio
       left join pegawai
       on        transaksi.id_pegawai = pegawai.id_pegawai;