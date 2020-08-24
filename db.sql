-- Create syntax for TABLE 'clientes'
CREATE TABLE `clientes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `telefone` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);

-- Create syntax for TABLE 'proprietarios'
CREATE TABLE `proprietarios` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `nome` varchar(255) DEFAULT NULL,
    `email` varchar(255) NOT NULL DEFAULT '',
    `telefone` varchar(255) NOT NULL DEFAULT '',
    `dia_repasse` int(2) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
);

-- Create syntax for TABLE 'imoveis'
CREATE TABLE `imoveis` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `endereco` text NOT NULL,
    `proprietario_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

-- Create syntax for TABLE 'contratos'
CREATE TABLE `contratos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `imovel_id` int(11) NOT NULL,
  `proprietario_id` int(11) NOT NULL,
  `locatario_id` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date DEFAULT NULL,
  `taxa_administracao` double DEFAULT NULL,
  `valor_aluguel` double NOT NULL,
  `condominio` double DEFAULT NULL,
  `iptu` double DEFAULT NULL,
  PRIMARY KEY (`id`)
);


-- Create syntax for TABLE 'tipos_usuarios'
CREATE TABLE `tipos_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
);

-- Create syntax for TABLE 'usuarios'
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `hash` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login` (`login`),
  KEY `tipo_usuario` (`tipo_usuario`)
);