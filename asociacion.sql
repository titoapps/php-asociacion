
USE asociacion;

drop table if exists Agenda cascade;
drop table if exists AnswerToSurveys cascade;
drop table if exists JobOffers cascade;
drop table if exists Members cascade;
drop table if exists News cascade;
drop table if exists Surveys cascade;
drop table if exists Users cascade;
drop table if exists UserType cascade;
drop table if exists Activities cascade;
drop table if exists Address;
drop table if exists Answer;
drop table if exists Images cascade;
drop table if exists Streets cascade;


create table Images (

  idImage INT UNSIGNED NOT NULL AUTO_INCREMENT,
  imageName    VARCHAR(100),
  path    VARCHAR(100) NOT NULL,

  constraint PK_IMAGES PRIMARY KEY (idImage)

);

/*Galery images*/
insert into Images (imageName, path) values ('callefloranes','images/galery/callefloranes.jpg');
insert into Images (imageName, path) values ('escaparatefruteria','images/galery/escaparatefruteria.jpg');
insert into Images (imageName, path) values ('escaparatemodels','images/galery/escaparatemodels.jpg');

/*members*/
insert into Images (imageName, path) values ('carnicerialogo','images/members/carnicerialogo.jpg');
insert into Images (imageName, path) values ('fruteriafloraneslogo','images/members/fruteriafloraneslogo.jpg');
insert into Images (imageName, path) values ('tascalogo','images/members/tascalogo.jpg');

CREATE TABLE News (

  idNew           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title           VARCHAR(100) NOT NULL,
  subtitle        VARCHAR(100) NOT NULL,
  description     VARCHAR(300) NOT NULL,
  startDate       DATE NOT NULL,
  endDate         DATE,
  idImage         INT UNSIGNED,

  constraint PK_NEWS PRIMARY KEY (idNew),
  constraint FK_NEWS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)

);

insert into news (title, subtitle, description, startDate,endDate, idImage)
values ('Comienzan las fiestas del Patrón ¡No te las pierdas!','','Llega el fin de semana y con él nuestro ansiado aniversario,
 en el que todos podreis participar para hacerlo mas divertido que nunca. Con multitud de eventos, conciertos, concursos y actividades para todos. Elige tus preferidos y diviértete con..',
        DATE('2013-05-18 00:00:00'),DATE('2014-09-18 00:00:00'),null);

insert into news (title, subtitle, description, startDate,endDate, idImage)
values ('Se ultiman los preparativos para este fin de semana','','Ya tenemos los horarios de todos
los eventos programados para la celebracion del fin de semana, en que se conmemorará el 15º aniversario de la asociación...',
        DATE('2013-05-17 00:00:00'),DATE('2014-10-20 00:00:00'),null );

insert into news (title, subtitle, description, startDate,endDate, idImage)
values ('Ya está en marcha la campaña de promiciones y descuentos','','Como todos los años sobre estas fechas los comercios de la
asociación ya empiezan la campaña de promociones por las fiestas del patrón. Además de los descuentos, por cada compra superior a 15€ podrás participar en el sorteo de regalos..',
        DATE('2013-05-6 00:00:00'),DATE('2013-09-18 00:00:00'),null );

CREATE TABLE Agenda (

  idAgenda        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title           VARCHAR(100) NOT NULL,
  subtitle        VARCHAR(100) NOT NULL,
  description     VARCHAR(300) NOT NULL,
  date            DATE NOT NULL,
  idImage         INT UNSIGNED,

  constraint PK_AGENDA PRIMARY KEY (idAgenda),
  constraint FK_AGENDA_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)

);

insert into Agenda (title, subtitle, description, date, idImage) values ('Fiestas del Patrón','Ven a celebrar con nosotros las fiestas del patron de la asociación y disfruta de los conciertos, concursos..','',DATE('2013-05-21 00:00:00'),null);
insert into Agenda (title, subtitle, description, date, idImage) values ('Talleres de manualidades','¡Nuestro divertidos e interesantes talleres! Busca las actividades que mas te gusten y participa ¡reserva ya tu plaza!','',DATE('2013-04-1 00:00:00'),null);
insert into Agenda (title, subtitle, description, date, idImage) values ('Pasacalles','Los compañeros de la Escuela de Musica "Solfa" realizarán pequeñas actuaciones por nuestras calles ..','',DATE('2013-03-14 00:00:00'),null);

CREATE TABLE Answer (

  idAnswer       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  answerTitle    VARCHAR(100) NOT NULL,

  constraint PK_ANSWER PRIMARY KEY (idAnswer)

);

insert Answer values (1,'Es bueno para la calle.');
insert Answer values (2,'Es un engorro, imposible para circular y aparcar.');
insert Answer values (3,'NS/NC.');

CREATE TABLE Surveys (

  idSurvey       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  surveyTitle          VARCHAR(150) NOT NULL,

  constraint PK_SURVEYS PRIMARY KEY (idSurvey)

);

insert into Surveys values (1,'¿Qué le parece la renovación de las aceras de la calle Floranes?');

CREATE TABLE AnswerToSurveys (

  idAnswer       INT UNSIGNED NOT NULL,
  idSurvey      INT UNSIGNED NOT NULL,

  constraint PK_ANSWER_TO_SURVEYS PRIMARY KEY (idAnswer,idSurvey),
  constraint FK_ANSWER_TO_SURVEYS_SURVEY FOREIGN KEY (idSurvey) REFERENCES Surveys(idSurvey),
  constraint FK_ANSWER_TO_SURVEYS_ANSWER FOREIGN KEY (idAnswer) REFERENCES Answer(idAnswer)

);

insert into AnswerToSurveys values (1,1);
insert into AnswerToSurveys values (2,1);
insert into AnswerToSurveys values (3,1);


CREATE TABLE Streets (

  idStreet  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  streetName      VARCHAR (30) NOT NULL,

  constraint PK_STREET PRIMARY KEY (idStreet)
);

insert into Streets values (1,'Alonso');
insert into Streets values (2,'Floranes');
insert into Streets values (3,'Cisneros');
insert into Streets values (4,'Francisco Cubría');
insert into Streets values (5,'Narciso Cuevas');
insert into Streets values (6,'San Fernando');
insert into Streets values (7,'Vargas');


CREATE TABLE Address (

  idAddress  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  idStreet   INT UNSIGNED NOT NULL,
  number     SMALLINT,
  floor      SMALLINT,
  door       varchar (10),
  postalCode SMALLINT,

  constraint PK_STREET PRIMARY KEY (idAddress),
  constraint FK_STREET FOREIGN KEY (idStreet) references Streets(idStreet)

);

insert into Address values (1,2,19,-1,'A',39010);
insert into Address values (2,1,23,4,'E',39010);
insert into Address values (3,3,1,0,'B',39015);
insert into Address values (4,3,5,0,'A',39015);
insert into Address values (5,5,30,2,'E',39011);
insert into Address values (6,5,22,2,'A',39011);
insert into Address values (7,5,40,2,'E',39011);


CREATE TABLE Activities (

  idActivity  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  activityName        VARCHAR (30),

  constraint PK_ACTIVITIES PRIMARY KEY (idActivity)

);

insert into Activities values (1,'Agencias de Viajes');
insert into Activities values (2,'Fruteria');
insert into Activities values (3,'Animales');
insert into Activities values (4,'Calzados');
insert into Activities values (5,'Carniceria');
insert into Activities values (6,'Fotografia');
insert into Activities values (7,'Deportes');
insert into Activities values (8,'Electrodomésticos');
insert into Activities values (9,'Electrónica');
insert into Activities values (10,'Estanco');
insert into Activities values (11,'Farmacia');
insert into Activities values (12,'Ferreteria');


CREATE TABLE Members (

  idMember    INT UNSIGNED NOT NULL AUTO_INCREMENT,
  -- TODO:password encryption?? SSL transmision
  password    VARCHAR (30) NOT NULL,
  NIF         VARCHAR (10) NOT NULL UNIQUE,
  name        VARCHAR (80),
  description VARCHAR (100),
  idImage     INT UNSIGNED,
  idAddress   INT UNSIGNED NOT NULL,
  idActivity  INT UNSIGNED NOT NULL,
  phoneNumber SMALLINT,
  email       VARCHAR (50),

  constraint PK_MEMBERS PRIMARY KEY (idMember),
  constraint FK_MEMBERS_ID_ADDRESS FOREIGN KEY (idAddress) references Address(idAddress),
  constraint FK_MEMBERS_ID_ACTIVITY FOREIGN KEY (idActivity) references Activities(idActivity),
  constraint FK_MEMBERS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)
);

insert into Members values (1,'frute','12524296Z','Floranes 19 Fruteria','Frutas y Verduras de Cultivo Tradicional y Ecológico ',5,1,2,699999999,'floranes19fruteria@gmail.com');
insert into Members values (2,'carni','05166885G','Carniceria Eño','Carnes selectas de Cantabria',2,2,5,699999999,'carniceriaeno@gmail.com');
insert into Members values (3,'foto','60675704W','Fotos Marcelo','Desde 1973',3,3,6,699999999,'fotosmarcelo@hotmail.com');
insert into Members values (4,'electro','12947461W','Electrodomesticos Master','Las mejores marcas al mejor precio',4,4,8,699999999,'eletromaster@hotmail.com');
insert into Members values (5,'deport','22531651T','Deportes Sapporo','Ropa, calzado y material deportivo',5,5,7,699999999,'sapporodeportes@hotmail.com');
insert into Members values (6,'ferro','19550494B','Ferreteria montañesa','Desde 1945',6,6,12,699999999,'ferreteriamontanesa@yahoo.com');
insert into Members values (7,'calza','98584290B','La Defensa Calzado','Expertos en ',6,6,12,699999999,'ladefensa@yahoo.com');
insert into Members values (8,'cafe','98584290Z','Sailors','Cafeteria ',6,6,12,699999999,'cafeteriaSailors@yahoo.com');


CREATE TABLE UserType (

  idUserType  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name        VARCHAR (10),
  description VARCHAR (30),

  constraint PK_USER_TYPE PRIMARY KEY (idUserType)
);

insert into UserType values (2,'user','regitered web user');
insert into UserType values (1,'administrator','web administrator');

CREATE TABLE Users (

  idUser      INT UNSIGNED NOT NULL AUTO_INCREMENT,
  password    VARCHAR (30) NOT NULL,
  NIF         VARCHAR (10) NOT NULL UNIQUE,
  name        VARCHAR (30),
  nickName    VARCHAR (30),
  surname     VARCHAR (30),
  idImage     INT UNSIGNED,
  idAddress   INT UNSIGNED NOT NULL,
  phoneNumber SMALLINT,
  email       VARCHAR (30),
  idUserType  INT UNSIGNED NOT NULL,
  joinDate    DATE ,
  gender      char,

  constraint PK_USERS PRIMARY KEY (idUser),
  constraint FK_USERS_ADDRESS FOREIGN KEY (idAddress) references Address(idAddress),
  constraint FK_USERS_TYPE FOREIGN KEY (idUserType) references UserType(idUserType),
  constraint FK_USERS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage),
  constraint CHK_USERS_GENDER check(gender = 'M'|| gender ='F')

);

insert into Users (password, NIF, name, nickName, surname, idImage, idAddress, phoneNumber, email, idUserType,joinDate,gender)
values (password('root'),'123456789r','administrator','admin','',null,1,666666666,'admin@asociacionaloflo.com',1,DATE('2013-05-17 00:00:00'),'M');

insert into Users (password, NIF, name, nickName, surname, idImage, idAddress, phoneNumber, email, idUserType,joinDate,gender)
values (password('user1'),'1r','user1','user1','',null,3,666666666,'user1@hotmail.com',2,DATE('2013-05-17 00:00:00'),'F');
insert into Users (password, NIF, name, nickName, surname, idImage, idAddress, phoneNumber, email, idUserType,joinDate,gender)
values (password('user2'),'2w','user2','user2','',null,2,666666666,'user2@hotmail.com',2,DATE('2013-05-17 00:00:00'),'F');

CREATE TABLE JobOffers (

  idOffer         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  idMember        INT UNSIGNED NOT NULL,
  title           VARCHAR(30) NOT NULL,
  description     VARCHAR(50) NOT NULL,
  salaryMin       numeric,
  salaryMax       numeric,
  date            DATE NOT NULL,
  idImage         INT UNSIGNED,

  constraint PK_JOB_OFFERS PRIMARY KEY (idOffer),
  constraint FK_JOB_OFFERS foreign key (idMember) references Members(idMember),
  constraint FK_JOB_OFFERS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage),
  constraint CHK_SALARY_MIN check(salaryMin > 0),
  constraint CHK_SALARY_MAX check(salaryMax > 0),
  constraint CHK_SALARY_ check(salaryMin < salaryMax)

);

insert into JobOffers (idMember,title,description,salaryMin,salaryMax,date,idimage)
VALUES ('4','Comercial con experiencia','precisa la incorporación a su plantilla de comerciales de una persona con experiencia en..','18000','24000',DATE('2013-05-21 00:00:00'),null );

insert into JobOffers (idMember,title,description,salaryMin,salaryMax,date,idimage)
VALUES ('8','Camarero para noches','busca camarero con experiencia en elaboración de..','19000','23000',DATE('2013-05-21 00:00:00'),null);

-- TODO:on delete cascade?
/*
INSERT INTO members VALUES( 1, 'sparky', password('mypass'), 'John', 'Sparks', '2007-11-13', 'm', 'crime', 'jsparks@example.com', 'Football, fishing and gardening' );
INSERT INTO members VALUES( 2, 'mary', password('mypass'), 'Mary', 'Newton', '2007-02-06', 'f', 'thriller', 'mary@example.com', 'Writing, hunting and travel' );
INSERT INTO members VALUES( 3, 'jojo', password('mypass'), 'Jo', 'Scrivener', '2006-09-03', 'f', 'romance', 'jscrivener@example.com', 'Genealogy, writing, painting' );
INSERT INTO members VALUES( 4, 'marty', password('mypass'), 'Marty', 'Pareene', '2007-01-07', 'm', 'horror', 'marty@example.com', 'Guitar playing, rock music, clubbing' );
INSERT INTO members VALUES( 5, 'nickb', password('mypass'), 'Nick', 'Blakeley', '2007-08-19', 'm', 'sciFi', 'nick@example.com', 'Watching movies, cooking, socializing' );
INSERT INTO members VALUES( 6, 'bigbill', password('mypass'), 'Bill', 'Swan', '2007-06-11', 'm', 'nonFiction', 'billswan@example.com', 'Tennis, judo, music' );
INSERT INTO members VALUES( 7, 'janefield', password('mypass'), 'Jane', 'Field', '2006-03-03', 'f', 'crime', 'janefield@example.com', 'Thai cookery, gardening, traveling' );
*/
-- TODO:use?
/*CREATE TABLE accessLog (
  memberId        SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  pageUrl         VARCHAR(255) NOT NULL,
  numVisits       MEDIUMINT NOT NULL,
  lastAccess      TIMESTAMP NOT NULL,
  PRIMARY KEY (memberId, pageUrl)
);

INSERT INTO accessLog( memberId, pageUrl, numVisits ) VALUES( 1, 'diary.php', 2 );
INSERT INTO accessLog( memberId, pageUrl, numVisits ) VALUES( 3, 'books.php', 2 );
INSERT INTO accessLog( memberId, pageUrl, numVisits ) VALUES( 3, 'contact.php', 1 );
INSERT INTO accessLog( memberId, pageUrl, numVisits ) VALUES( 6, 'books.php', 4 );*/




