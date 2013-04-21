create database flighttest;
use flighttest;

create table waypoints (
wp_code varchar(7),
longtitude double,
latitude double
);

create table airports (
wp_code varchar(7),
name varchar(100),
elevation double
);

create table aircrafts (
ac_name varchar(50),
cruise_speed int,
max_altitude int,
fuel_pp int
);

create table routes (
rt_code varchar(20),
airline varchar(50),
ac_name varchar(15),
wp_from varchar(7),
wp_to varchar(7)
);

create table route_details (
rt_code varchar(20),
num_in_route int,
wp_code varchar(7)
);

insert into waypoints values ('DTTJ', 33.88, 10.77);
insert into waypoints values ('KOMAR', 44.96, 16.8);
insert into waypoints values ('TPS', 47.49, 19.45);
insert into waypoints values ('EPKT', 50.47, 19.08);

insert into airports values ('EPKT', 'Katowice International Airport', 0.9);
insert into airports values ('DTTJ', 'Zarzis Airport', 0);

insert into aircrafts values ('Boeing 747-400', 918, 15, 1240);

insert into routes values ('test', 'airline1', 'Boeing 747-400', 'DTTJ', 'EPKT');

insert into route_details values ('test', 0, 'DTTJ');
insert into route_details values ('test', 1, 'KOMAR');
insert into route_details values ('test', 2, 'TPS');
insert into route_details values ('test', 3, 'EPKT');