drop database   mbd_3;
create database mbd_3;

create table students (
    snum   int,
    sname  varchar (50),
    major  varchar (50),
    level_ varchar (50),
    age    int,
    primary key (snum)
);

create table lecturers (
    rid    int,
    rname  varchar(50),
    deptid int,
    primary key (rid)
);

create table class (
    cname    varchar (50),
    meets_at time,
    room     varchar (50),
    credit   int,
    rid      int,
    primary key (cname),
    foreign key (rid) references lecturers (rid)
);

create table enrolled (
    snum  int,
    cname varchar (50),
    foreign key (snum)  references students (snum),
    foreign key (cname) references class (cname)
);

insert into students values
    (0, "Ronald",  "Bachelor", "Level 3", 20),
    (1, "Adi",     "Bachelor", "Level 1", 20),
    (2, "Lucas",   "Bachelor", "Level 3", 21),
    (3, "Andrean", "Bachelor", "Level 4", 20),
    (4, "Unggul",  "Bachelor", "Level 1", 19),
    (5, "Yoza",    "Bachelor", "Level 1", 22),
    (6, "Ari",     "Bachelor", "Level 2", 20),
    (7, "Budi",    "Bachelor", "Level 2", 19);

insert into lecturers values
    (0, "Henry",  0),
    (1, "Imam K", 0),
    (2, "Dwi S", 0),
    (3, "Ridho", 1),
    (4, "Rizky JA", 1),
    (5, "Joko LB", 2),
    (6, "Victor", 3);

insert into class values
    ("Physics",  "07:00", "B15", 3, 0),
    ("History",  "07:00", "A15", 3, 1),
    ("Music",    "07:00", "B15", 3, 2),
    ("Art",      "09:30", "B15", 3, 0),
    ("Math",     "12:30", "C15", 3, 4),
    ("Computer", "15:30", "B15", 3, 5);

insert into enrolled values
    (0, "Physics"),
    (1, "Physics"),
    (2, "Physics"),
    (3, "Physics"),
    (4, "Physics"),
    (5, "Computer"),
    (0, "History"),
    (2, "History"),
    (5, "History"),
    (1, "Music"),
    (3, "Music"),
    (5, "Math"),
    (7, "Math"),
    (2, "Math");

-- 1 --
select * from students
where  snum in (
    select snum from enrolled
    where  cname = "History"
           or
           cname in (
               select cname from class
               where  rid in (
                   select rid from lecturers
                   where  rname = "Henry"
               )
           )
);

-- 2 --
select
    m.level_       'Level',
    m.oldest       'Usia Tertua',
    students.sname 'Nama'
from
    students, (
        select   level_, max(age) oldest
        from     students
        group by level_
    ) m
where
    students.level_ = m.level_
    and
    students.age = m.oldest;

-- 3 --
select * from students
where  age > (
    select max(age) from students
    where  snum in (
        select snum from enrolled
        where  cname = "Physics"
    )
);
        
-- 4 --
select * from students
where  snum in (
    select e1.snum
    from
        enrolled e1 left join class c1
                    on        e1.cname = c1.cname,
        enrolled e2 left join class c2
                    on        e2.cname = c2.cname
    where
        e1.cname <> e2.cname
        and
        e1.snum = e2.snum
        and
        c1.meets_at = c2.meets_at
);

-- 5 --
select * from students
where  snum in (
    select snum from enrolled
    where  cname in (
        select   cname from enrolled
        group by cname
        having   count(*) = (
            select min(member.st)
            from (
                select   count(*) st
                from     enrolled
                group by cname
            ) member
        )
    )
);

-- 6 --
select sname 'Nama'
from   students
where  snum not in (select snum from enrolled);

-- 7 --
select 
    lecturers.rname 'Nama',
    count(*)        'Jumlah Kelas'
from
    lecturers
    right join (select * from class where room = "B15") b15
    on         lecturers.rid = b15.rid
group by lecturers.rid;
