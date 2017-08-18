-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.17 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para ead
CREATE DATABASE IF NOT EXISTS `ead` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `ead`;

-- Copiando estrutura para tabela ead.alunos
CREATE TABLE IF NOT EXISTS `alunos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `senha` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela ead.aluno_curso
CREATE TABLE IF NOT EXISTS `aluno_curso` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL DEFAULT '0',
  `id_aluno` int(11) NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela ead.aulas
CREATE TABLE IF NOT EXISTS `aulas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL DEFAULT '0',
  `id_curso` int(11) NOT NULL DEFAULT '0',
  `ordem` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela ead.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `imagem` varchar(37) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8_bin,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela ead.historico
CREATE TABLE IF NOT EXISTS `historico` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_viewer` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_aluno` int(11) NOT NULL DEFAULT '0',
  `id_aula` int(11) NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela ead.modulos
CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela ead.questionarios
CREATE TABLE IF NOT EXISTS `questionarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_aula` int(10) unsigned NOT NULL DEFAULT '0',
  `pergunta` varchar(100) COLLATE utf8_bin NOT NULL,
  `opcao1` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `opcao2` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `opcao3` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `opcao4` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `resposta` tinyint(4) DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela ead.videos
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_aula` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8_bin,
  `url` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
