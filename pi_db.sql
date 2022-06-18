CREATE DATABASE IF NOT EXISTS natacaounaerp;
USE natacaounaerp;

CREATE TABLE usuarios (
    cod_usuario INT(6) AUTO_INCREMENT, 
    nom_usuario VARCHAR(40) NOT NULL, 
    dtn_usuario DATE NOT NULL, 
    sen_usuario VARCHAR(32) NOT NULL, 
    per_usuario TINYINT(1) NOT NULL, 
    sts_usuario TINYINT(1) NOT NULL,
    PRIMARY KEY(cod_usuario)
);

CREATE TABLE atletas (
	id_atleta INT(6) auto_increment,
    nom_atleta varchar(50) not null,
    dti_atleta date not null,
    dtn_atleta date not null,
    nat_atleta varchar(50) not null,
    nac_atleta varchar(20) not null,
    rg_atleta varchar(12) not null,
    cpf_atleta varchar(11) not null,
    sex_atleta char(1) not null, 
    end_atleta varchar(50) not null,
    bai_atleta varchar(25) not null,
    cep_atleta varchar(10) not null,
    cid_atleta varchar(35) not null,
    uf_atleta char(2) not null,
    mae_atleta varchar(50) not null,
    pai_atleta varchar(50),
    clb_atleta varchar(30),
    trb_atleta char(1),
    anx_foto_atleta blob,
    anx_rg_atleta blob,
    anx_cpf_atleta blob,
    anx_atm_atleta blob, 
    anx_cpr_atleta blob,
	id_convenio INT(6),
    primary key(id_atleta)
);

ALTER TABLE atletas ADD CONSTRAINT FOREIGN KEY (id_convenio) REFERENCES convenios(id_convenio);
