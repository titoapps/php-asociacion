
USE asociacion;

-- TODO:what to do? store or just use the path?
create table Images (

  idImage INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name    VARCHAR(30),
  image   BLOB NOT NULL,
  path    VARCHAR(30) NOT NULL,

  constraint PK_IMAGES PRIMARY KEY (idImage)

);

CREATE TABLE News (

  idNew           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title           VARCHAR(30) NOT NULL,
  subtitle        VARCHAR(30) NOT NULL,
  description     VARCHAR(50) NOT NULL,
  date            DATE NOT NULL,
  idImage         INT UNSIGNED,

  constraint PK_NEWS PRIMARY KEY (idNew),
  constraint FK_NEWS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)

);


CREATE TABLE Agenda (

  idAgenda        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title           VARCHAR(30) NOT NULL,
  subtitle        VARCHAR(30) NOT NULL,
  description     VARCHAR(50) NOT NULL,
  date            DATE NOT NULL,
  idImage         INT UNSIGNED,

  constraint PK_AGENDA PRIMARY KEY (idAgenda),
  constraint FK_AGENDA_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)

);

CREATE TABLE Answer (

  idAnswer       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title          VARCHAR(30) NOT NULL,

  constraint PK_ANSWER PRIMARY KEY (idAnswer)

);

CREATE TABLE AnswerToSurveys (

  idAnswer       INT UNSIGNED NOT NULL,
  idSurvey      INT UNSIGNED NOT NULL,

  constraint PK_ANSWER_TO_SURVEYS PRIMARY KEY (idAnswer,idSurvey),
  constraint FK_ANSWER_TO_SURVEYS_SURVEY FOREIGN KEY (idSurvey) REFERENCES Surveys(idSurvey),
  constraint FK_ANSWER_TO_SURVEYS_ANSWER FOREIGN KEY (idAnswer) REFERENCES Answer(idAnswer)

);

CREATE TABLE Surveys (

  idSurvey       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title          VARCHAR(30) NOT NULL,

  constraint PK_SURVEYS PRIMARY KEY (idSurvey)

);

CREATE TABLE Streets (

  idStreet  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name      VARCHAR (30) NOT NULL,

  constraint PK_STREET PRIMARY KEY (idStreet)
);

CREATE TABLE Address (

  idAddress  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  idStreet   INT UNSIGNED NOT NULL,
  number     SMALLINT,
  numberAdd  VARCHAR (3),
  floor      SMALLINT,
  door       varchar (10),
  postalCode SMALLINT,

  constraint PK_STREET PRIMARY KEY (idMember),
  constraint FK_STREET FOREIGN KEY (idStreet) references Streets(idStreet)

);

CREATE TABLE Activities (

  idActivity  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name        VARCHAR (30),

  constraint PK_ACTIVITIES PRIMARY KEY (idActivity)

);

CREATE TABLE Members (

  idMember    INT UNSIGNED NOT NULL AUTO_INCREMENT,
  -- TODO:password encryption?? SSL transmision
  password    VARCHAR (30) NOT NULL,
  NIF         VARCHAR (10) NOT NULL UNIQUE,
  name        VARCHAR (30),
  description VARCHAR (30),
  logo        BLOB,
  idImage     INT UNSIGNED,
  idAddress   INT UNSIGNED NOT NULL,
  idActivity  INT UNSIGNED NOT NULL,
  phoneNumber SMALLINT,
  email       VARCHAR (30),

  constraint PK_MEMBERS PRIMARY KEY (idMember),
  constraint FK_MEMBERS FOREIGN KEY (idAddress) references Address(idAddress),
  constraint FK_MEMBERS FOREIGN KEY (idActivity) references Activities(idActivity),
  constraint FK_MEMBERS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)
);

CREATE TABLE UserType (

  idUserType  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name        VARCHAR (10),
  description VARCHAR (30),

  constraint PK_USER_TYPE PRIMARY KEY (idUsers)
);

CREATE TABLE Users (

  idUser      INT UNSIGNED NOT NULL AUTO_INCREMENT,
-- TODO:password encryption?? SSL transmision
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

  constraint PK_USERS PRIMARY KEY (idUsers),
  constraint FK_USERS_ADDRESS FOREIGN KEY (idAddress) references Address(idAddress),
  constraint FK_USERS_TYPE FOREIGN KEY (idUserType) references Users(idUserType),
  constraint FK_USERS_IMG FOREIGN KEY (idImage) REFERENCES Images(idImage)

);

CREATE TABLE JobOffers (

  idOffer         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  idMember        INT UNSIGNED NOT NULL,
  title           VARCHAR(30) NOT NULL,
  description     VARCHAR(50) NOT NULL,
  -- duration or something more
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

-- TODO:on delete cascade?

INSERT INTO members VALUES( 1, 'sparky', password('mypass'), 'John', 'Sparks', '2007-11-13', 'm', 'crime', 'jsparks@example.com', 'Football, fishing and gardening' );
INSERT INTO members VALUES( 2, 'mary', password('mypass'), 'Mary', 'Newton', '2007-02-06', 'f', 'thriller', 'mary@example.com', 'Writing, hunting and travel' );
INSERT INTO members VALUES( 3, 'jojo', password('mypass'), 'Jo', 'Scrivener', '2006-09-03', 'f', 'romance', 'jscrivener@example.com', 'Genealogy, writing, painting' );
INSERT INTO members VALUES( 4, 'marty', password('mypass'), 'Marty', 'Pareene', '2007-01-07', 'm', 'horror', 'marty@example.com', 'Guitar playing, rock music, clubbing' );
INSERT INTO members VALUES( 5, 'nickb', password('mypass'), 'Nick', 'Blakeley', '2007-08-19', 'm', 'sciFi', 'nick@example.com', 'Watching movies, cooking, socializing' );
INSERT INTO members VALUES( 6, 'bigbill', password('mypass'), 'Bill', 'Swan', '2007-06-11', 'm', 'nonFiction', 'billswan@example.com', 'Tennis, judo, music' );
INSERT INTO members VALUES( 7, 'janefield', password('mypass'), 'Jane', 'Field', '2006-03-03', 'f', 'crime', 'janefield@example.com', 'Thai cookery, gardening, traveling' );

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




