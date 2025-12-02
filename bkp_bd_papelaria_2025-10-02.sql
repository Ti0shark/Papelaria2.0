-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: papelaria
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Lorena','12 34343'),(2,'João','42 919239123'),(3,'Gregory','4399857');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra` (
  `id_compra` int NOT NULL AUTO_INCREMENT,
  `data_compra` date DEFAULT NULL,
  `distribuidor_id_distribuidor` int NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `fk_compra_distribuidor1_idx` (`distribuidor_id_distribuidor`),
  CONSTRAINT `fk_compra_distribuidor1` FOREIGN KEY (`distribuidor_id_distribuidor`) REFERENCES `distribuidor` (`id_distribuidor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribuidor`
--

DROP TABLE IF EXISTS `distribuidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distribuidor` (
  `id_distribuidor` int NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(45) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_distribuidor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribuidor`
--

LOCK TABLES `distribuidor` WRITE;
/*!40000 ALTER TABLE `distribuidor` DISABLE KEYS */;
INSERT INTO `distribuidor` VALUES (1,'10001220','Quebrada','42 43533562');
/*!40000 ALTER TABLE `distribuidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(45) DEFAULT NULL,
  `quant_produto` int DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `descricao` text,
  `tipoproduto_id_tipoproduto` int NOT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `fk_Produto_tipoproduto_idx` (`tipoproduto_id_tipoproduto`),
  CONSTRAINT `fk_Produto_tipoproduto` FOREIGN KEY (`tipoproduto_id_tipoproduto`) REFERENCES `tipoproduto` (`id_tipoproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_has_compra`
--

DROP TABLE IF EXISTS `produto_has_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_has_compra` (
  `Produto_id_produto` int NOT NULL,
  `compra_id_compra` int NOT NULL,
  PRIMARY KEY (`Produto_id_produto`,`compra_id_compra`),
  KEY `fk_Produto_has_compra_compra1_idx` (`compra_id_compra`),
  KEY `fk_Produto_has_compra_Produto1_idx` (`Produto_id_produto`),
  CONSTRAINT `fk_Produto_has_compra_compra1` FOREIGN KEY (`compra_id_compra`) REFERENCES `compra` (`id_compra`),
  CONSTRAINT `fk_Produto_has_compra_Produto1` FOREIGN KEY (`Produto_id_produto`) REFERENCES `produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_has_compra`
--

LOCK TABLES `produto_has_compra` WRITE;
/*!40000 ALTER TABLE `produto_has_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_has_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_has_venda`
--

DROP TABLE IF EXISTS `produto_has_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_has_venda` (
  `Produto_id_produto` int NOT NULL,
  `venda_id_venda` int NOT NULL,
  PRIMARY KEY (`Produto_id_produto`,`venda_id_venda`),
  KEY `fk_Produto_has_venda_venda1_idx` (`venda_id_venda`),
  KEY `fk_Produto_has_venda_Produto1_idx` (`Produto_id_produto`),
  CONSTRAINT `fk_Produto_has_venda_Produto1` FOREIGN KEY (`Produto_id_produto`) REFERENCES `produto` (`id_produto`),
  CONSTRAINT `fk_Produto_has_venda_venda1` FOREIGN KEY (`venda_id_venda`) REFERENCES `venda` (`id_venda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_has_venda`
--

LOCK TABLES `produto_has_venda` WRITE;
/*!40000 ALTER TABLE `produto_has_venda` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_has_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoproduto`
--

DROP TABLE IF EXISTS `tipoproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipoproduto` (
  `id_tipoproduto` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipoproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoproduto`
--

LOCK TABLES `tipoproduto` WRITE;
/*!40000 ALTER TABLE `tipoproduto` DISABLE KEYS */;
INSERT INTO `tipoproduto` VALUES (1,'Cartulina azul marinho 20X30 cm.');
/*!40000 ALTER TABLE `tipoproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venda`
--

DROP TABLE IF EXISTS `venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venda` (
  `id_venda` int NOT NULL AUTO_INCREMENT,
  `data_venda` date DEFAULT NULL,
  `cliente_id_cliente` int NOT NULL,
  PRIMARY KEY (`id_venda`),
  KEY `fk_venda_cliente1_idx` (`cliente_id_cliente`),
  CONSTRAINT `fk_venda_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venda`
--

LOCK TABLES `venda` WRITE;
/*!40000 ALTER TABLE `venda` DISABLE KEYS */;
/*!40000 ALTER TABLE `venda` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-02 11:07:23
