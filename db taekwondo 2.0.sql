drop database ATAFocusSystemCamobi;
create database ATAFocusSystemCamobi;
use ATAFocusSystemCamobi;
create table escola(
	escolaID int auto_increment not null,
    endereco varchar(100) not null,
    primary key (escolaID)
);
create table plano(
	planoID int auto_increment not null,
    nome varchar(15) not null,
    valor varchar(8),
    escolaID int not null,
    primary key (planoID),
    foreign key(escolaID) references escola(escolaID)
);
create table turma(
	turmaID int auto_increment not null,
    dias varchar(10) not null,
    hora varchar(5) not null,
    escolaID int not null,
    planoID int not null,
    primary key(turmaID),
    foreign key(escolaID) references escola(escolaID),
    foreign key(planoID) references plano(planoID)
);
create table usuario(
	userID int auto_increment not null,
    nome varchar(45) not null,
    telefone varchar(11) not null,
    dataNascimento varchar(10) not null,
    idade varchar(15) not null,
    graduacao varchar(4) not null,
    login varchar(20) not null,
    senha varchar(20) not null,
    endereco varchar(100),
    escolaID int not null,
    planoID int not null,
    turmaID int not null,
    primary key(userID),
    foreign key(escolaID) references escola(escolaID),
    foreign key(planoID) references plano(planoID),
    foreign key(turmaID) references turma(turmaID)
);
create table instrutor(
	instrutorID int not null auto_increment,
    colarinho varchar(5) not null,
    salario varchar(10),
    userID int not null,
    primary key(instrutorID),
    foreign key(userID) references usuario(userID)
);
create table instrutorporturma(
	iptID int not null auto_increment,
    turmaID int not null,
    instrutorID int not null,
    primary key(iptID),
    foreign key(turmaID) references turma(turmaID),
    foreign key (instrutorID) references instrutor(instrutorID)
);
create table eventos(
	eventoID int auto_increment not null,
    nome varchar(50) not null,
    dataEvento varchar(10) not null,
    tipoEvento varchar(20) not null,
    localizacao varchar(100) not null,
    horas varchar(5) not null,
    primary key(eventoID)
)
