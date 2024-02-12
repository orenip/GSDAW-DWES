create schema fct;

use fct;

DROP TABLE IF EXISTS empresas;
DROP TABLE IF EXISTS alumnos;

create table empresas (
	emp_id integer not null auto_increment,
    emp_nombre varchar(50),
    primary key (emp_id)
);

create table alumnos (
    alu_id integer not null auto_increment,
    alu_nombre varchar(80) not null,
    alu_empresa integer,
    alu_apto boolean not null default false,
    primary key (alu_id),
    foreign key (alu_empresa) references empresas(emp_id)
);


insert into empresas (emp_nombre) values ('Neoris');
insert into empresas (emp_nombre) values ('NTTData');
insert into empresas (emp_nombre) values ('Introbay');
insert into empresas (emp_nombre) values ('AI Talentum');


insert into alumnos (alu_nombre) values ('Pau Gasol');
insert into alumnos (alu_nombre) values ('Juan Carlos Navarro');
insert into alumnos (alu_nombre) values ('Felipe Reyes');
insert into alumnos (alu_nombre) values ('Jorge Garbajosa');