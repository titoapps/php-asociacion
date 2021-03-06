
USE asociacion;

drop table if exists Agenda cascade;
drop table if exists AnswerToSurveys cascade;
drop table if exists SurveyResponses cascade;
drop table if exists JobOffers cascade;
drop table if exists Members cascade;
drop table if exists NewComment cascade;
drop table if exists News cascade;
drop table if exists Surveys cascade;
drop table if exists Users cascade;
drop table if exists UserType cascade;
drop table if exists Activities cascade;
drop table if exists Address;
drop table if exists Answer;
drop table if exists Images cascade;
drop table if exists ImageCategory cascade;
drop table if exists Streets cascade;

create table ImageCategory (

  idImageCategory  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  categoryName     VARCHAR(100),

  constraint PK_IMAGES_CATEGORY PRIMARY KEY (idImageCategory)
);

insert into ImageCategory (categoryName) values ('Galeria');
insert into ImageCategory (categoryName) values ('Usuario');
insert into ImageCategory (categoryName) values ('Negocios');

create table Images (

  idImage           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  idImageCategory   INT UNSIGNED NOT NULL,
  imageType         VARCHAR(4),
  imageName         VARCHAR(100),
  path              VARCHAR(100) NOT NULL,
  imageBin          LONGBLOB,

  constraint PK_IMAGES PRIMARY KEY (idImage),
  constraint FK_IMAGES_CATEGORY FOREIGN KEY (idImageCategory) REFERENCES ImageCategory(idImageCategory)

);

insert into Images (idImageCategory,imageType,imageName, imageBin) values (2,'jpg','defaultProfile',LOAD_FILE('/Aplicaciones/XAMPP/xamppfiles/htdocs/asociacion/images/personaDefectoG.jpg'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (1,'jpg','callefloranes',LOAD_FILE('/Aplicaciones/XAMPP/xamppfiles/htdocs/asociacion/images/galery/callefloranes.jpg'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (3,'jpg','escaparatefruteria',LOAD_FILE('images/galery/escaparatefruteria.jpg'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (3,'jpg','escaparatemodels',LOAD_FILE('images/galery/escaparatemodels.jpg'));


insert into Images (idImageCategory,imageType,imageName, imageBin) values (3,'jpg','carnicerialogo',LOAD_FILE('images/members/carnicerialogo.jpg'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (3,'jpg','fruteriafloraneslogo',LOAD_FILE('images/members/fruteriafloraneslogo.jpg'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (3,'jpg','tascalogo',LOAD_FILE('images/members/tascalogo.jpg'));

insert into Images (idImageCategory,imageType,imageName, imageBin) values (1,'png','floranes1',LOAD_FILE('images/galery/floranes1.png'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (1,'png','floranes2',LOAD_FILE('images/galery/floranes2.png'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (1,'jpg','floranes3',LOAD_FILE('images/galery/floranes3.jpg'));
insert into Images (idImageCategory,imageType,imageName, imageBin) values (1,'png','floranes4',LOAD_FILE('images/galery/floranes4.png'));


CREATE TABLE News (

  idNew           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title           VARCHAR(200) NOT NULL,
  subtitle        VARCHAR(300) NOT NULL,
  description     TEXT NOT NULL,
  startDate       DATE NOT NULL,
  endDate         DATE,
  idImage         INT UNSIGNED,

  constraint PK_NEWS PRIMARY KEY (idNew),
  constraint FK_NEWS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)

);

insert into news (title, subtitle, description, startDate,endDate, idImage)
values ('Comienzan las fiestas del Patrón ¡No te las pierdas!','Llega el fin de semana y con él nuestro ansiado aniversario,
 en el que todos podreis participar para hacerlo mas divertido que nunca. Con multitud de eventos, conciertos, concursos y actividades para todos. Elige tus preferidos y diviértete con..',
        'Lñpórem ipsum dolor sit amet, consectetur adipiscing elit. Aenean posuere ex sed placerat tincidunt.
        Proin tincidunt pellentesque orci, ac feugiat lacus ultricies sit amet. Etiam at posuere nisl, id venenatis turpis.
        Fusce ac quam odio. Mauris rutrum nulla eu odio consequat condimentum. Aenean blandit arcu nec arcu placerat, non
        interdum tortor luctus. Maecenas ac egestas velit. Nunc vel dolor cursus, pretium nisi ac, egestas magna. Nulla ut
        convallis nisl. In a massa vel augue bibendum posuere gravida nec magna. Vestibulum ac magna vel ipsum pretium
        molestie. Proin a dolor diam. Suspendisse non tincidunt purus.

Maecenas commodo, leo in luctus commodo, purus sapien commodo orci, et blandit enim ipsum ac tellus. Aliquam erat volutpat.
Nunc in odio sollicitudin, interdum ex eu, condimentum erat. Integer viverra dolor ut quam ornare dignissim. Duis sed congue
odio. Fusce malesuada, nibh nec consectetur porttitor, nunc est tempor tellus, vel mollis risus est id turpis. Maecenas eu
scelerisque dui. Vivamus quis dignissim justo, vitae pretium dui. Sed lacinia ipsum et justo consequat, ac consequat sem
facilisis. Nunc dolor lectus, tempus id euismod sit amet, lobortis at tellus. Cras posuere neque euismod nunc finibus iaculis.
 Mauris ornare imperdiet varius. In fermentum vulputate elit, in commodo lectus porta viverra. Proin magna magna, rutrum vitae
  leo eu, imperdiet semper ligula. Ut vel vehicula orci, nec iaculis urna.',
        DATE('2013-05-18 00:00:00'),DATE('2015-10-18 00:00:00'),null);

insert into news (title, subtitle, description, startDate,endDate, idImage)
values ('Se ultiman los preparativos para este fin de semana','Ya tenemos los horarios de todos
los eventos programados para la celebracion del fin de semana, en que se conmemorará el 15º aniversario de la asociación...',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod semper efficitur. Praesent vulputate diam
        ex, sed vestibulum odio egestas sed. Aenean ullamcorper nulla eros, vel tincidunt augue laoreet eget. Sed quis nibh
        bibendum, congue enim ac, accumsan nisl. Integer porttitor mollis euismod. Aliquam mattis felis magna, eu egestas ante
         placerat sed. Praesent tincidunt venenatis dolor, malesuada efficitur lacus mollis a. Nam vitae dictum eros. Donec
         placerat tempus tellus.',
        DATE('2013-05-17 00:00:00'),DATE('2015-10-20 00:00:00'),null );

insert into news (title, subtitle, description, startDate,endDate, idImage)
values ('Ya está en marcha la campaña de promiciones y descuentos','Como todos los años sobre estas fechas los comercios de la
asociación ya empiezan la campaña de promociones por las fiestas del patrón. Además de los descuentos, por cada compra superior a 15€ podrás participar en el sorteo de regalos..',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec nibh id magna venenatis pharetra. Nullam feugiat
    mauris et sem commodo lobortis. Suspendisse faucibus ornare euismod. Nulla in sapien lobortis, consectetur est quis, imperdiet nunc.
    Integer non risus bibendum, efficitur libero et, congue leo. Sed eget tellus dui. Sed sodales quam non eleifend suscipit.
    Aliquam gravida molestie risus in consectetur. Integer rhoncus accumsan ex, ultricies faucibus arcu hendrerit et.
    Nulla iaculis turpis in eros blandit, at mollis est aliquam. In sed diam quis massa egestas hendrerit at in orci.
    Donec malesuada elementum enim non posuere. Mauris et accumsan risus. Donec ac tortor eros. Maecenas consectetur,
    purus sed ornare mattis, leo nisi convallis diam, vitae commodo eros nibh in augue. Sed et mattis nulla.
Mauris aliquet ante et finibus semper. Aliquam lacus justo, commodo ut auctor vel, ultricies nec libero. Nulla eget malesuada
erat, at interdum ante. Suspendisse potenti. Nunc vel mauris nunc. Nullam ullamcorper odio at ligula euismod faucibus. Fusce
id ultrices ipsum. Morbi consectetur elit magna, porta volutpat felis pulvinar eget. Vivamus euismod orci nibh, a mollis ipsum fermentum eu.
Etiam porttitor suscipit urna eget egestas. Cras faucibus ultrices dui vel faucibus. Phasellus vestibulum dapibus ipsum,
sodales scelerisque tellus laoreet eget. Phasellus imperdiet lacinia convallis. Proin purus felis, rutrum eu vehicula vel, luctus sit amet nulla.
Morbi sodales justo id finibus feugiat. Pellentesque vitae urna dictum, dictum diam vitae, aliquet ipsum. Mauris gravida
vulputate est, vitae consectetur est pretium ut. Etiam sit amet lorem vel tellus placerat tincidunt vel fringilla tortor.
Integer ut orci ex. Nunc tincidunt molestie lorem. Duis pharetra lectus et nulla finibus, sed egestas neque varius. Fusce eu dui ut risus tincidunt iaculis et nec urna.',
        DATE('2013-05-6 00:00:00'),DATE('2015-09-18 00:00:00'),null );


CREATE TABLE Agenda (

  idAgenda        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title           VARCHAR(100) NOT NULL,
  subtitle        VARCHAR(200) NOT NULL,
  description     VARCHAR(300) NOT NULL,
  date            DATE NOT NULL,
  idImage         INT UNSIGNED,

  constraint PK_AGENDA PRIMARY KEY (idAgenda),
  constraint FK_AGENDA_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)

);

insert into Agenda (title, subtitle, description, date, idImage) values ('Fiestas del Patrón','Ven a celebrar con nosotros las fiestas del patron de la asociación y disfruta de los conciertos, concursos..','Aliquam lacus justo, commodo ut auctor vel, ultricies nec libero. Nulla eget malesuada
erat, at interdum ante. Suspendisse potenti. Nunc vel mauris nunc. Nullam ullamcorper odio at ligula euismod faucibus. Fusce
id ultrices ipsum. Morbi consectetur elit magna, porta volutpat felis pulvinar eget. Vivamus euismod orci nibh, a mollis ipsum fermentum eu.
Etiam porttitor suscipit urna eget egestas. Cras faucibus ultrices dui vel faucibus. Phasellus vestibulum dapibus ipsum,
sodales scelerisque tellus laoreet eget. Phasellus imperdiet lacinia convallis. Proin purus felis, rutrum eu vehicula vel, luctus sit amet nulla.
Morbi sodales justo id finibus feugiat. Pellentesque vitae urna dictum, dictum diam vitae, aliquet ipsum. Mauris gravida
vulputate est, vitae consectetur est pretium ut.',DATE('2013-05-21 00:00:00'),null);
insert into Agenda (title, subtitle, description, date, idImage) values ('Talleres de manualidades','¡Nuestro divertidos e interesantes talleres! Busca las actividades que mas te gusten y participa ¡reserva ya tu plaza!','Aliquam lacus justo, commodo ut auctor vel, ultricies nec libero. Nulla eget malesuada
erat, at interdum ante. Suspendisse potenti. Nunc vel mauris nunc. Nullam ullamcorper odio at ligula euismod faucibus. Fusce
id ultrices ipsum. Morbi consectetur elit magna, porta volutpat felis pulvinar eget. Vivamus euismod orci nibh, a mollis ipsum fermentum eu.
Etiam porttitor suscipit urna eget egestas. Cras faucibus ultrices dui vel faucibus. Phasellus vestibulum dapibus',DATE('2013-04-1 00:00:00'),null);
insert into Agenda (title, subtitle, description, date, idImage) values ('Pasacalles','Los compañeros de la Escuela de Musica "Solfa" realizarán pequeñas actuaciones por nuestras calles ..','Aliquam lacus justo, commodo ut auctor vel, ultricies nec libero. Nulla eget malesuada
erat, at interdum ante. Suspendisse potenti. Nunc vel mauris nunc. Nullam ullamcorper. Proin purus felis, rutrum eu vehicula vel, luctus sit amet nulla.
Morbi sodales justo id finibus feugiat. Pellentesque vitae urna dictum, dictum diam vitae, aliquet ipsum. Mauris gravida
vulputate est, vitae consectetur est pretium ut.',DATE('2013-03-14 00:00:00'),null);

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
  surveyTitle    VARCHAR(200) NOT NULL,

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


CREATE TABLE SurveyResponses (

  idSurveyResponse INT UNSIGNED AUTO_INCREMENT,
  idSurvey        INT UNSIGNED NOT NULL,
  idAnswer        INT UNSIGNED NOT NULL,

  Constraint PK_SURVEYS_RESPONSES PRIMARY KEY (idSurveyResponse),
  constraint FK_SURVEYS_RESPONSES_SURVEY FOREIGN KEY (idSurvey) REFERENCES Surveys(idSurvey),
  constraint FK_SURVEYS_RESPONSES_ANSWER FOREIGN KEY (idAnswer) REFERENCES Answer(idAnswer)

);

CREATE TABLE Streets (

  idStreet  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  streetName      VARCHAR (50) NOT NULL,

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
  activityName        VARCHAR (50),

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
  NIF         VARCHAR (10) NOT NULL UNIQUE,
  name        VARCHAR (80),
  description VARCHAR (300),
  idImage     INT UNSIGNED,
  idAddress   INT UNSIGNED NOT NULL,
  idActivity  INT UNSIGNED NOT NULL,
  phoneNumber SMALLINT,
  email       VARCHAR (50) UNIQUE ,

  constraint PK_MEMBERS PRIMARY KEY (idMember),
  constraint FK_MEMBERS_ID_ADDRESS FOREIGN KEY (idAddress) references Address(idAddress),
  constraint FK_MEMBERS_ID_ACTIVITY FOREIGN KEY (idActivity) references Activities(idActivity),
  constraint FK_MEMBERS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)
);

insert into Members values (1,'12524296Z','Floranes 19 Fruteria','Frutas y Verduras de Cultivo Tradicional y Ecológico ',6,1,2,699999999,'floranes19fruteria@gmail.com');
insert into Members values (2,'05166885G','Carniceria Eño','Carnes selectas de Cantabria',5,2,5,699999999,'carniceriaeno@gmail.com');
insert into Members values (3,'60675704W','Fotos Marcelo','Desde 1973',6,3,6,699999999,'fotosmarcelo@hotmail.com');
insert into Members values (4,'12947461W','Electrodomesticos Master','Las mejores marcas al mejor precio',5,4,8,699999999,'eletromaster@hotmail.com');
insert into Members values (5,'22531651T','Deportes Sapporo','Ropa, calzado y material deportivo',6,5,7,699999999,'sapporodeportes@hotmail.com');
insert into Members values (6,'19550494B','Ferreteria montañesa','Desde 1945',7,6,12,699999999,'ferreteriamontanesa@yahoo.com');
insert into Members values (7,'98584290B','La Defensa Calzado','Expertos en ',7,6,12,699999999,'ladefensa@yahoo.com');
insert into Members values (8,'98584290Z','Sailors','Cafeteria ',7,6,12,699999999,'cafeteriaSailors@yahoo.com');

CREATE TABLE UserType (

  idUserType  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name        VARCHAR (10),
  description VARCHAR (30),

  constraint PK_USER_TYPE PRIMARY KEY (idUserType)
);

insert into UserType values (3,'member','Asociation member');
insert into UserType values (2,'user','Registered web user');
insert into UserType values (1,'administrator','Web administrator');

CREATE TABLE Users (

  idUser      INT UNSIGNED NOT NULL AUTO_INCREMENT,
  password    VARCHAR (200) NOT NULL,
  NIF         VARCHAR (10) NOT NULL UNIQUE,
  name        VARCHAR (30),
  nickName    VARCHAR (20),
  surname     VARCHAR (50),
  idImage     INT UNSIGNED,
  phoneNumber INT(9) UNSIGNED,
  email       VARCHAR (30) UNIQUE,
  idUserType  INT UNSIGNED NOT NULL,
  joinDate    DATE ,
  gender      char,
  age         INT UNSIGNED,
  streetName  VARCHAR (30) NOT NULL,
  number      SMALLINT,
  floor       SMALLINT,
  door        varchar (10),
  postalCode  SMALLINT,

  constraint PK_USERS PRIMARY KEY (idUser),
  constraint FK_USERS_TYPE FOREIGN KEY (idUserType) references UserType(idUserType),
  constraint FK_USERS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage),
  constraint CHK_USERS_GENDER check(gender = 'M'|| gender ='F')

);

insert into Users (password, NIF, name, nickName, surname, idImage, phoneNumber, email, idUserType,joinDate,gender,age,streetName,number,floor,door,postalCode)
values (password('root'),'123456789r','administrator','admin','',1,666666666,'admin@asociacionaloflo.com',1,DATE('2013-05-17 00:00:00'),'M',31,'Cisneros',1,1,'A',39020),
       (password('user1'),'1r','user1','user1','',1,666666666,'user1@hotmail.com',2,DATE('2013-05-17 00:00:00'),'F',45,'Avenida de los castros',233,4,'B',39010),
       (password('user2'),'2w','user2','user2','',1,666666666,'user2@hotmail.com',2,DATE('2013-05-17 00:00:00'),'F',50,'Alcázar de Toledo',12,8,'B',39007),
       (password('frute'),'3e','frutero','fruteria','',1,666666666,'fruteria@hotmail.com',3,DATE('2013-05-17 00:00:00'),'F',50,'Alcázar de Toledo',12,8,'B',39007);

CREATE TABLE JobOffers (

  idOffer         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  idMember        INT UNSIGNED NOT NULL,
  title           VARCHAR(200) NOT NULL,
  description     VARCHAR(300) NOT NULL,
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

CREATE TABLE NewComment (

  idNewComment INT UNSIGNED NOT NULL AUTO_INCREMENT,
  idNew        INT UNSIGNED NOT NULL,
  idUser       INT UNSIGNED NOT NULL,
  text         VARCHAR(100) NOT NULL,
  date         DATE NOT NULL,

  CONSTRAINT PK_NEW_COMMENT PRIMARY KEY (idNewComment),
  constraint FK_NEW_COMMENT_ID_NEW FOREIGN KEY (idNew) REFERENCES News(idNew),
  constraint FK_NEW_COMMENT_ID_USER FOREIGN KEY (idUser) REFERENCES Users(idUser)

);

INSERT INTO NewComment (idNew,idUser,text,date) values(1,1,'¡Ya hay muchas ganas!',DATE('2013-09-18 00:00:00'));
INSERT INTO NewComment (idNew,idUser,text,date) values(2,1,'¡Ya hay muchas ganas!',DATE('2013-09-18 00:00:00'));
INSERT INTO NewComment (idNew,idUser,text,date) values(3,1,'¡Ya hay muchas ganas!',DATE('2013-09-18 00:00:00'));

INSERT INTO NewComment (idNew,idUser,text,date) values(1,2,'¡Ya hay muchas ganas!',DATE('2013-09-18 00:00:00'));
INSERT INTO NewComment (idNew,idUser,text,date) values(2,2,'¡Ya hay muchas ganas!',DATE('2013-09-18 00:00:00'));
INSERT INTO NewComment (idNew,idUser,text,date) values(3,2,'¡Ya hay muchas ganas!',DATE('2013-09-18 00:00:00'));





