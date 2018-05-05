create database shisha;
create table knowledge (
	id int primary key auto_increment,
	author varchar(10),
	date datetime,
	title varchar(105),
	contents varchar(7777),
	url varchar(1000),
	imgLinkID int
);
create table urlLink (
	id int primary key auto_increment,
	title varchar(99),
	url varchar(999)
);
insert into urlLink (title, url) values ("batch", "https://photos.google.com/photo/AF1QipMGu5M6k8IHaL5k9GBPo67fQ5QSxcFxOOtpqip2");
insert into urlLink (title, url) values ("Ruby", "https://photos.google.com/photo/AF1QipNard_qaCUyQxcFUBwmlvfufIqllPM4F1-l7RsO");
insert into urlLink (title, url) values ("Vagrant", "https://photos.google.com/photo/AF1QipMDdBN-feY4cAasOpGpZJl4SLfxiJeImJ_5Vnul");
insert into urlLink (title, url) values ("PHP", "https://photos.google.com/photo/AF1QipNtM3GGEzkAb1C-5t7ly3PVeq_SJvMEM1yXcrbB");