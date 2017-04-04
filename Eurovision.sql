CREATE DATABASE  IF NOT EXISTS `eurovision` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eurovision`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: eurovision
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `canciones`
--

DROP TABLE IF EXISTS `canciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canciones` (
  `idCancion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `interprete` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `idPais` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `agno` int(11) NOT NULL,
  PRIMARY KEY (`idCancion`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canciones`
--

LOCK TABLES `canciones` WRITE;
/*!40000 ALTER TABLE `canciones` DISABLE KEYS */;
INSERT INTO `canciones` VALUES (1,'Sing It Away','Sandhja','https://www.youtube.com/embed/Ge5iMzHc3cY',1,'',2016),(2,'Heartbeat','Justs','https://www.youtube.com/embed/NVcKNzmvfxI',12,'F',2016),(3,'Icebreaker','Agnete','https://www.youtube.com/embed/S2GUS-3T7cU',11,'',2016),(4,'Blue and Red','ManuElla','https://www.youtube.com/embed/4K4h4AzLFgU',14,'',2016),(5,'Falling Stars','Lidia Isac','https://www.youtube.com/embed/9O6ADB-g4Fw',15,'',2016),(6,'I Didnt Know','Serhat','https://www.youtube.com/embed/KYKFKgwVbV4',17,'',2016),(7,'If Love Was A Crime','Poli Genova','https://www.youtube.com/embed/yKsNfccUTuk',18,'F',2016),(8,'Hear Them Calling','Greta Salóme','https://www.youtube.com/embed/7xQxQRdZasQ',19,'',2016),(9,'Walk on Water','Ira Losco','https://www.youtube.com/embed/9J7O5BGqPDk',20,'F',2016),(10,'Loin dici','ZOË','https://www.youtube.com/embed/ZaPGwvAis3U',21,'F',2016),(11,'Pioneer','Freddie','https://www.youtube.com/embed/NU8wso6fngM',22,'F',2016),(12,'The Last Of Our Kind','Rykka','https://www.youtube.com/embed/SPpfb3jRaHQ',23,'',2016),(13,'Youre Not Alone','Joe and Jake','https://www.youtube.com/embed/C5VvsLEd1TI',6,'F',2016),(14,'Made of Stars','Hovi Star','https://www.youtube.com/embed/SpWKfcjXcp0',24,'F',2016),(15,'Fairytale','Eneda Tarifa','https://www.youtube.com/embed/je1ICZiKT4g',25,'',2016),(16,'Say Yay!','Barei','https://www.youtube.com/embed/jBmkNzFZUW4',2,'F',2016),(18,'Color Of Your Life','Micha Szpak','https://www.youtube.com/embed/Sjup9PJ25LM',26,'F',2016),(19,'Jai cherché','Amir','https://www.youtube.com/embed/boYQovCybYQ',3,'F',2016),(20,'Miracle','Samra','https://www.youtube.com/embed/Dix6XJ_Uo-w',27,'F',2016),(22,'Goodbye','ZAA Sanja Vuci','https://www.youtube.com/embed/mqh-XVcjmHc',28,'F',2016),(23,'Midnight Gold','Nika Kocharov and Young Georgian Lolitaz','https://www.youtube.com/embed/y5VynlW6Xeo',29,'F',2016),(24,'I Stand','Gabriela Guncíková','https://www.youtube.com/embed/0L2imZRo6NY',30,'F',2016),(25,'Sound Of Silence','Dami Im','https://www.youtube.com/embed/2EG_Jtw4OyU',31,'F',2016),(26,'Utopian Land','ARGO','https://www.youtube.com/embed/AqrdpcY3skI',32,'',2016),(27,'Dona','Kaliopi','https://www.youtube.com/embed/fd8WHhNWp4c',33,'',2016),(28,'You are the only one','Sergey Lazarev','https://www.youtube.com/embed/w7hRZS-nLhY',10,'F',2016),(29,'The Real Thing','Highway','https://www.youtube.com/embed/SNTPaTnoTuY',34,'',2016),(30,'Slow Down','Douwe Bob','https://www.youtube.com/embed/vytgHD2pqyk',35,'F',2016),(31,'LoveWave','Iveta Mukuchyan','https://www.youtube.com/embed/l7m3wOGhEvE',36,'F',2016),(32,'Alter Ego','Minus One','https://www.youtube.com/embed/k8LcNrqiIFE',37,'F',2016),(33,'Ghost','Jamie-Lee','https://www.youtube.com/embed/f-Z7pKopP9s',4,'F',2016),(34,'Ive been waiting for this night','Donny Montell','https://www.youtube.com/embed/7cAIsbUczSI',38,'F',2016),(35,'If I Were Sorry','Frans','https://www.youtube.com/embed/h8D7KNFtTlE',8,'F',2016),(36,'Play','Jüri Pootsmann','https://www.youtube.com/embed/A8oilbtQptQ',13,'',2016),(37,'Sunlight','Nicky Byrne','https://www.youtube.com/embed/DCXueTvhjNo',39,'',2016),(39,'Lighthouse','Nina Kraljic','https://www.youtube.com/embed/ZPDKaOgkAGY',40,'F',2016),(40,'No Degree of Separation','Francesca Michielin','https://www.youtube.com/embed/WySSLip5uzc',5,'F',2016),(41,'Moment Of Silence','Ovidiu Anton','https://www.youtube.com/embed/BUQp3405lNI',41,'',2016),(42,'Soldiers of Love','Lighthouse X','https://www.youtube.com/embed/eLo4bscW6GA',42,'',2016),(43,'1944','Jamala','https://www.youtube.com/embed/oxS6eKEOdLQ',43,'F',2016),(44,'Whats The Pressure ','Laura Tesoro','https://www.youtube.com/embed/iP3USrYpr5w',16,'F',2016),(45,'Do It For Your Lover','Manel Navarro','https://www.youtube.com/embed/9jO32_trJq4',2,'F',2017),(51,'Blackbird ','Norma John','https://www.youtube.com/embed/qTLczT5h9Lo',1,'F',2017),(85,'Requiem','Alma','https://www.youtube.com/embed/Koi36aeRv7I',3,'',2017),(86,'Perfect Life','Levina','https://www.youtube.com/embed/y7pUKkSrXFY',4,'',2017),(87,'Occidentali\'s Karma','Francesco Gabbani','https://www.youtube.com/embed/Mj6tVGKzfhU',5,'',2017),(88,'gjgjghjghj','hgjhgjghj','https://www.youtube.com/embed/jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj',9,'',2017),(89,'ghghnghgfj','hgjhgjhgjhgj','https://www.youtube.com/embed/jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj',12,'',2017);
/*!40000 ALTER TABLE `canciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `idPais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Finlandia','PNG/esc_finland'),(2,'España','PNG/esc_spain'),(3,'Francia','PNG/esc_france'),(4,'Alemania','PNG/esc_germany'),(5,'Italia','PNG/esc_italy'),(6,'Reino Unido','PNG/esc_unitedkingdom'),(7,'Escocia','PNG/esc_albania'),(8,'Suecia','PNG/esc_sweden'),(9,'Portugal','PNG/esc_portugal'),(10,'Rusia','PNG/esc_russia'),(11,'Noruega','PNG/esc_norway'),(12,'Letonia','PNG/esc_latvia'),(13,'Estonia','PNG/esc_estonia'),(14,'Eslovenia','PNG/esc_slovenia'),(15,'Moldovia','PNG/esc_Moldova'),(16,'Bélgica','PNG/esc_belgium'),(17,'San Marino','PNG/esc_sanmarino'),(18,'Bulgaria','PNG/esc_bulgaria'),(19,'Islandia','PNG/esc_iceland'),(20,'Malta','PNG/esc_malta'),(21,'Austria','PNG/esc_austria'),(22,'Hungría','PNG/esc_hungary'),(23,'Suiza','PNG/esc_switzerland'),(24,'Israel','PNG/esc_israel'),(25,'Albania','PNG/esc_albania'),(26,'Polonia','PNG/esc_poland'),(27,'Azerbaijan','PNG/esc_azerbaijan'),(28,'Serbia','PNG/esc_serbia'),(29,'Georgia','PNG/esc_georgia'),(30,'República Checa','PNG/esc_czechrepublic'),(31,'Australia','PNG/esc_australia'),(32,'Grecia','PNG/esc_greece'),(33,'Macedonia','PNG/esc_macedonia'),(34,'Montenegro','PNG/esc_montenegro'),(35,'Países Bajos','PNG/esc_netherlands'),(36,'Armenia','PNG/esc_armenia'),(37,'Chipre','PNG/esc_cyprus'),(38,'Lituania','PNG/esc_lithuania'),(39,'Irlanda','PNG/esc_ireland'),(40,'Croacia','PNG/esc_croatia'),(41,'Rumanía','PNG/esc_romania'),(42,'Dinamarca','PNG/esc_denmark'),(43,'Ucrania','PNG/esc_ukraine');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntuaciones`
--

DROP TABLE IF EXISTS `puntuaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puntuaciones` (
  `nombreUsuario` varchar(255) NOT NULL,
  `idCancion` int(11) NOT NULL,
  `puntVoz` decimal(11,2) NOT NULL,
  `puntCan` decimal(11,2) NOT NULL,
  `comentario` varchar(1000) NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`idCancion`,`nombreUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntuaciones`
--

LOCK TABLES `puntuaciones` WRITE;
/*!40000 ALTER TABLE `puntuaciones` DISABLE KEYS */;
INSERT INTO `puntuaciones` VALUES ('ancor',1,7.50,8.50,'','Y'),('dailos',1,7.50,7.00,'','Y'),('ismael',1,7.68,8.50,'                                        ','Y'),('jaime',1,7.80,8.50,'','Y'),('prueba',1,6.00,6.00,'','Y'),('ancor',2,6.75,7.00,'','Y'),('dailos',2,4.50,4.50,'','Y'),('ismael',2,5.00,5.00,'','Y'),('jaime',2,8.00,8.00,'','Y'),('prueba',2,5.00,5.00,'','Y'),('ancor',3,6.50,6.50,'','Y'),('dailos',3,7.50,6.75,'','Y'),('ismael',3,7.00,7.00,'','Y'),('jaime',3,9.20,9.50,'','Y'),('ancor',4,7.00,7.25,'','Y'),('dailos',4,6.75,6.75,'','Y'),('ismael',4,7.00,6.75,'','Y'),('jaime',4,8.00,8.00,'','Y'),('prueba',4,5.00,5.00,'','Y'),('ancor',5,6.50,6.00,'','Y'),('dailos',5,7.00,6.00,'YIAAASS CUOÑOO EL CAFIENSIIITOOO!!!! PILAAAA ASÓMATE MUCHACHAA QUE TIENE CAFIIIEEENN!!! AAAYYY  Y EL LOCOOO ESE QUIEN EEES QUE ESTÁ ENMASCARADOO....YO A GENTE RARAAA NO QUIERO EN EL FESTIVAL EEEH YO A ESE MACHANGO NO LO SUBO EN LAS CARRUUOOZASSS!!! ','Y'),('ismael',5,7.50,6.00,'','Y'),('jaime',5,7.00,7.50,'','Y'),('ancor',6,5.00,5.50,'','Y'),('dailos',6,5.00,5.00,'','Y'),('ismael',6,3.50,4.00,'','Y'),('jaime',6,4.00,5.00,'','Y'),('ancor',7,6.00,7.00,'','Y'),('dailos',7,5.00,5.00,'Ánimo! Menos mal que no vas a ganar...... \n','Y'),('ismael',7,7.00,7.80,'','Y'),('jaime',7,9.00,9.20,'','Y'),('ancor',8,6.75,7.25,'','Y'),('dailos',8,5.00,5.00,'Parece Rafaella Carrá... sólo le falta terminar de EXPLOTAR Y REVENTAR ENTRE LOS ESCOMBROS!!!','Y'),('ismael',8,7.50,8.50,'','Y'),('jaime',8,9.00,9.25,'','Y'),('ancor',9,6.25,7.00,'','Y'),('dailos',9,6.25,5.50,'El vestido como dice el CHORIZO no le favorece nada!! Parece un espantapájaros!!','Y'),('ismael',9,7.00,7.00,'','Y'),('jaime',9,9.00,8.70,'','Y'),('ancor',10,6.00,6.50,'','Y'),('dailos',10,5.75,6.00,'','Y'),('ismael',10,7.50,7.00,'','Y'),('jaime',10,8.80,8.50,'','Y'),('ancor',11,9.00,8.75,'','Y'),('dailos',11,7.00,7.00,'','Y'),('ismael',11,7.50,7.80,'','Y'),('jaime',11,8.50,9.30,'','Y'),('ancor',12,6.00,6.00,'','Y'),('dailos',12,6.00,5.00,'','Y'),('ismael',12,7.00,6.10,'','Y'),('jaime',12,8.80,8.20,'','Y'),('ancor',13,6.50,8.00,'','Y'),('dailos',13,5.00,5.00,'Antes Reino Unido tenía más nivel. Para ver a dos chavales de discoteca no me hace falta encender el televisor y ver Eurovisión.','Y'),('ismael',13,7.00,8.00,'','Y'),('jaime',13,8.20,9.00,'','Y'),('ancor',14,6.50,6.00,'','Y'),('dailos',14,6.75,6.75,'','Y'),('ismael',14,7.00,6.75,'','Y'),('jaime',14,8.50,9.20,'','Y'),('ancor',15,6.50,6.00,'','Y'),('dailos',15,6.00,5.00,'','Y'),('ismael',15,5.50,6.00,'','Y'),('jaime',15,8.50,7.00,'','Y'),('ancor',16,7.50,7.00,'','Y'),('dailos',16,7.50,7.50,'Considero que es una canción muy comercial que está bien interpretada y puede alcanzar un éxito más que aceptable. Sin embargo, desde mi punto de vista, es una canción que no tiene nada que ver con la esencia que hasta ahora ha caracterizado a España en el Festival de Eurovisión. Por otro lado, el hecho de cantar en inglés no creo que sea el truco o la clave ganar dicho Festival, no obstante, me parece muy bien que se hayan atrevido a enviar una canción totalmente cantada en inglés. ','Y'),('ismael',16,7.00,7.30,'','Y'),('jaime',16,9.00,9.20,'','Y'),('prueba',16,8.00,8.00,'','Y'),('ancor',18,7.00,6.25,'','Y'),('dailos',18,7.00,7.50,'','Y'),('ismael',18,7.00,6.00,'','Y'),('jaime',18,8.50,8.50,'','Y'),('ancor',19,7.00,8.75,'','Y'),('dailos',19,8.50,8.50,'Una buena candidata para ganar el Festival de Eurovisión. Espero que quede entre los tres primeros puestos.','Y'),('ismael',19,9.00,8.75,'Me encanta el ritmo !!','Y'),('jaime',19,8.50,9.00,'','Y'),('prueba',19,8.00,8.00,'','Y'),('ancor',20,7.25,8.25,'','Y'),('dailos',20,7.00,7.00,'El videoclip muy poco trabajado,la verdad sea dicha!! Pero reconozco que la canción me gusta!! :)','Y'),('ismael',20,7.00,7.50,'','Y'),('jaime',20,9.00,8.50,'','Y'),('ancor',22,7.00,7.50,'','Y'),('dailos',22,6.00,6.00,'','Y'),('ismael',22,6.56,7.49,'','Y'),('jaime',22,8.50,8.00,'','Y'),('ancor',23,5.50,6.00,'','Y'),('dailos',23,4.50,4.50,'','Y'),('ismael',23,4.75,5.00,'','Y'),('jaime',23,7.00,7.00,'','Y'),('ancor',24,6.75,6.75,'','Y'),('dailos',24,6.00,5.00,'','Y'),('ismael',24,6.00,5.75,'','Y'),('jaime',24,8.50,8.20,'','Y'),('ancor',25,8.60,8.88,'','Y'),('dailos',25,9.50,9.50,'Muy buena canción!! Espero que se posicione entre los tres primeros!! :)','Y'),('ismael',25,8.85,8.50,'','Y'),('jaime',25,9.50,9.00,'','Y'),('ancor',26,5.00,5.00,'','Y'),('dailos',26,3.50,3.50,'Horrible!!!!!!! Y ese piojoso encima corriendo y no sabe ni dónde coño está la meta!!!!','Y'),('ismael',26,4.00,3.00,'','Y'),('jaime',26,7.00,5.00,'','Y'),('ancor',27,6.00,6.00,'','Y'),('dailos',27,9.00,9.00,'BRAVOOOOOOOO!!!!','Y'),('ismael',27,7.00,6.00,'','Y'),('jaime',27,9.00,8.00,'','Y'),('ancor',28,7.50,9.00,'','Y'),('dailos',28,7.00,7.00,'Sé que es de las candidatas para ganar pero a mí me gusta lo justo.','Y'),('ismael',28,8.40,9.25,'','Y'),('jaime',28,8.50,8.80,'','Y'),('ancor',29,5.00,5.50,'','Y'),('dailos',29,3.00,3.00,'HORRIBLEEE!!!','Y'),('ismael',29,4.00,4.00,'','Y'),('jaime',29,7.00,7.50,'','Y'),('ancor',30,6.00,7.00,'','Y'),('dailos',30,5.00,5.00,'Es una canción para cantarla en el bar después de tomarte cuatro cervezas y un wisky!!! No es una canción como para ir a Eurovisión!! ','Y'),('ismael',30,7.00,7.20,'','Y'),('jaime',30,8.20,8.50,'','Y'),('ancor',31,6.50,6.50,'','Y'),('dailos',31,6.50,6.00,'','Y'),('ismael',31,6.75,6.00,'','Y'),('jaime',31,9.20,9.20,'','Y'),('ancor',32,6.00,6.00,'','Y'),('dailos',32,3.50,3.50,'','Y'),('ismael',32,7.00,7.75,'','Y'),('jaime',32,8.50,8.80,'','Y'),('ancor',33,6.50,7.65,'','Y'),('dailos',33,7.00,6.50,'La chica está buenísima!!! Pero no podemos mezclar el trabajo con el placer. Aceptable.','Y'),('ismael',33,7.00,6.30,'Sin ritmo, sin pasión, aunque esté en directo. No transmite emoción','Y'),('jaime',33,8.50,8.20,'','Y'),('ancor',34,6.00,6.00,'','Y'),('dailos',34,5.50,5.50,'','Y'),('ismael',34,7.00,7.30,'','Y'),('jaime',34,9.00,9.20,'','Y'),('ancor',35,6.00,7.00,'','Y'),('dailos',35,4.00,4.50,'Lo siento!! Hasta luego!!','Y'),('ismael',35,6.00,7.00,'','Y'),('jaime',35,8.30,8.60,'','Y'),('ancor',36,6.50,6.00,'','Y'),('dailos',36,6.00,5.50,'','Y'),('ismael',36,7.25,6.50,'','Y'),('jaime',36,8.30,8.50,'','Y'),('ancor',37,6.50,6.75,'','Y'),('dailos',37,7.00,7.00,'','Y'),('ismael',37,7.00,7.80,'','Y'),('jaime',37,7.80,8.80,'','Y'),('ancor',39,6.00,6.00,'','Y'),('dailos',39,5.00,5.00,'','Y'),('ismael',39,7.00,6.40,'','Y'),('jaime',39,8.80,9.00,'','Y'),('ancor',40,7.50,7.75,'','Y'),('dailos',40,6.50,6.00,'','Y'),('ismael',40,7.00,7.30,'Lejos de Il Volvo. Italia sigue apostando por su idioma, cosa que veo bien','Y'),('jaime',40,8.50,8.00,'','Y'),('ancor',41,6.00,6.00,'','Y'),('dailos',41,6.00,6.00,'','Y'),('ismael',41,5.00,4.00,'','Y'),('jaime',41,7.00,5.00,'','Y'),('ancor',42,6.50,7.00,'','Y'),('dailos',42,7.50,7.50,'','Y'),('ismael',42,7.90,8.20,'','Y'),('jaime',42,8.00,8.20,'','Y'),('ancor',43,6.50,6.25,'','Y'),('dailos',43,5.00,5.00,'','Y'),('ismael',43,8.00,8.51,'','Y'),('jaime',43,8.50,8.00,'','Y'),('dailos',44,7.00,7.50,'','Y'),('ismael',44,7.00,8.40,'','Y'),('jaime',44,8.50,9.20,'','Y'),('ismael',45,5.00,2.00,'                    GHGHGVBVHGBJ                    ','Y'),('prueba',45,1.00,1.00,'','Y'),('ismael',51,7.00,8.00,'                                        ','Y'),('prueba',51,7.00,7.00,'','Y'),('ismael',85,8.00,8.00,'','Y'),('prueba',85,5.00,5.00,'','Y'),('prueba',86,5.00,5.00,'','Y'),('prueba',87,5.00,5.00,'','Y'),('prueba',88,5.00,5.00,'','Y'),('ismael',89,8.00,8.00,'             vbnbvn               vcbvcbvcbn             ','Y');
/*!40000 ALTER TABLE `puntuaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top`
--

DROP TABLE IF EXISTS `top`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top` (
  `idTop` int(11) NOT NULL AUTO_INCREMENT,
  `puesto` int(11) NOT NULL,
  `idCancion` int(11) NOT NULL,
  `agno` int(11) NOT NULL,
  PRIMARY KEY (`idTop`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top`
--

LOCK TABLES `top` WRITE;
/*!40000 ALTER TABLE `top` DISABLE KEYS */;
INSERT INTO `top` VALUES (1,1,43,2016),(2,2,25,2016),(5,3,28,2016),(6,4,7,2016),(7,5,35,2016),(8,6,19,2016),(9,7,31,2016),(10,8,18,2016),(11,9,34,2016),(12,10,44,2016);
/*!40000 ALTER TABLE `top` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top_usuarios`
--

DROP TABLE IF EXISTS `top_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top_usuarios` (
  `idTopUsu` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(255) NOT NULL,
  `puesto` int(11) NOT NULL,
  `idCancion` int(11) NOT NULL,
  `agno` varchar(255) NOT NULL,
  PRIMARY KEY (`idTopUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top_usuarios`
--

LOCK TABLES `top_usuarios` WRITE;
/*!40000 ALTER TABLE `top_usuarios` DISABLE KEYS */;
INSERT INTO `top_usuarios` VALUES (35,'ismael',4,43,'2016'),(41,'ismael',8,7,'2016'),(42,'ismael',9,32,'2016'),(43,'ismael',10,30,'2016'),(44,'dailos',10,14,'2016'),(45,'dailos',6,33,'2016'),(46,'dailos',5,18,'2016'),(48,'dailos',3,28,'2016'),(49,'dailos',2,19,'2016'),(50,'dailos',1,25,'2016'),(59,'ismael',2,25,'2016'),(60,'ismael',5,44,'2016'),(61,'ismael',6,11,'2016'),(62,'ismael',7,13,'2016'),(63,'dailos',4,44,'2016'),(64,'dailos',7,11,'2016'),(65,'dailos',8,20,'2016'),(66,'dailos',9,16,'2016'),(67,'ismael',3,19,'2016'),(68,'ismael',1,28,'2016'),(69,'jaime',1,28,'2016'),(70,'jaime',2,25,'2016'),(71,'jaime',3,31,'2016'),(72,'jaime',4,43,'2016'),(73,'jaime',5,34,'2016'),(74,'jaime',6,14,'2016'),(75,'jaime',7,7,'2016'),(76,'jaime',8,35,'2016'),(77,'jaime',9,19,'2016'),(78,'jaime',10,2,'2016'),(79,'ancor',1,28,'2016'),(80,'ancor',2,25,'2016'),(81,'ancor',3,19,'2016'),(82,'ancor',4,11,'2016'),(83,'ancor',5,20,'2016'),(84,'ancor',6,40,'2016'),(85,'ancor',7,33,'2016'),(86,'ancor',8,22,'2016'),(87,'ancor',9,13,'2016'),(88,'ancor',10,30,'2016'),(99,'prueba',2,51,'2017'),(101,'prueba',1,45,'2017'),(104,'ismael',3,45,'2017'),(106,'ismael',2,51,'2017');
/*!40000 ALTER TABLE `top_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `nivel` varchar(100) NOT NULL DEFAULT 'Registrado',
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('ancor','ancor@ancor.ancor','4a7d1ed414474e4033ac29ccb8653d9b','Registrado'),('dailos','a@b.com','4a7d1ed414474e4033ac29ccb8653d9b','Registrado'),('david','david@david.david','4a7d1ed414474e4033ac29ccb8653d9b','Registrado'),('ismael','ismael@ismael.ismael','4a7d1ed414474e4033ac29ccb8653d9b','Administrador'),('jaime','a@b.com','4a7d1ed414474e4033ac29ccb8653d9b','Registrado'),('prueba','prueba@prueba.com','4a7d1ed414474e4033ac29ccb8653d9b','Registrado');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'eurovision'
--
/*!50003 DROP PROCEDURE IF EXISTS `getSongFOfUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getSongFOfUser`(in user varchar(20), agno varchar(20))
BEGIN
	SELECT canciones.idCancion, canciones.enlace, paises.nombre as nomPais, canciones.nombre, canciones.interprete, puntVoz, puntCan 
	FROM puntuaciones 
	left join canciones on (puntuaciones.idCancion = canciones.idCancion) 
	left join paises on (canciones.idPais = paises.idPais)
	WHERE nombreUsuario=user
	and canciones.agno = agno
	and canciones.estado = "F";
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getSongGlo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getSongGlo`(in agno varchar(20))
BEGIN
	SELECT canciones.idCancion, canciones.enlace, paises.nombre as nomPais, canciones.nombre, canciones.interprete, avg(puntVoz) as puntVoz,
	avg(puntCan) as puntCan
	FROM puntuaciones 
	left join canciones on (puntuaciones.idCancion = canciones.idCancion) 	
	left join paises on (canciones.idPais = paises.idPais) 
	WHERE canciones.agno = agno
	group by puntuaciones.idCancion;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getSongIdJDI` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getSongIdJDI`(in agno varchar(20))
BEGIN
	SELECT distinct puntuaciones.idCancion 
	from puntuaciones,canciones 
	where puntuaciones.idCancion = canciones.idCancion 
	and canciones.agno = agno
	and (puntuaciones.nombreUsuario = "ismael" 
	or puntuaciones.nombreUsuario = "jaime" 
	or puntuaciones.nombreUsuario = "dailos");


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getSongOfUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getSongOfUser`(in user varchar(20), agno varchar(20))
BEGIN
	SELECT canciones.idCancion, canciones.enlace, paises.nombre as nomPais, canciones.nombre, canciones.interprete, puntVoz, puntCan 
	FROM puntuaciones 
	left join canciones on (puntuaciones.idCancion = canciones.idCancion) 
	left join paises on (canciones.idPais = paises.idPais)
	WHERE nombreUsuario=user
	and canciones.agno = agno;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prueba` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prueba`(in id1 varchar(20), name1 varchar(20), name2 varchar(20), name3 varchar(20))
BEGIN
	SELECT canciones.idCancion, canciones.enlace, paises.nombre as nomPais,  canciones.nombre, canciones.interprete, puntVoz as puntVozJ, puntCan as puntCanJ,    
	(SELECT puntVoz from puntuaciones where idCancion = id1 and nombreUsuario=name2) as puntVozI,
	(SELECT puntCan from puntuaciones where idCancion = id1 and nombreUsuario=name2) as puntCanI,
	(SELECT puntVoz from puntuaciones where idCancion = id1 and nombreUsuario=name3) as puntVozD,
	(SELECT puntCan from puntuaciones where idCancion = id1 and nombreUsuario=name3) as puntCanD 
	FROM puntuaciones 
	left join canciones on (puntuaciones.idCancion = canciones.idCancion) 
	left join paises on (canciones.idPais = paises.idPais) 
	WHERE nombreUsuario=name1 
	and puntuaciones.idCancion = id1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-04 19:02:36
