-- ddl --
create database mbd_lapen_1;
use mbd_lapen_1;

create table customers (
    id      int,
    name_   varchar (50),
    age     int,
    address varchar (100),
    salary  decimal,
    primary key (id)
);

insert into customers
values
    (1, "Ramesh",   32, "Ahmedabad", 2000.0),
    (2, "Khilan",   25, "Delhi",     1500.0),
    (3, "Kaushik",  23, "Kota",      2000.0),
    (4, "Chaitali", 25, "Mumbai",    6500.0),
    (5, "Hardik",   27, "Bhopal",    8500.0),
    (6, "Komal",    22, "MP",        4500.0);


-- 1 --
create view custom_age_salary
as
    select *
    from   customers
    where  age = 25
           or
           salary > 2000.0;

select * from custom_age_salary;


-- 2 --
create table salary_update_log (
    id int,
    diff decimal,
    update_date date
);

delimiter $$
create trigger  salary_log
after update on customers
for each row
begin
    insert into  salary_update_log
    values       (new.id, new.salary-old.salary, sysdate());
end $$
delimiter ;

update customers
set    salary = 10000.0;


-- 3 --
delimiter $$
create function customer_count()
returns int
deterministic
begin
    declare count_ int;
    select count(*) into count_ from customers;
    return count_;
end $$
delimiter ;

select customer_count();


-- 4 --
delimiter $$
create procedure show_customer_above_25 ()
begin
    select *
    from   customers
    where  age > 25;
end$$
delimiter ;

call show_customer_above_25 ();
