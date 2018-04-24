-- DATABASE: NOPAYNOGAME

-- TABLE STRUCTURE FOR TABLE DOM_CONSOLE
CREATE TABLE DOM_CONSOLE (
COD_CONSOLE VARCHAR(4) UNIQUE NOT NULL,
DESC_CONSOLE VARCHAR(45) NOT NULL,

CONSTRAINT DOM_CONSOLE_PK PRIMARY KEY (COD_CONSOLE)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE DOM_GENRE
CREATE TABLE DOM_GENRE (
COD_GENRE VARCHAR(4) UNIQUE NOT NULL,
DESC_GENRE VARCHAR(45) NOT NULL,

CONSTRAINT DOM_GENRE_PK PRIMARY KEY (COD_GENRE)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE DOM_PAYMENT
CREATE TABLE DOM_PAYMENT (
COD_PAYMENT VARCHAR(4) UNIQUE NOT NULL,
DESC_PAYMENT VARCHAR(45) NOT NULL,

CONSTRAINT DOM_PAYMENT_PK PRIMARY KEY (COD_PAYMENT)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE DOM_ROLE
CREATE TABLE DOM_ROLE (
COD_ROLE CHAR(3) UNIQUE NOT NULL,
DESC_ROLE VARCHAR(45) NOT NULL,

CONSTRAINT DOM_ROLE_PK PRIMARY KEY (COD_ROLE)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE GAMES
CREATE TABLE GAMES (
COD_GAME INT(11) UNIQUE NOT NULL AUTO_INCREMENT,
TITLE VARCHAR(45) NOT NULL,
PRICE FLOAT(11) NOT NULL,
COD_CONSOLE VARCHAR(4)  NOT NULL,
PRICE_ON_SALE FLOAT(11) NOT NULL,
FLAG_SALE CHAR(1) NOT NULL,
FLAG_NEWS CHAR(1) DEFAULT 'Y' NOT NULL,

IMAGE VARCHAR(250) DEFAULT 'http://placehold.it/271x377' NOT NULL,
DESCRIPTION VARCHAR(2000) NOT NULL,
SPEC_REQ VARCHAR(2000),
TRAILER VARCHAR(2000),

INSERTION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,

CONSTRAINT GAMES_PK PRIMARY KEY (COD_GAME),

CONSTRAINT GAMES_CK01 CHECK (FLAG_SALE IN ('Y', 'N')),
CONSTRAINT GAMES_CK02 CHECK (FLAG_NEWS IN ('Y', 'N')),
CONSTRAINT GAMES_CK03 CHECK (PRICE >= 0),
CONSTRAINT GAMES_CK04 CHECK (PRICE_ON_SALE >= 0),

CONSTRAINT GAMES_FK01 FOREIGN KEY (COD_CONSOLE) REFERENCES DOM_CONSOLE(COD_CONSOLE)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE GAME_GENRE
CREATE TABLE GAME_GENRE (
ID_GAME_GENRE INT(11) NOT NULL AUTO_INCREMENT,
COD_GAME INT(11) NOT NULL,
COD_GENRE VARCHAR(4) NOT NULL,

CONSTRAINT GAME_GENRE_PK PRIMARY KEY (ID_GAME_GENRE),

CONSTRAINT GAME_GENRE_FK01 FOREIGN KEY (COD_GAME) REFERENCES GAMES(COD_GAME),
CONSTRAINT GAME_GENRE_FK02 FOREIGN KEY (COD_GENRE) REFERENCES DOM_GENRE(COD_GENRE)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE USERS
CREATE TABLE USERS (
ID_USER INT(11) NOT NULL AUTO_INCREMENT,
NAME VARCHAR(45) NOT NULL,
SURNAME VARCHAR(45) NOT NULL,
ADDRESS VARCHAR(45) NOT NULL,
PHONE VARCHAR(10) NOT NULL,
USERNAME VARCHAR(11) UNIQUE NOT NULL,
PASSWORD VARCHAR(32) NOT NULL,
EMAIL VARCHAR(45) UNIQUE NOT NULL,
COD_ROLE CHAR(3) NOT NULL,
PASSWORD_LAST_MODIFY TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
FIDELITY_POINT INT(11) DEFAULT 0 NOT NULL,
FLAG_DELETED CHAR(1) DEFAULT 'N' NOT NULL,
FLAG_ACTIVE CHAR(1) DEFAULT 'N' NOT NULL,

CONSTRAINT USERS_PK PRIMARY KEY (ID_USER),

CONSTRAINT USERS_FK01 FOREIGN KEY (COD_ROLE) REFERENCES DOM_ROLE(COD_ROLE),

CONSTRAINT USERS_CK01 CHECK (FIDELITY_POINT >= 0),
CONSTRAINT USERS_CK02 CHECK (FLAG_DELETED IN ('Y', 'N')),
CONSTRAINT USERS_CK03 CHECK (FLAG_ACTIVE IN ('Y', 'N'))
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE ORDERS
CREATE TABLE ORDERS (
ID_ORDER INT(11) NOT NULL AUTO_INCREMENT,
ID_USER INT(11) NOT NULL,
COD_PAYMENT VARCHAR(4) NOT NULL,
DATE_ORDER TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
FLAG_PAYD CHAR(1) DEFAULT 'N' NOT NULL,
FLAG_EVADE CHAR(1) DEFAULT 'N' NOT NULL,

CONSTRAINT ORDERS_PK PRIMARY KEY (ID_ORDER),

CONSTRAINT ORDERS_FK01 FOREIGN KEY (ID_USER) REFERENCES USERS(ID_USER),
CONSTRAINT ORDERS_FK02 FOREIGN KEY (COD_PAYMENT) REFERENCES DOM_PAYMENT(COD_PAYMENT),
CONSTRAINT ORDERS_CK01 CHECK (FLAG_PAYD IN ('Y', 'N')),
CONSTRAINT ORDERS_CK02 CHECK (FLAG_EVADE IN ('Y', 'N'))
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE GAME_ORDER
CREATE TABLE GAME_ORDER (
ID_GAME_ORDER INT(11) NOT NULL AUTO_INCREMENT,
ID_ORDER INT(11) NOT NULL,
COD_GAME INT(11) NOT NULL,
QUANTITY INT(11) DEFAULT 0 NOT NULL,
GAME_PRICE FLOAT(11) NOT NULL,

CONSTRAINT GAME_ORDER_PK PRIMARY KEY (ID_GAME_ORDER),

CONSTRAINT GAME_ORDER_FK01 FOREIGN KEY (COD_GAME) REFERENCES GAMES(COD_GAME),
CONSTRAINT GAME_ORDER_FK02 FOREIGN KEY (ID_ORDER) REFERENCES ORDERS(ID_ORDER),

CONSTRAINT GAME_ORDER_CK01 CHECK (QUANTITY >= 0)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE REVIEW
CREATE TABLE REVIEW (
ID_REVIEW INT(11) NOT NULL AUTO_INCREMENT,
COD_GAME INT(11) NOT NULL,
ID_USER INT(11) NOT NULL,
STARS INT(11) NOT NULL,
COMMENT_TEXT VARCHAR(2000),

CONSTRAINT REVIEW_PK PRIMARY KEY (ID_REVIEW),

CONSTRAINT REVIEW_FK01 FOREIGN KEY (COD_GAME) REFERENCES GAMES(COD_GAME),
CONSTRAINT REVIEW_FK02 FOREIGN KEY (ID_USER) REFERENCES USERS(ID_USER),

CONSTRAINT REVIEW_CK01 CHECK (STARS BETWEEN 1 AND 5)
) ENGINE=InnoDB;

-- TABLE STRUCTURE FOR TABLE WAREHOUSE
CREATE TABLE WAREHOUSE (
COD_WAREHOUSE CHAR(3) NOT NULL,
ADDRESS VARCHAR(45) NOT NULL,
PHONE VARCHAR(45) NOT NULL,

CONSTRAINT WAREHOUSE_PK PRIMARY KEY (COD_WAREHOUSE)
) ENGINE=InnoDB;


-- TABLE STRUCTURE FOR TABLE GAME_WAREHOUSE
CREATE TABLE GAME_WAREHOUSE (
ID_GAME_WAREHOUSE INT(11) NOT NULL AUTO_INCREMENT,
QUANTITY INT(11) NOT NULL,
COD_WAREHOUSE CHAR(3) NOT NULL,
COD_GAME INT(11) NOT NULL,

CONSTRAINT GAME_WAREHOUSE_PK PRIMARY KEY (ID_GAME_WAREHOUSE),

CONSTRAINT GAME_WAREHOUSE_FK01 FOREIGN KEY (COD_WAREHOUSE) REFERENCES WAREHOUSE(COD_WAREHOUSE),
CONSTRAINT GAME_WAREHOUSE_FK02 FOREIGN KEY (COD_GAME) REFERENCES GAMES(COD_GAME),

CONSTRAINT GAME_WAREHOUSE_CK01 CHECK (QUANTITY >= 0)
) ENGINE=InnoDB;