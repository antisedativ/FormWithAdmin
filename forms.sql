CREATE TABLE form (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(128) NOT NULL DEFAULT '',
  email varchar(128) NOT NULL DEFAULT '',
  date DATE,
  gender varchar(128) NOT NULL DEFAULT '',
  limbs varchar(10) NOT NULL DEFAULT '0',
  biograf varchar(128) NOT NULL DEFAULT '',
  agree varchar(10) NOT NULL DEFAULT '0',
  hash varchar(128) NOT NULL DEFAULT '',
  login varchar(128) NOT NULL DEFAULT '',
  pass varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
);
CREATE TABLE superpowers (
  id int(10) unsigned references form(id) ,
  superpower varchar(128) NOT NULL DEFAULT '',
  login varchar(128) NOT NULL DEFAULT '',
  pass varchar(128) NOT NULL DEFAULT ''
);
CREATE TABLE admin (
  id int(10) unsigned NOT NULL AUTO_INCREMENT ,
  admin_login varchar(128) NOT NULL DEFAULT '',
  admin_pass varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
);