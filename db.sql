-- Create syntax for TABLE 'clientes'
CREATE TABLE `clientes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `telefone` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8;
-- Create syntax for TABLE 'contratos'
CREATE TABLE `contratos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `imovel_id` int(11) NOT NULL,
  `proprietario_id` int(11) NOT NULL,
  `locatario_id` int(11) NOT NULL,
  `inicio` date DEFAULT NULL,
  `fim` date DEFAULT NULL,
  `taxa_administracao` double DEFAULT NULL,
  `valor_aluguel` double DEFAULT NULL,
  `condominio` double DEFAULT NULL,
  `iptu` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8;
-- Create syntax for TABLE 'imoveis'
CREATE TABLE `imoveis` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) NOT NULL DEFAULT '',
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT '',
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `proprietario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8;
-- Create syntax for TABLE 'mensalidades'
CREATE TABLE `mensalidades` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `mes` date DEFAULT NULL,
  `paga` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 85 DEFAULT CHARSET = utf8;
-- Create syntax for TABLE 'proprietarios'
CREATE TABLE `proprietarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `telefone` varchar(255) NOT NULL DEFAULT '',
  `dia_repasse` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8;
-- Create syntax for TABLE 'repasses'
CREATE TABLE `repasses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `mes` date DEFAULT NULL,
  `paga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 25 DEFAULT CHARSET = utf8;
-- Create syntax for TABLE 'usuarios'
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `hash` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8;