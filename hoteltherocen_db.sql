create database hoteltherocen_db;
use hoteltherocen_db;
create table booking(
id_tamu int auto_increment primary key,
name varchar(50),
email varchar(50),
room text(20),
checkin date,
checkout date
);

create table admin(
id_admin int auto_increment primary key,
nama varchar(50),
sandi text(100)
);

insert into admin(nama, sandi)
values('rosa', 'admin123');

SELECT * FROM admin;

ALTER TABLE booking
ADD price INT,
ADD total INT;

ALTER TABLE booking
ADD bukti VARCHAR(5);

create table room(
id_room int auto_increment primary key,
nama_kamar varchar(50),
gambar_kamar varchar(50),
harga int,
fasilitas text(100)
);

TRUNCATE TABLE room;
DROP TABLE room;
drop database hoteltherocen_db;