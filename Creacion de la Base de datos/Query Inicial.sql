drop database if exists usuarios;
create database usuarios;
use usuarios;

create table usuario (
	dni varchar(9) unique primary key not null,
	apellido varchar(50) not null,
	tipo_usuario tinyint not null
);

create table asignatura (
	identificador int(3) primary key auto_increment,
	nombre varchar(30)
);

create table nota (
	alumno varchar(9),
	asignatura int(3),		
	nota int not null,
	primary key (alumno, asignatura),
	constraint al foreign key(alumno) references usuario(dni) on delete cascade,
	constraint asig foreign key(asignatura) references asignatura(identificador) on delete cascade
);

insert into usuario values ('11111111A', 'dani', 0);
insert into usuario values ('22222222B', 'gutierrez', 0);
insert into usuario values ('33333333C', 'garcia', 1);
insert into usuario values ('44444444D', 'martinez', 1);
insert into usuario values ('55555555E', 'dominguez', 1);
insert into asignatura values('default', 'Php');
insert into asignatura values('default', 'Bootstrap');
insert into asignatura values('default', 'Java');
insert into asignatura values('default', 'JavaScript');
insert into asignatura values('default', 'MySql');
insert into nota values('33333333C','1','5');
insert into nota values('33333333C','2','6');
insert into nota values('33333333C','4','7');
insert into nota values('44444444D','5','7');
insert into nota values('44444444D','3','7');
insert into nota values('44444444D','1','7');
insert into nota values('55555555E','1','3');
insert into nota values('55555555E','2','5');
insert into nota values('55555555E','3','7');
