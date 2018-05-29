create database lcmatching_db character set utf8;
use lcmatching_db;
create table lecture(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(50),
  tel varchar(15) UNIQUE KEY,
  mail_address varchar(50) UNIQUE KEY,
  pass varchar(50)
);
create table company(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  company_name varchar(50),
  tel varchar(15) UNIQUE KEY,
  staff varchar(30),
  mail_address varchar(50) UNIQUE KEY,
  pass varchar(50)
);
create table skill_master(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  skilltype varchar(50)
);
create table freeday(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  lecturer_id int,
  begin date,
  end date
);
create table skill_table(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  lecturer_id int,
  skill_id int
);
create table status_master(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  state varchar(50)
);
create table status(
  lecture_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  skill_id int,
  begin date,
  company_id int,
  evaluation date,
  status int
);

insert into lecture values("","永井","080-1234-5678","nagai@gmail.com","naga11111");
insert into lecture values("","川端","112-8765-4321","kawa@yahoo.co.jp","kawaaaaa");
insert into lecture values("","川元","111-2222-3333","kawa@gmail.com","kawaaaaaaa");
insert into lecture values("","山田","222-3333-4444","yamada@gmail.com","yamadaaa");
insert into lecture values("","後藤","111-1111-1111","goto@yahooco.jp","gotoooooo");

insert into company values("","永井自動車","123-4314-5555","ながい","sony@gmail.com","naganaga");
insert into company values("","山田電気","123-5656-9999","やまだ","yama@yama.com","yamayama");
insert into company values("","川元質店","567-7654-7677","かわもと","kawa@kawa.com","kawakawa");
insert into company values("","川端製薬","777-7777-7777","かわばた","bata@bata.com","batabata");
insert into company values("","後藤建設","888-8888-8888","ごとう","goto@goto.com","gotogoto");

insert into skill_master values("","C#");
insert into skill_master values("","Ruby");
insert into skill_master values("","PHP");
insert into skill_master values("","HTML/CSS");
insert into skill_master values("","Java");
insert into skill_master values("","DB/SQL");
insert into skill_master values("","Linux");
insert into skill_master values("","Git");
insert into skill_master values("","Sinatra");
insert into skill_master values("","Rails");
insert into skill_master values("","JavaScript");
insert into skill_master values("","Unity");
insert into skill_master values("","Python");
insert into skill_master values("","Servlet/JSP");
