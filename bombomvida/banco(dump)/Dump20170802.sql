CREATE DATABASE  IF NOT EXISTS `bombomvida` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bombomvida`;
-- MySQL dump 10.13  Distrib 5.7.19, for Linux (i686)
--
-- Host: 127.0.0.1    Database: bombomvida
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.17.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria_prod`
--

DROP TABLE IF EXISTS `categoria_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_prod`
--

LOCK TABLES `categoria_prod` WRITE;
/*!40000 ALTER TABLE `categoria_prod` DISABLE KEYS */;
INSERT INTO `categoria_prod` VALUES (1,'biscoito'),(3,'chocolate');
/*!40000 ALTER TABLE `categoria_prod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_endereco` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `cpf` char(14) NOT NULL,
  `rg` char(12) NOT NULL,
  `telefone` char(13) DEFAULT NULL,
  `celular` char(14) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `sobrenome` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_endereco` (`id_endereco`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,1,'francisco tarlisson','1994-11-15','445.671.968-05','42.664.671-8','1111-1111','91111-1111','faran@gmail.com','123',''),(2,2,'francisco tarlisson','1994-01-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','franciscotarlisson@gmail.com','admin',''),(3,32,'Francisco Tarlisson','1990-02-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','frans@hotmail.com','dsfdas',''),(4,33,'joao','1990-02-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','frans@hotmail.com','guri',''),(5,34,'maria','1990-02-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','frans@hotmail.com','minha',''),(6,35,'maria','1990-02-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','frans@hotmail.com','sdfa',''),(7,36,'maria','1990-02-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','frans@hotmail.com','dsf',''),(8,37,'frans','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','','','tarlisson'),(9,38,' tarlis','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','','admin','tarlisson'),(10,39,' fransgo','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','admin','admin','ruia'),(11,43,'francis','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','admin','admin','tarlisson'),(12,44,'frango','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','ad','admin','tarlisson'),(13,45,' jose','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','ad','ad','maria'),(14,46,'chicao','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','chico','chico','chico'),(15,47,'chicao','1994-11-15','445.671.968-05','42.664.068-8','(41)1111-1111','(41)91111-1111','chico','chico','chico');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `numero_compra` int(11) NOT NULL,
  `data_compra` date DEFAULT NULL,
  `hora` time NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,3,3,1,'2017-07-25','23:54:12',2),(2,10,1,2,'2017-07-29','21:36:25',1),(3,10,2,2,'2017-07-29','21:36:25',1),(4,10,3,2,'2017-07-29','21:36:25',1),(5,10,4,2,'2017-07-29','21:36:25',1),(6,10,5,2,'2017-07-29','21:36:25',1),(7,10,2,3,'2017-07-29','21:56:54',1),(8,10,1,3,'2017-07-29','21:56:54',1),(9,10,1,3,'2017-07-29','21:56:54',8),(10,10,3,4,'2017-07-31','00:56:06',11),(11,10,1,5,'2017-08-02','13:09:30',1);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rua` varchar(30) NOT NULL,
  `numero` smallint(4) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `cep` char(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(2,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(3,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(4,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(5,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(6,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(7,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(8,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(9,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(10,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(11,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(12,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(13,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(14,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(15,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(16,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(17,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(18,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(19,'nÃ£o vou falar',0,'joao nao sabe','','02152-011'),(20,'nÃ£o vou falar',0,'joao nao sabe','','02152-011'),(21,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(22,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(23,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(24,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(25,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(26,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(27,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(28,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(29,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(30,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(31,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(32,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(33,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(34,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(35,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(36,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(37,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(38,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(39,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(40,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(41,'dsfdsaf',0,'joao nao sabe','dfdsafdsaf','02152-011'),(42,'dsfdsaf',0,'joao nao sabe',' ',''),(43,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(44,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(45,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(46,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011'),(47,'nÃ£o vou falar',0,'joao nao sabe','naio','02152-011');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `peso` decimal(5,1) NOT NULL,
  `img` varchar(50) NOT NULL,
  `promocao` enum('S','N') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_prod` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,1,'trakinas morango','Biscoito doce com sabor de morango.',1.89,150.0,'../_imagens/trakinas_mor.jpg','S'),(2,1,'trakinas chocolate','Biscoito doce com sabor de chocolate.',1.89,150.0,'../_imagens/trakinas_choc.jpg','S'),(3,1,'trakinas meio a meio','Biscoito doce com sabor de morango.',1.89,150.0,'../_imagens/trakinas_meio.jpg','S'),(4,3,'trento baunilha','Chocolate em palito com recheio baunilha.',1.20,30.0,'../_imagens/trento_bau.jpg','S'),(5,3,'Lacta ao leite','Chocolate em barra, sabor ao leite.',4.99,150.0,'../_imagens/barra_lacta_leite.jpg','S'),(42,1,'tortuguida morango',' ',1.50,120.0,'../_imagens/tortuguita_bisc.jpg','N'),(43,1,'prestigio',' ',1.80,120.0,'../_imagens/prestigio_bisc.jpg','N'),(44,1,'bono',' ',1.20,120.0,'../_imagens/bono_bisc.jpg','S'),(45,3,'sonho de valsa',' ',0.80,0.2,'../_imagens/sonho_valsa_20g.jpg','N'),(46,3,'Caixa nestle',' ',4.99,130.0,'../_imagens/nestle_promo.jpg','S'),(47,3,'Pacote sonho de valsa',' ',29.99,1000.0,'../_imagens/pacote_sonho_1k.jpg','N'),(48,3,'lacta oreo',' ',1.50,0.3,'../_imagens/lacta_oreo_20g.jpg','N'),(49,3,'lacta diamante',' ',4.99,150.0,'../_imagens/lacta_diamante_150.jpg','S'),(50,3,'lacta oreo',' ',4.99,150.0,'../_imagens/lacta_oreo_150.jpg','S');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-02 15:29:43
