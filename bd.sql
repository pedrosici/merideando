create database merideando;
use merideando;

create table usuarios(
	id int not null auto_increment primary key,
	nombre varchar(500) not null,
	usuario varchar(100) not null unique,
	email varchar(255) not null unique,
	password varchar(255) not null,
	fecha_creacion datetime not null
);