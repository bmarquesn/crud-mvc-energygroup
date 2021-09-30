/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `crud_mvc_energygroup` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `crud_mvc_energygroup`;

CREATE TABLE IF NOT EXISTS `beneficios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `codigo` varchar(200) NOT NULL,
  `operadora` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `valor` decimal(20,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DELETE FROM `beneficios`;
/*!40000 ALTER TABLE `beneficios` DISABLE KEYS */;
INSERT INTO `beneficios` (`id`, `usuario_id`, `titulo`, `codigo`, `operadora`, `tipo`, `valor`, `data_vencimento`, `updated`, `ativo`) VALUES
	(2, 1, 'dddd', 'ddd222', 'ddd2222', 'ddd', 12.34, '2021-09-01', '2021-09-30 15:38:51', 0),
	(3, 1, 'dddd', 'ddd', 'ddd', 'ddd', 123.56, '2021-09-01', '2021-09-30 15:39:22', 1);
/*!40000 ALTER TABLE `beneficios` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `logradouro` text NOT NULL,
  `numero_endereco` varchar(100) NOT NULL,
  `complemento_endereco` mediumtext,
  `bairro` text NOT NULL,
  `cidade` text NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_usuario` (`usuario_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

DELETE FROM `enderecos`;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cpf_cnpj` bigint(20) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `senha` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_cnpj_unique` (`cpf_cnpj`),
  UNIQUE KEY `email_unique` (`email`),
  KEY `email` (`email`),
  KEY `cpf_cnpj` (`cpf_cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `cpf_cnpj`, `nome`, `email`, `data_nascimento`, `senha`, `ativo`) VALUES
	(1, 99999999999, 'Novo usuário', 'teste@teste.com.br', '2021-09-23', 'a94dfa704f108e7feefd4635060202c9', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
