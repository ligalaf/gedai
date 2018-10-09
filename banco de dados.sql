
CREATE DATABASE `LAF` /*!40100 DEFAULT CHARACTER SET utf8 */; 
use LAF;

CREATE TABLE `tb_unidade`(
`ID_Unidade` int(11) NOT NULL AUTO_INCREMENT,
`Nome` varchar (150) NOT NULL,
CONSTRAINT `PK_ID_Unidade` PRIMARY KEY (`ID_Unidade`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_usuario`(
`ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
`FK_Unidade` int(11) NOT NULL,
`Nome` varchar (150) NOT NULL,
`Tipo` varchar (20) NOT NULL,
`Email`varchar (50) NOT NULL,
`Senha`varchar (50) NOT NULL,
`Bloqueado` int(1) NOT NULL,
`Avatar` varchar (150) NOT NULL,
 CONSTRAINT `PK_ID_Usuario` PRIMARY KEY (`ID_Usuario`),
 CONSTRAINT `FK_ID_Unidade` FOREIGN KEY (`FK_Unidade`) references `tb_unidade` (`ID_Unidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_permissao`(
`ID_Permissao` int(11) NOT NULL AUTO_INCREMENT,
`Nome` varchar (100) NOT NULL,
 CONSTRAINT `PK_ID_Permissao` PRIMARY KEY (`ID_Permissao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_permissao_usuario`(
`ID_Permissao_usuario` int(11) NOT NULL AUTO_INCREMENT,
`FK_Usuario` int (11) NOT NULL,
`FK_Permissao` int (11) NULL,
 CONSTRAINT `PK_ID_Permissao_usuario` PRIMARY KEY (`ID_Permissao_usuario`),
 CONSTRAINT `FK_Usuario_permissao` FOREIGN KEY (`FK_Usuario`) references `TB_usuario` (`ID_Usuario`),
 CONSTRAINT `FK_Permissao_permissao` FOREIGN KEY (`FK_Permissao`) references `TB_Permissao` (`ID_Permissao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_historico_negativacao`(
`ID_Historico` int (11) NOT NULL AUTO_INCREMENT,
`FK_Atleta` int (11) NOT NULL,
`FK_Usuario` int (11) not null,
`data` date not null,
CONSTRAINT `PK_ID_Historico` PRIMARY KEY(`ID_Historico`),
CONSTRAINT `FK_Atleta_Historico` FOREIGN KEY(`FK_Atleta`) references `tb_atleta`(`ID_Atleta`),
CONSTRAINT `FK_Usuario_Historico` FOREIGN KEY(`FK_Usuario`) references `tb_usuario`(`ID_Usuario`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_unidade (Nome) values ('Americana');
insert into tb_unidade (Nome) values ('Barueri');
insert into tb_unidade (Nome) values ('Carapicuiba');
insert into tb_unidade (Nome) values ('Cotia');
insert into tb_unidade (Nome) values ('Guaratinguetá');
insert into tb_unidade (Nome) values ('Guarulhos');
insert into tb_unidade (Nome) values ('Ipiranga');
insert into tb_unidade (Nome) values ('Itapetininga');
insert into tb_unidade (Nome) values ('Itu');
insert into tb_unidade (Nome) values ('Jundiai');
insert into tb_unidade (Nome) values ('Osasco');
insert into tb_unidade (Nome) values ('Ourinhos');
insert into tb_unidade (Nome) values ('Piracicaba');
insert into tb_unidade (Nome) values ('Santos');
insert into tb_unidade (Nome) values ('São Jose dos Campos');
insert into tb_unidade (Nome) values ('São Paulo');
insert into tb_unidade (Nome) values ('Sebrae');
insert into tb_unidade (Nome) values ('Sorocaba');
insert into tb_unidade (Nome) values ('São Roque');
insert into tb_unidade (Nome) values ('Tatuapé');
insert into tb_unidade (Nome) values ('Zona Leste');
insert into tb_unidade (Nome) values ('Zona Sul');
insert into tb_unidade (Nome) values ('Praia Grande');
insert into tb_unidade (Nome) values ('Jau');
insert into tb_permissao (Nome) values ('LAF');
insert into tb_permissao (Nome) values ('Usuários');
insert into tb_permissao (Nome) values ('Solicitações de Cadastro de Atletas');
insert into tb_permissao (Nome) values ('Delegados');
insert into tb_permissao (Nome) values ('Cadastrar Atleta');
insert into tb_permissao (Nome) values ('Lista de Atletas');

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PR_AprovaRejeitaAtleta`(

atleta_var int,
usuario_var int,
aprovado_var int
)
BEGIN
     
      Insert into tb_historico_negativacao (`FK_Atleta`,`FK_Usuario`,`data`)
       values (atleta_var,usuario_var,now());
       
       update tb_atleta set situacao = aprovado_var where ID_Atleta = atleta_var;
    


 END
 $$
DELIMITER ;




select * from tb_unidade;

select * from tb_permissao_usuario
select * from tb_usuario;

