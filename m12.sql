create database coba;
use coba;

create table mhs (
    nim     varchar (5),
    namaMhs varchar (30),
    primary key (nim)
);

create table mk (
    kodeMK varchar (5),
    namaMk varchar (20),
    sks    int,
    primary key (kodeMK)
);

create table ambilmk (
    nim    varchar(5),
    kodeMk varchar (5),
    nilai  int,
    primary key (nim, kodeMk)
);

insert into mhs values
    ("001", "Joko"),
    ("002", "Amir"),
    ("003", "Budi");

insert into mk values
    ("A01", "Kalkulus", 3),
    ("A02", "Geometri", 2),
    ("A03", "Aljabar",  3);

insert into ambilmk values
    ("001", "A01", 3),
    ("001", "A02", 4),
    ("001", "A03", 2),
    ("002", "A02", 3),
    ("002", "A03", 2),
    ("003", "A01", 4),
    ("003", "A03", 3);

-- 1
select * from mhs
where nim = (
    select nim from ambilmk
    where kodeMk = "A02"
    order by nilai desc
    limit 1
);

-- 2
select * from mhs
where mhs.nim in (
    select distinct nim
    from ambilmk
    where nilai > (select avg(nilai) from ambilmk where kodeMk = "A03") and kodeMk = "A03"
);

-- 3
select * from mhs
where nim not in (select distinct nim from ambilmk where kodeMk = "A01");