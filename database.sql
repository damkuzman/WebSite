CREATE TABLE grad(
	sifra_grad INT(11) NOT NULL auto_increment,
	naziv_grad VARCHAR(100) default NULL,
	ptt_grad VARCHAR(100) default NULL,       
	PRIMARY KEY (sifra_grad)
);

CREATE TABLE namena_nekretnine(
	sifra_namena_nekretnine INT(11) NOT NULL auto_increment,
	naziv_namena_nekretnine VARCHAR(100) default NULL,
	PRIMARY KEY (sifra_namena_nekretnine)
);

CREATE TABLE tip_nekretnine(
	sifra_tip_nekretnine INT(11) NOT NULL auto_increment,
	naziv_tip_nekretnine VARCHAR(100) default NULL,      
	PRIMARY KEY (sifra_tip_nekretnine)
);

CREATE TABLE korisnik(
        sifra_korisnik INT(11) NOT NULL auto_increment,
	username VARCHAR(100) default NULL,
	password VARCHAR(100) default NULL,
        ime varchar(100) default NULL,
        prezime varchar(100) default NULL,
        sifra_grad INTEGER default NULL,
        ulica VARCHAR(100) default NULL,
        tip_korisnik VARCHAR(100) default NULL,
        primary key(sifra_korisnik),
	FOREIGN KEY (sifra_grad) REFERENCES grad (sifra_grad)
);

CREATE TABLE nekretnina (
	sifra_nekretnina INT(11) NOT NULL auto_increment, 
	oglas VARCHAR(100) default NULL,
        broj_kvadrata INTEGER default NULL,
        cena REAL default NULL,
        sifra_grad INTEGER default NULL,
        ulica VARCHAR(100) default NULL,
        sifra_namena_nekretnine INTEGER default NULL,
        sifra_tip_nekretnine INTEGER default NULL,
        sifra_korisnik INTEGER default NULL,
	PRIMARY KEY  (sifra_nekretnina),
	FOREIGN KEY (sifra_grad) REFERENCES grad (sifra_grad),
	FOREIGN KEY (sifra_namena_nekretnine) REFERENCES namena_nekretnine (sifra_namena_nekretnine),
	FOREIGN KEY (sifra_tip_nekretnine) REFERENCES tip_nekretnine (sifra_tip_nekretnine),
	FOREIGN KEY (sifra_korisnik) REFERENCES korisnik (sifra_korisnik)
);

insert into korisnik(username, password,  tip_korisnik) values ('administrator', 'administrator', 'administrator');