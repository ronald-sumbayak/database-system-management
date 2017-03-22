use mbd_praktikum_1;

--------------------------------------------------------------------------------
------------------------------------- join -------------------------------------

-- inner join
select   concat(film.nama_film, " telah diputar sebanyak ", count(*), " kali.") 'DBMS_OUTPUT'
from     memutar join film
                 on   memutar.id_film = film.id_film
group by memutar.id_film;

-- left (right) join
select *
from   memutar left join studio
               on        memutar.id_studio = studio.id_studio
               left join film
               on        memutar.id_film = film.id_film;

-- outer join
select *
from   pegawai p1 right join menjaga m1
                  on         p1.id_pegawai = m1.id_pegawai
union all
select *
from   pegawai p2 left join menjaga m2
                  on        p2.id_pegawai = m2.id_pegawai;

-- self join
select   concat(f1.nama_film, " mulai tayang setelah ", f2.nama_film) 'DBMS_OUTPUT'
from     film f1 inner join film f2
                 on         f1.tgl_mulai_tayang > f2.tgl_mulai_tayang;

--------------------------------------------------------------------------------
-------------------------------- implicitcursor --------------------------------
delimiter $$
create or replace procedure implicit_cursor ()
begin
    update transaksi
    set    harga_pertiket = 30000
    where  jumlah_tiket > 20;

    -- row_count untuk update/delete/insert
    if row_count() > 0 then
        select concat("Ada ", row_count(), " traksaksi yang mendapat potongan harga tiket") 'DBMS_OUTPUT';
    else
        select "Tidak ada yang mendapat potongan harga_tiket" as 'DBMS_OUTPUT';
    end if;
end$$
delimiter ;

-- test
call implicit_cursor ();

--------------------------------------------------------------------------------
-------------------------------- explicitcursor --------------------------------
delimiter $$
create or replace procedure explicit_cursor ()
begin
    declare id   char (10);
    declare gaji_ int;
    declare done bool default false;

    declare pegawai_cursor cursor
    for select id_pegawai, gaji
        from   pegawai;

    declare continue handler
    for not found
        set done = true;

    open pegawai_cursor;

    retrieve_pegawai: loop
        fetch pegawai_cursor into id, gaji_;
        if done = true then
            leave retrieve_pegawai;
        end if;
        if gaji_ < 5000000 then
            update pegawai set gaji = gaji + 1000000 where id_pegawai = id;
        end if;
    end loop retrieve_pegawai;

    close pegawai_cursor;
end$$
delimiter ;


-- test
call explicit_cursor ();

--------------------------------------------------------------------------------
----------------------------------- sequence -----------------------------------

create table contoh_sequence (
    sequence   int auto_increment,
    dummy_text varchar (10),
    primary key (sequence)
);

-- run this query multiple times.
insert into contoh_sequence (dummy_text) values ("dummy text");

--------------------------------------------------------------------------------
------------------------------------- eof. -------------------------------------
--------------------------------------------------------------------------------