-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: miniproject
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `analysislist`
--

DROP TABLE IF EXISTS `analysislist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analysislist` (
  `anaCode` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `anaName` varchar(30) NOT NULL,
  PRIMARY KEY (`anaCode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `analysislist`
--

LOCK TABLES `analysislist` WRITE;
/*!40000 ALTER TABLE `analysislist` DISABLE KEYS */;
INSERT INTO `analysislist` VALUES (1,'เตรียมตัวอย่าง (บด)'),(2,'เตรียมตัวอย่าง (บดและอบ)'),(3,'ความชื้น'),(4,'เถ้า'),(5,'โปรตีนรวม'),(6,'ไขมันรวม'),(7,'เยื่อใยรวม'),(8,'ผนังเซลล์'),(9,'ลิกโนเซลลูโลส'),(10,'ลิกนิน'),(11,'พลังงานรวม');
/*!40000 ALTER TABLE `analysislist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorys` (
  `catCode` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `catName` varchar(30) NOT NULL,
  PRIMARY KEY (`catCode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorys`
--

LOCK TABLES `categorys` WRITE;
/*!40000 ALTER TABLE `categorys` DISABLE KEYS */;
INSERT INTO `categorys` VALUES (1,'นักศึกษาปริญญาตรี'),(2,'นักศึกษาปริญญาโท'),(3,'นักศึกษาปริญญาเอก'),(4,'นักวิจัยในคณะ ฯ'),(5,'นักวิจัยนอกคณะ ฯ'),(6,'บุคคลทั่วไป');
/*!40000 ALTER TABLE `categorys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataanalysis`
--

DROP TABLE IF EXISTS `dataanalysis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataanalysis` (
  `daCode` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `volume` int(10) DEFAULT NULL,
  `repeats` int(2) DEFAULT NULL,
  `labCode` int(10) unsigned NOT NULL,
  `scCode` int(2) unsigned NOT NULL,
  PRIMARY KEY (`daCode`),
  KEY `labCode` (`labCode`),
  KEY `scCode` (`scCode`),
  CONSTRAINT `dataanalysis_ibfk_1` FOREIGN KEY (`labCode`) REFERENCES `lab` (`labCode`),
  CONSTRAINT `dataanalysis_ibfk_2` FOREIGN KEY (`scCode`) REFERENCES `servicechargelist` (`scCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataanalysis`
--

LOCK TABLES `dataanalysis` WRITE;
/*!40000 ALTER TABLE `dataanalysis` DISABLE KEYS */;
/*!40000 ALTER TABLE `dataanalysis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `depCode` char(3) NOT NULL,
  `depName` text NOT NULL,
  `facCode` char(3) NOT NULL,
  PRIMARY KEY (`depCode`),
  KEY `facCode` (`facCode`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`facCode`) REFERENCES `faculty` (`facCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES ('001','ภาควิชากายวิภาคศาสตร์','002'),('002','ภาควิชาคณิตศาสตร์และสถิติ','002'),('003','ภาควิชาเคมี','002'),('004','ภาควิชาจุลชีววิทยา','002'),('005','ภาควิชาชีวเคมี','002'),('006','ภาควิชาชีววิทยา','002'),('007','ภาควิชาเทคโนโลยีชีวภาพโมเลกุลและชีวสารสนเทศ','002'),('008','ภาควิชาฟิสิกส์','002'),('009','ภาควิชาเภสัชวิทยา','002'),('010','ภาควิชาวิทยาการคอมพิวเตอร์','002'),('011','ภาควิชาวิทยาศาสตร์ประยุกต์','002'),('012','ภาควิชาวิทยาศาสตร์และเทคโนโลยีวัสดุ','002'),('013','ภาควิชาสรีรวิทยา','002'),('014','ภาควิชาเทคโนโลยีสารสนเทศและการสื่อสาร','002'),('015','ภาควิชาการจัดการศัตรูพืช','001'),('016','ภาควิชาธรณีศาสตร์','001'),('017','ภาควิชาพืชศาสตร์','001'),('018','ภาควิชาพัฒนาการเกษตร','001'),('019','ภาควิชาวาริชศาสตร์','001'),('020','ภาควิชาสัตวศาสตร์','001'),('021','ภาควิชาวิศวกรรมเคมี','003'),('022','ภาควิชาวิศวกรรมคอมพิวเตอร์','003'),('023','ภาควิชาวิศวกรรมไฟฟ้า','003'),('024','ภาควิชาวิศวกรรมเหมืองแร่และวัสดุ','003'),('025','ภาควิชาการจัดการเทคโนโลยีสารสนเทศ','003'),('026','ภาควิชาวิศวกรรมเครื่องกล','003'),('027','ภาควิชาวิศวกรรมโยธา','003'),('028','ภาควิชาวิศวกรรมอุตสาหการ','003'),('029','ภาควิชาการจัดการอุตสาหกรรม','003'),('030','ภาควิชาเทคโนโลยีอาหาร','004'),('031','ภาควิชาเทคโนโลยีวัสดุภัณฑ์','004'),('032','ภาควิชาเทคโนโลยีอุตสาหกรรมเกษตร','004'),('033','ภาควิชาเทคโนโลยีชีวภาพอุตสาหกรรม','004'),('034','ภาควิชาการจัดการพลังงานอย่างยั่งยืน','005'),('035','ภาควิชาการจัดการสิ่งแวดล้อม','005'),('036','ภาควิชาสิ่งแวดล้อมของระบบโลก','005'),('037','ภาควิชาการจัดการการท่องเที่ยวเชิงนิเวศของชุมชน','005'),('038','ภาควิชากายภาพบำบัด','006'),('039','ภาควิชากุมารเวชศาสตร์','006'),('040','ภาควิชาวิสัญญีวิทยา','006'),('041','ภาควิชาชีวเวชศาสตร์','006'),('042','ภาควิชาเวชศาสตร์ครอบครัวและเวชศาสตร์ป้องกัน','006'),('043','ภาควิชาอายุรศาสตร์','006'),('044','ภาควิชาสูติศาสตร์และนรีเวชวิทยา','006'),('045','ภาควิชาจักษุวิทยา','006'),('046','ภาควิชาการบริหารการพยาบาล','007'),('047','ภาควิชาการพยาบาลจิตเวชและสุขภาพจิต','007'),('048','ภาควิชาการพยาบาลเด็กและวัยรุ่น','007'),('049','ภาควิชาการพยาบาลผู้ใหญ่และผู้สูงอายุทางศัลยศาสตร์','007'),('050','ภาควิชาการพยาบาลผู้ใหญ่และผู้สูงอายุทางอายุรศาสตร์','007'),('051','ภาควิชาการพยาบาลมารดา ทารกและการผดุงครรภ์','007'),('052','ภาควิชาการพยาบาลเวชปฏิบัติชุมชน','007'),('053','ภาควิชาชีววิทยาช่องปากและระบบการบดเคี้ยว','008'),('054','ภาควิชาทันตกรรมประดิษฐ์','008'),('055','ภาควิชาทันตกรรมป้องกัน','008'),('056','ภาควิชาทันตกรรมอนุรักษ์','008'),('057','ภาควิชาศัลยศาสตร์','008'),('058','ภาควิชาโอษฐวิทยา','008'),('059','ภาควิชาเภสัชกรรมคลินิก','009'),('060','ภาควิชาเภสัชเคมี','009'),('061','ภาควิชาเทคโนโลยีเภสัชกรรม','009'),('062','ภาควิชาเภสัชเวทและเภสัชพฤกษศาสตร์','009'),('063','ภาควิชาบริหารเภสัชกิจ','009'),('064','ภาควิชาโอษฐวิทยา','009'),('065','ภาควิชาการเงิน','010'),('066','ภาควิชาการตลาด','010'),('067','ภาควิชาการจัดการทรัพยากรมนุษย์','010'),('068','ภาควิชาระบบสารสนเทศทางธุรกิจ','010'),('069','ภาควิชาการจัดการโลจิสติกส์','010'),('070','ภาควิชาการจัดการประชุมนิทรรศการ และการท่องเที่ยวเพื่อเป็นรางวัล','010'),('071','การจัดการ (หลักสูตรภาษาอังกฤษ)','010'),('072','M.B.A.','010'),('073','IMBA','010'),('074','MBA Marketing','010'),('075','M.Acc.','010'),('076','MPA','010'),('077','ปรัชญาดุษฎีบัณฑิต (การจัดการ)','010'),('078','ภาควิชาการจัดการอุตสาหกรรมการบินและการบริการ','011'),('079','ภาควิชาภาษาไทยประยุกต์','011'),('080','ภาควิชาภาษาอังกฤษ','011'),('081','ภาควิชาภาษาจีน','011'),('082','ภาควิชาชุมชนศึกษา','011'),('083','ภาควิชาการสอนภาษาอังกฤษเป็นภาษานานาชาติ','011'),('084','ภาควิชาพัฒนามนุษย์และสังคม','011'),('085','ภาควิชาภาษาไทยและภาษาประยุกต์','011'),('086','ภาควิชาเศรษฐศาสตร์','012'),('087','ภาควิชาเศรษฐศาสตร์เกษตร','012'),('088','ภาควิชาเศรษฐศาสตร์ธุรกิจเกษตร','012'),('089','นิติศาสตรบัณฑิต (ภาคปกติและภาคสมทบ)','013'),('090','นิติศาสตรบัณฑิต (ภาคบัณฑิต)','013'),('091','มคอ.','013'),('092','ภาควิชาเวชกรรมไทย','014'),('093','ภาควิชาเภสัชกรรมไทย','014'),('094','ภาควิชานวดไทย','014'),('095','ภาควิชาผดุงครรภ์ไทย','014'),('096','ภาควิชากายภาพบำบัด','015'),('097','ภาควิชากิจกรรมบำบัด','015'),('098','ภาควิชารังสีเทคนิค','015'),('099','ภาควิชาเทคนิคการแพทย์','015'),('100','ภาควิชาสัตวแพทยศาสตร์','016');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentlab`
--

DROP TABLE IF EXISTS `documentlab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentlab` (
  `docnoLab` int(10) NOT NULL,
  `docnoAcc` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`docnoLab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentlab`
--

LOCK TABLES `documentlab` WRITE;
/*!40000 ALTER TABLE `documentlab` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentlab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `facCode` char(3) NOT NULL,
  `facName` varchar(30) NOT NULL,
  PRIMARY KEY (`facCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES ('001','คณะทรัพยากรธรรมชาติ'),('002','คณะวิทยาศาสตร์'),('003','คณะวิศวกรรมศาสตร์'),('004','คณะอุตสาหกรรมกษตร'),('005','คณะการจัดการสิ่งแวดล้อม'),('006','คณะแพทยศาสตร์'),('007','คณะพยาบาลศาสตร์'),('008','คณะทันตแพทยศาสตร์'),('009','คณะเภสัชศาสตร์'),('010','คณะวิทยาการจัดการ'),('011','คณะศิลปศาสตร์'),('012','คณะเศรษฐศาสตร์'),('013','คณะนิติศาสตร์'),('014','คณะการแพทย์แผนไทย'),('015','คณะเทคนิคการแพทย์'),('016','คณะสัตวแพทยศาสตร์');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab`
--

DROP TABLE IF EXISTS `lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab` (
  `labCode` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `labDocument` varchar(10) NOT NULL,
  `labNo` char(10) NOT NULL,
  `labYear` char(10) NOT NULL,
  `labDate` datetime DEFAULT NULL,
  `labName` varchar(30) DEFAULT NULL,
  `catCode` int(2) unsigned NOT NULL,
  `labTel` char(20) DEFAULT NULL,
  `objCode` int(3) unsigned NOT NULL,
  `objTitle` varchar(30) DEFAULT NULL,
  `labNRepeat` int(1) DEFAULT NULL,
  `labSDate` datetime DEFAULT NULL,
  `labEDate` datetime DEFAULT NULL,
  `teaCode` int(10) unsigned DEFAULT NULL,
  `teaStatus` char(1) DEFAULT NULL,
  `offStatus` char(1) DEFAULT NULL,
  `boStatus` char(1) DEFAULT NULL,
  `repeatStatus` char(1) DEFAULT NULL,
  `teaCm` text DEFAULT NULL,
  `offCm` text DEFAULT NULL,
  `boCm` text DEFAULT NULL,
  `labStatus` char(1) DEFAULT NULL,
  `memCode` int(10) unsigned NOT NULL,
  `offCode` int(10) unsigned DEFAULT NULL,
  `headCode` int(10) unsigned DEFAULT NULL,
  `send` char(1) DEFAULT NULL,
  PRIMARY KEY (`labCode`),
  KEY `catCode` (`catCode`),
  KEY `objCode` (`objCode`),
  KEY `memCode` (`memCode`),
  CONSTRAINT `lab_ibfk_1` FOREIGN KEY (`catCode`) REFERENCES `categorys` (`catCode`),
  CONSTRAINT `lab_ibfk_2` FOREIGN KEY (`objCode`) REFERENCES `objective` (`objCode`),
  CONSTRAINT `lab_ibfk_3` FOREIGN KEY (`memCode`) REFERENCES `member` (`memCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab`
--

LOCK TABLES `lab` WRITE;
/*!40000 ALTER TABLE `lab` DISABLE KEYS */;
/*!40000 ALTER TABLE `lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `memCode` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `memlevel` int(1) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `passmail` varchar(30) DEFAULT NULL,
  `depCode` char(3) NOT NULL,
  PRIMARY KEY (`memCode`),
  KEY `depCode` (`depCode`),
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`depCode`) REFERENCES `department` (`depCode`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'staff','1234',3,'สมศรี สมหวัง','5910210227@psu.ac.th','=2r549z5c','001'),(2,'T1','1234',2,'รศ.ดร.ปิ่น จันจุฬา','5910210227@psu.ac.th','=2r549z5c','001'),(3,'T2','1234',2,'รศ.สุธา วัฒนสิทธิ์','5910210227@psu.ac.th','=2r549z5c','001'),(4,'T3','1234',2,'ผศ.ดร.ไชยวรรณ วัฒนจันทร์','5910210227@psu.ac.th','=2r549z5c','001'),(5,'T4','1234',2,'อ.ดร.ธัญจิรา เทพรัตน์','5910210227@psu.ac.th','=2r549z5c','001'),(6,'T5','1234',2,'อ.ดร.ปิตุนาถ หนูเสน','5910210227@psu.ac.th','=2r549z5c','001'),(7,'T6','1234',2,'ดร.พิชญานิภา กล่อมทอง','5910210227@psu.ac.th','=2r549z5c','001'),(8,'H1','1234',4,'รศ.ดร.วันวิศาข์ งามผ่องใส','5910210227@psu.ac.th','=2r549z5c','001'),(9,'S5910210227','1234',1,'พิทยากร สุดสวาสดิ์','5910210227@psu.ac.th','=2r549z5c','002');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objective`
--

DROP TABLE IF EXISTS `objective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objective` (
  `objCode` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `objName` varchar(30) NOT NULL,
  PRIMARY KEY (`objCode`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objective`
--

LOCK TABLES `objective` WRITE;
/*!40000 ALTER TABLE `objective` DISABLE KEYS */;
INSERT INTO `objective` VALUES (1,'ชื่องานวิจัย'),(2,'ชื่อวิทยานิพนธ์'),(3,'ชื่อปัญหาพิเศษ'),(4,'บริการวิเคราะห์');
/*!40000 ALTER TABLE `objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicechargelist`
--

DROP TABLE IF EXISTS `servicechargelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicechargelist` (
  `scCode` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `catCode` int(2) unsigned NOT NULL,
  `anaCode` int(2) unsigned NOT NULL,
  `simCode` int(2) unsigned NOT NULL,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`scCode`),
  KEY `catCode` (`catCode`),
  KEY `anaCode` (`anaCode`),
  KEY `simCode` (`simCode`),
  CONSTRAINT `servicechargelist_ibfk_1` FOREIGN KEY (`catCode`) REFERENCES `categorys` (`catCode`),
  CONSTRAINT `servicechargelist_ibfk_2` FOREIGN KEY (`anaCode`) REFERENCES `analysislist` (`anaCode`),
  CONSTRAINT `servicechargelist_ibfk_3` FOREIGN KEY (`simCode`) REFERENCES `simplelist` (`simCode`)
) ENGINE=InnoDB AUTO_INCREMENT=463 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicechargelist`
--

LOCK TABLES `servicechargelist` WRITE;
/*!40000 ALTER TABLE `servicechargelist` DISABLE KEYS */;
INSERT INTO `servicechargelist` VALUES (1,1,1,1,0.00),(2,1,1,2,0.00),(3,1,1,3,0.00),(4,1,1,4,0.00),(5,1,1,5,0.00),(6,1,1,6,0.00),(7,1,1,7,0.00),(8,1,2,1,0.00),(9,1,2,2,0.00),(10,1,2,3,0.00),(11,1,2,4,0.00),(12,1,2,5,0.00),(13,1,2,6,0.00),(14,1,2,7,0.00),(15,1,3,1,22.50),(16,1,3,2,22.50),(17,1,3,3,22.50),(18,1,3,4,22.50),(19,1,3,5,22.50),(20,1,3,6,22.50),(21,1,3,7,22.50),(22,1,4,1,32.50),(23,1,4,2,32.50),(24,1,4,3,32.50),(25,1,4,4,32.50),(26,1,4,5,32.50),(27,1,4,6,32.50),(28,1,4,7,32.50),(29,1,5,1,27.00),(30,1,5,2,27.00),(31,1,5,3,27.00),(32,1,5,4,27.00),(33,1,5,5,27.00),(34,1,5,6,27.00),(35,1,5,7,27.00),(36,1,6,1,31.00),(37,1,6,2,31.00),(38,1,6,3,31.00),(39,1,6,4,31.00),(40,1,6,5,31.00),(41,1,6,6,31.00),(42,1,6,7,31.00),(43,1,7,1,10.00),(44,1,7,2,10.00),(45,1,7,3,10.00),(46,1,7,4,10.00),(47,1,7,5,10.00),(48,1,7,6,10.00),(49,1,7,7,10.00),(50,1,8,1,22.00),(51,1,8,2,22.00),(52,1,8,3,22.00),(53,1,8,4,22.00),(54,1,8,5,22.00),(55,1,8,6,22.00),(56,1,8,7,22.00),(57,1,9,1,83.00),(58,1,9,2,83.00),(59,1,9,3,83.00),(60,1,9,4,83.00),(61,1,9,5,83.00),(62,1,9,6,83.00),(63,1,9,7,83.00),(64,1,10,1,95.00),(65,1,10,2,95.00),(66,1,10,3,95.00),(67,1,10,4,95.00),(68,1,10,5,95.00),(69,1,10,6,95.00),(70,1,10,7,95.00),(71,1,11,1,30.00),(72,1,11,2,30.00),(73,1,11,3,30.00),(74,1,11,4,30.00),(75,1,11,5,30.00),(76,1,11,6,30.00),(77,1,11,7,30.00),(78,2,1,1,0.00),(79,2,1,2,0.00),(80,2,1,3,0.00),(81,2,1,4,0.00),(82,2,1,5,0.00),(83,2,1,6,0.00),(84,2,1,7,0.00),(85,2,2,1,0.00),(86,2,2,2,0.00),(87,2,2,3,0.00),(88,2,2,4,0.00),(89,2,2,5,0.00),(90,2,2,6,0.00),(91,2,2,7,0.00),(92,2,3,1,22.50),(93,2,3,2,22.50),(94,2,3,3,22.50),(95,2,3,4,22.50),(96,2,3,5,22.50),(97,2,3,6,22.50),(98,2,3,7,22.50),(99,2,4,1,32.50),(100,2,4,2,32.50),(101,2,4,3,32.50),(102,2,4,4,32.50),(103,2,4,5,32.50),(104,2,4,6,32.50),(105,2,4,7,32.50),(106,2,5,1,27.00),(107,2,5,2,27.00),(108,2,5,3,27.00),(109,2,5,4,27.00),(110,2,5,5,27.00),(111,2,5,6,27.00),(112,2,5,7,27.00),(113,2,6,1,31.00),(114,2,6,2,31.00),(115,2,6,3,31.00),(116,2,6,4,31.00),(117,2,6,5,31.00),(118,2,6,6,31.00),(119,2,6,7,31.00),(120,2,7,1,10.00),(121,2,7,2,10.00),(122,2,7,3,10.00),(123,2,7,4,10.00),(124,2,7,5,10.00),(125,2,7,6,10.00),(126,2,7,7,10.00),(127,2,8,1,22.00),(128,2,8,2,22.00),(129,2,8,3,22.00),(130,2,8,4,22.00),(131,2,8,5,22.00),(132,2,8,6,22.00),(133,2,8,7,22.00),(134,2,9,1,83.00),(135,2,9,2,83.00),(136,2,9,3,83.00),(137,2,9,4,83.00),(138,2,9,5,83.00),(139,2,9,6,83.00),(140,2,9,7,83.00),(141,2,10,1,95.00),(142,2,10,2,95.00),(143,2,10,3,95.00),(144,2,10,4,95.00),(145,2,10,5,95.00),(146,2,10,6,95.00),(147,2,10,7,95.00),(148,2,11,1,30.00),(149,2,11,2,30.00),(150,2,11,3,30.00),(151,2,11,4,30.00),(152,2,11,5,30.00),(153,2,11,6,30.00),(154,2,11,7,30.00),(155,3,1,1,0.00),(156,3,1,2,0.00),(157,3,1,3,0.00),(158,3,1,4,0.00),(159,3,1,5,0.00),(160,3,1,6,0.00),(161,3,1,7,0.00),(162,3,2,1,0.00),(163,3,2,2,0.00),(164,3,2,3,0.00),(165,3,2,4,0.00),(166,3,2,5,0.00),(167,3,2,6,0.00),(168,3,2,7,0.00),(169,3,3,1,22.50),(170,3,3,2,22.50),(171,3,3,3,22.50),(172,3,3,4,22.50),(173,3,3,5,22.50),(174,3,3,6,22.50),(175,3,3,7,22.50),(176,3,4,1,32.50),(177,3,4,2,32.50),(178,3,4,3,32.50),(179,3,4,4,32.50),(180,3,4,5,32.50),(181,3,4,6,32.50),(182,3,4,7,32.50),(183,3,5,1,27.00),(184,3,5,2,27.00),(185,3,5,3,27.00),(186,3,5,4,27.00),(187,3,5,5,27.00),(188,3,5,6,27.00),(189,3,5,7,27.00),(190,3,6,1,31.00),(191,3,6,2,31.00),(192,3,6,3,31.00),(193,3,6,4,31.00),(194,3,6,5,31.00),(195,3,6,6,31.00),(196,3,6,7,31.00),(197,3,7,1,10.00),(198,3,7,2,10.00),(199,3,7,3,10.00),(200,3,7,4,10.00),(201,3,7,5,10.00),(202,3,7,6,10.00),(203,3,7,7,10.00),(204,3,8,1,22.00),(205,3,8,2,22.00),(206,3,8,3,22.00),(207,3,8,4,22.00),(208,3,8,5,22.00),(209,3,8,6,22.00),(210,3,8,7,22.00),(211,3,9,1,83.00),(212,3,9,2,83.00),(213,3,9,3,83.00),(214,3,9,4,83.00),(215,3,9,5,83.00),(216,3,9,6,83.00),(217,3,9,7,83.00),(218,3,10,1,95.00),(219,3,10,2,95.00),(220,3,10,3,95.00),(221,3,10,4,95.00),(222,3,10,5,95.00),(223,3,10,6,95.00),(224,3,10,7,95.00),(225,3,11,1,30.00),(226,3,11,2,30.00),(227,3,11,3,30.00),(228,3,11,4,30.00),(229,3,11,5,30.00),(230,3,11,6,30.00),(231,3,11,7,30.00),(232,4,1,1,12.50),(233,4,1,2,12.50),(234,4,1,3,12.50),(235,4,1,4,12.50),(236,4,1,5,12.50),(237,4,1,6,12.50),(238,4,1,7,12.50),(239,4,2,1,20.00),(240,4,2,2,20.00),(241,4,2,3,20.00),(242,4,2,4,20.00),(243,4,2,5,20.00),(244,4,2,6,20.00),(245,4,2,7,20.00),(246,4,3,1,22.50),(247,4,3,2,22.50),(248,4,3,3,22.50),(249,4,3,4,22.50),(250,4,3,5,22.50),(251,4,3,6,22.50),(252,4,3,7,22.50),(253,4,4,1,32.50),(254,4,4,2,32.50),(255,4,4,3,32.50),(256,4,4,4,32.50),(257,4,4,5,32.50),(258,4,4,6,32.50),(259,4,4,7,32.50),(260,4,5,1,95.00),(261,4,5,2,95.00),(262,4,5,3,95.00),(263,4,5,4,95.00),(264,4,5,5,95.00),(265,4,5,6,95.00),(266,4,5,7,95.00),(267,4,6,1,72.50),(268,4,6,2,72.50),(269,4,6,3,72.50),(270,4,6,4,72.50),(271,4,6,5,72.50),(272,4,6,6,72.50),(273,4,6,7,72.50),(274,4,7,1,110.00),(275,4,7,2,110.00),(276,4,7,3,110.00),(277,4,7,4,110.00),(278,4,7,5,110.00),(279,4,7,6,110.00),(280,4,7,7,110.00),(281,4,8,1,95.00),(282,4,8,2,95.00),(283,4,8,3,95.00),(284,4,8,4,95.00),(285,4,8,5,95.00),(286,4,8,6,95.00),(287,4,8,7,95.00),(288,4,9,1,95.00),(289,4,9,2,95.00),(290,4,9,3,95.00),(291,4,9,4,95.00),(292,4,9,5,95.00),(293,4,9,6,95.00),(294,4,9,7,95.00),(295,4,10,1,110.00),(296,4,10,2,110.00),(297,4,10,3,110.00),(298,4,10,4,110.00),(299,4,10,5,110.00),(300,4,10,6,110.00),(301,4,10,7,110.00),(302,4,11,1,200.00),(303,4,11,2,200.00),(304,4,11,3,200.00),(305,4,11,4,200.00),(306,4,11,5,200.00),(307,4,11,6,200.00),(308,4,11,7,200.00),(309,5,1,1,20.00),(310,5,1,2,20.00),(311,5,1,3,20.00),(312,5,1,4,20.00),(313,5,1,5,20.00),(314,5,1,6,20.00),(315,5,1,7,20.00),(316,5,2,1,30.00),(317,5,2,2,30.00),(318,5,2,3,30.00),(319,5,2,4,30.00),(320,5,2,5,30.00),(321,5,2,6,30.00),(322,5,2,7,30.00),(323,5,3,1,35.00),(324,5,3,2,35.00),(325,5,3,3,35.00),(326,5,3,4,35.00),(327,5,3,5,35.00),(328,5,3,6,35.00),(329,5,3,7,35.00),(330,5,4,1,50.00),(331,5,4,2,50.00),(332,5,4,3,50.00),(333,5,4,4,50.00),(334,5,4,5,50.00),(335,5,4,6,50.00),(336,5,4,7,50.00),(337,5,5,1,142.50),(338,5,5,2,142.50),(339,5,5,3,142.50),(340,5,5,4,142.50),(341,5,5,5,142.50),(342,5,5,6,142.50),(343,5,5,7,142.50),(344,5,6,1,110.00),(345,5,6,2,110.00),(346,5,6,3,110.00),(347,5,6,4,110.00),(348,5,6,5,110.00),(349,5,6,6,110.00),(350,5,6,7,110.00),(351,5,7,1,165.00),(352,5,7,2,165.00),(353,5,7,3,165.00),(354,5,7,4,165.00),(355,5,7,5,165.00),(356,5,7,6,165.00),(357,5,7,7,165.00),(358,5,8,1,142.50),(359,5,8,2,142.50),(360,5,8,3,142.50),(361,5,8,4,142.50),(362,5,8,5,142.50),(363,5,8,6,142.50),(364,5,8,7,142.50),(365,5,9,1,142.50),(366,5,9,2,142.50),(367,5,9,3,142.50),(368,5,9,4,142.50),(369,5,9,5,142.50),(370,5,9,6,142.50),(371,5,9,7,142.50),(372,5,10,1,165.00),(373,5,10,2,165.00),(374,5,10,3,165.00),(375,5,10,4,165.00),(376,5,10,5,165.00),(377,5,10,6,165.00),(378,5,10,7,165.00),(379,5,11,1,250.00),(380,5,11,2,250.00),(381,5,11,3,250.00),(382,5,11,4,250.00),(383,5,11,5,250.00),(384,5,11,6,250.00),(385,5,11,7,250.00),(386,6,1,1,25.00),(387,6,1,2,25.00),(388,6,1,3,25.00),(389,6,1,4,25.00),(390,6,1,5,25.00),(391,6,1,6,25.00),(392,6,1,7,25.00),(393,6,2,1,40.00),(394,6,2,2,40.00),(395,6,2,3,40.00),(396,6,2,4,40.00),(397,6,2,5,40.00),(398,6,2,6,40.00),(399,6,2,7,40.00),(400,6,3,1,45.00),(401,6,3,2,45.00),(402,6,3,3,45.00),(403,6,3,4,45.00),(404,6,3,5,45.00),(405,6,3,6,45.00),(406,6,3,7,45.00),(407,6,4,1,65.00),(408,6,4,2,65.00),(409,6,4,3,65.00),(410,6,4,4,65.00),(411,6,4,5,65.00),(412,6,4,6,65.00),(413,6,4,7,65.00),(414,6,5,1,190.00),(415,6,5,2,190.00),(416,6,5,3,190.00),(417,6,5,4,190.00),(418,6,5,5,190.00),(419,6,5,6,190.00),(420,6,5,7,190.00),(421,6,6,1,145.00),(422,6,6,2,145.00),(423,6,6,3,145.00),(424,6,6,4,145.00),(425,6,6,5,145.00),(426,6,6,6,145.00),(427,6,6,7,145.00),(428,6,7,1,220.00),(429,6,7,2,220.00),(430,6,7,3,220.00),(431,6,7,4,220.00),(432,6,7,5,220.00),(433,6,7,6,220.00),(434,6,7,7,220.00),(435,6,8,1,190.00),(436,6,8,2,190.00),(437,6,8,3,190.00),(438,6,8,4,190.00),(439,6,8,5,190.00),(440,6,8,6,190.00),(441,6,8,7,190.00),(442,6,9,1,190.00),(443,6,9,2,190.00),(444,6,9,3,190.00),(445,6,9,4,190.00),(446,6,9,5,190.00),(447,6,9,6,190.00),(448,6,9,7,190.00),(449,6,10,1,275.00),(450,6,10,2,275.00),(451,6,10,3,275.00),(452,6,10,4,275.00),(453,6,10,5,275.00),(454,6,10,6,275.00),(455,6,10,7,275.00),(456,6,11,1,30000.00),(457,6,11,2,30000.00),(458,6,11,3,30000.00),(459,6,11,4,30000.00),(460,6,11,5,30000.00),(461,6,11,6,30000.00),(462,6,11,7,30000.00);
/*!40000 ALTER TABLE `servicechargelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `simplelist`
--

DROP TABLE IF EXISTS `simplelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `simplelist` (
  `simCode` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `simName` varchar(30) NOT NULL,
  PRIMARY KEY (`simCode`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simplelist`
--

LOCK TABLES `simplelist` WRITE;
/*!40000 ALTER TABLE `simplelist` DISABLE KEYS */;
INSERT INTO `simplelist` VALUES (1,'อาหารหยาบ'),(2,'อาหารข้น'),(3,'TMR'),(4,'ปัสสาวะ'),(5,'มูล'),(6,'Rumen'),(7,'เลือด');
/*!40000 ALTER TABLE `simplelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telephone`
--

DROP TABLE IF EXISTS `telephone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telephone` (
  `telCode` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `telName` char(20) DEFAULT NULL,
  `memCode` int(10) unsigned NOT NULL,
  `telLevel` char(1) DEFAULT NULL,
  PRIMARY KEY (`telCode`),
  KEY `memCode` (`memCode`),
  CONSTRAINT `telephone_ibfk_1` FOREIGN KEY (`memCode`) REFERENCES `member` (`memCode`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telephone`
--

LOCK TABLES `telephone` WRITE;
/*!40000 ALTER TABLE `telephone` DISABLE KEYS */;
INSERT INTO `telephone` VALUES (1,'0831077213',8,'0'),(2,'0653547130',9,'0'),(3,'0-7428-6074',1,'0'),(4,'6074',1,'1'),(5,'0-7455-8803',1,'2'),(6,'0-7428-6070',2,'0'),(7,'60070',2,'1'),(8,'0-7455-8803',2,'2'),(9,'0-7428-6082',3,'0'),(10,'6082',3,'1'),(11,'0-7455-8803',3,'2'),(12,'0-7428-6078',4,'0'),(13,'6078',4,'1'),(14,'0-7455-8803',4,'2'),(15,'0-7428-6079',5,'0'),(16,'6079',5,'1'),(17,'0-7455-8803',5,'2'),(18,'0-7428-6072',6,'0'),(19,'6072',6,'1'),(20,'0-7455-8803',6,'2'),(21,'0-7428-6067',7,'0'),(22,'6067',7,'1'),(23,'0-7455-8803',7,'2');
/*!40000 ALTER TABLE `telephone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-26 19:29:11
