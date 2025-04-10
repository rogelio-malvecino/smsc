-- MySQL dump 10.13  Distrib 5.1.58, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: everwing
-- ------------------------------------------------------
-- Server version	5.1.58

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
-- Current Database: `everwing`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `everwing` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `everwing`;

--
-- Table structure for table `cleansup`
--

DROP TABLE IF EXISTS `cleansup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cleansup` (
  `id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image_link` varchar(100) NOT NULL,
  `image_link2` varchar(100) NOT NULL,
  `image_link3` varchar(100) NOT NULL,
  `image_link4` varchar(1000) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`image_link`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cleansup`
--

LOCK TABLES `cleansup` WRITE;
/*!40000 ALTER TABLE `cleansup` DISABLE KEYS */;
INSERT INTO `cleansup` VALUES (1,'All Purpose Net Sponge','This is our best polishing/wiping rag, cotton, very absorbent, rag of choice for body shop & most polishing applications.','AllPurposeNetSponge.jpg','EasyHoldSponge.jpg','FloorPolishingPad.jpg','MultiPurposeSponge.jpg',20),(2,'All Purpose Rag','Description, description, description, description, description, description. ','AllPurposeRag.jpg','AllPurposeRag.jpg','AllPurposeRag.jpg','AllPurposeRag.jpg',32),(3,'Cotton Mop Medium','Description, description, description, description, description, description.','CottonMopMedium.jpg','CottonMopMedium.jpg','CottonMopMedium.jpg','CottonMopMedium.jpg',20),(4,'Double Purpose Pad','Description, description, description, description, description, description.','DoublePurposePad.jpg','DoublePurposePad.jpg','DoublePurposePad.jpg','DoublePurposePad.jpg',20),(5,'Easy Hold Sponge','Description, description, description, description, description, description.','EasyHoldSponge.jpg','EasyHoldSponge.jpg','EasyHoldSponge.jpg','EasyHoldSponge.jpg',20),(6,'Floor Polishing Pad','Description, description, description, description, description, description.','FloorPolishingPad.jpg','FloorPolishingPad.jpg','FloorPolishingPad.jpg','FloorPolishingPad.jpg',20),(7,'Heavy Duty Pad','Description, description, description, description, description, description.','HeavyDutyPad.jpg','HeavyDutyPad.jpg','HeavyDutyPad.jpg','HeavyDutyPad.jpg',20),(8,'Mop with Aluminum Handle','Description, description, description, description, description, description.','MopWithAluminumHandle.jpg','MopWithAluminumHandle.jpg','MopWithAluminumHandle.jpg','MiniMop.jpg',20),(9,'Multi Purpose Glove','Description, description, description, description, description, description.','MultiPurposeGlove.jpg','MultiPurposeGlove.jpg','MultiPurposeGlove.jpg','MultiPurposeGlove.jpg',20),(10,'Multi Purpose Sponge','Description, description, description, description, description, description.','MultiPurposeSponge.jpg','MultiPurposeSponge.jpg','MultiPurposeSponge.jpg','MultiPurposeSponge.jpg',20),(11,'Plastic Pot Cleaner','Description, description, description, description, description, description.','PlasticPotCleaner.jpg','PlasticPotCleaner.jpg','PlasticPotCleaner.jpg','PlasticPotCleaner.jpg',20),(12,'Scour Pad','Description, description, description, description, description, description.','ScourPad.jpg','ScourPad.jpg','ScourPad.jpg','ScourPad.jpg',20),(13,'ScrubSponge','Description, description, description, description, description, description.','ScrubSponge.jpg','ScrubSponge.jpg','ScrubSponge.jpg','ScrubSponge.jpg',20),(14,'Soft Scrub','Description, description, description, description, description, description.','SoftScrub.jpg','SoftScrub.jpg','SoftScrub.jpg','SoftScrub.jpg',20),(15,'Stainless Steel Cleaner','Description, description, description, description, description, description.','StainlessSteelCleaner.jpg','StainlessSteelCleaner.jpg','StainlessSteelCleaner.jpg','StainlessSteelCleaner.jpg',20),(16,'Steel Pot Cleaner','Description, description, description, description, description, description.','SteelPotCleaner.jpg','SteelPotCleaner.jpg','SteelPotCleaner.jpg','SteelPotCleaner.jpg',20),(17,'Super Absorbent Mop','Description, description, description, description, description, description.','SuperAbsorbentMop.jpg','SuperAbsorbentMop.jpg','SuperAbsorbentMop.jpg','SuperAbsorbentMop.jpg',20),(18,'Toilet Brush','Description, description, description, description, description, description.','ToiletBrush.jpg','ToiletBrush.jpg','ToiletBrush.jpg','ToiletBrush.jpg',20),(19,'Triple Pad','Description, description, description, description, description, description.','TriplePad.jpg','TriplePad.jpg','TriplePad.jpg','TriplePad.jpg',20);
/*!40000 ALTER TABLE `cleansup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuddles`
--

DROP TABLE IF EXISTS `cuddles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuddles` (
  `id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image_link` varchar(100) NOT NULL,
  `image_link2` varchar(100) NOT NULL,
  `image_link3` varchar(100) NOT NULL,
  `image_link4` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`image_link`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuddles`
--

LOCK TABLES `cuddles` WRITE;
/*!40000 ALTER TABLE `cuddles` DISABLE KEYS */;
INSERT INTO `cuddles` VALUES (1,'Cotton Buds','Description, description, description, description, description, description. ','CottonBuds.jpg','CottonBuds.jpg','CottonBuds.jpg','CottonBuds.jpg',21),(2,'Cotton Buds2','Description, description, description, description, description, description. ','CottonBuds2.jpg','CottonBuds2.jpg','CottonBuds2.jpg','CottonBuds2.jpg',21),(3,'Cotton Buds3','Description, description, description, description, description, description. ','CottonBuds3.jpg','CottonBuds3.jpg','CottonBuds3.jpg','CottonBuds3.jpg',21),(4,'Cotton Squares','Description, description, description, description, description, description. ','CottonSquares.jpg','CottonSquares.jpg','CottonSquares.jpg','CottonSquares.jpg',21),(5,'Dental Flossers','Description, description, description, description, description, description. ','DentalFlossers.jpg','DentalFlossers.jpg','DentalFlossers.jpg','CottonBuds3.jpg',21),(6,'Nipples Colored','Description, description, description, description, description, description. ','NipplesColored.jpg','NipplesColored.jpg','NipplesColored.jpg','NipplesColored.jpg',21),(7,'Nipples Transparent','Description, description, description, description, description, description. ','NipplesTransparent.jpg','NipplesTransparent.jpg','NipplesTransparent.jpg','cottonBuds7.jpg',21),(8,'Rubber Nipples','Description, description, description, description, description, description. ','RubberNipples.jpg','RubberNipples.jpg','RubberNipples.jpg','RubberNipples.jpg',21),(9,'Silicone Nipples','Description, description, description, description, description, description. ','SiliconeNipples.jpg','SiliconeNipples.jpg','SiliconeNipples.jpg','nipple.jpg',21),(10,'Soft White Tissues','Description, description, description, description, description, description. ','SoftWhiteTissues.jpg','SoftWhiteTissues.jpg','SoftWhiteTissues.jpg','SoftWhiteTissues.jpg',21);
/*!40000 ALTER TABLE `cuddles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koala`
--

DROP TABLE IF EXISTS `koala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koala` (
  `id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image_link` varchar(100) NOT NULL,
  `image_link2` varchar(100) NOT NULL,
  `image_link3` varchar(100) NOT NULL,
  `image_link4` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`image_link`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koala`
--

LOCK TABLES `koala` WRITE;
/*!40000 ALTER TABLE `koala` DISABLE KEYS */;
INSERT INTO `koala` VALUES (1,'Deodorizer','Description, description, description, description, description, description. ','Deodorizer.jpg','Deodorizer.jpg','deodorizer.jpg','Deodorizer.jpg',21),(2,'Mothballs','Description, description, description, description, description, description. ','Mothballs.jpg','Mothballs.jpg','Mothballs.jpg','Mothballs.jpg',21),(5,'Tablet Deodorizer','Description, description, description, description, description, description. ','TabletDeodorizer.jpg','TabletDeodorizer.jpg','TabletDeodorizer.jpg','TabletDeodorizer.jpg',21),(6,'Toilet Bowl Cleaner & Deodorizer','Description, description, description, description, description, description. ','ToiletBowlCleanerAndDeodorizer.jpg','ToiletBowlCleanerAndDeodorizer.jpg','ToiletBowlCleanerAndDeodorizer.jpg','ToiletBowlCleanerAndDeodorizer.jpg',21);
/*!40000 ALTER TABLE `koala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unclejohns`
--

DROP TABLE IF EXISTS `unclejohns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unclejohns` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image_link` varchar(100) NOT NULL,
  `image_link2` varchar(100) NOT NULL,
  `image_link3` varchar(100) NOT NULL,
  `image_link4` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`image_link`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unclejohns`
--

LOCK TABLES `unclejohns` WRITE;
/*!40000 ALTER TABLE `unclejohns` DISABLE KEYS */;
INSERT INTO `unclejohns` VALUES (1,'Barbeque Sticks','Description, description, description, description, description, description. ','BarbequeSticks.jpg','BarbequeSticks.jpg','BarbequeSticks.jpg','BarbequeSticks.jpg',20),(2,'Bending Straw','Description, description, description, description, description, description. ','BendingStraw.jpg','BendingStraw.jpg','BendingStraw.jpg','BendingStraw.jpg',20),(3,'Dental Flossers','Description, description, description, description, description, description. ','DentalFlossers.jpg','DentalFlossers.jpg','DentalFlossers.jpg','DentalFlossers.jpg',20),(4,'Disposable Plates','Description, description, description, description, description, description. ','DisposablePlates.jpg','DisposablePlates.jpg','DisposablePlates.jpg','DisposablePlates.jpg',20),(5,'Party Set','Description, description, description, description, description, description. ','PartySet.jpg','PartySet.jpg','PartySet.jpg','PartySet.jpg',20),(6,'Spice Container','Description, description, description, description, description, description. ','SpiceContainer.jpg','SpiceContainer.jpg','SpiceContainer.jpg','SpiceContainer.jpg',20),(7,'Sprayer','Description, description, description, description, description, description. ','Sprayer.jpg','Sprayer.jpg','Sprayer.jpg','Sprayer.jpg',20),(8,'Stirrer-Mini Spoon','Description, description, description, description, description, description. ','Stirrer-MiniSpoon.jpg','Stirrer-MiniSpoon.jpg','Stirrer-MiniSpoon.jpg','Stirrer-MiniSpoon.jpg',20),(9,'Toothpicks','Description, description, description, description, description, description. ','Toothpicks.jpg','Toothpicks.jpg','Toothpicks.jpg','Toothpick.jpg',20),(10,'Toothpicks with Container','Description, description, description, description, description, description. ','ToothpicksWithContainer.jpg','ToothpicksWithContainer.jpg','ToothpicksWithContainer.jpg','ToothpicksWithContainer.jpg',20),(11,'Transparent Fork','Description, description, description, description, description, description. ','TransparentFork.jpg','TransparentFork.jpg','TransparentFork.jpg','TransparentFork.jpg',20),(12,'Transparent Knife','Description, description, description, description, description, description. ','TransparentKnife.jpg','TransparentKnife.jpg','TransparentKnife.jpg','TransparentKnife.jpg',20),(13,'Transparent Spoon','Description, description, description, description, description, description. ','TransparentSpoon.jpg','TransparentSpoon.jpg','TransparentSpoon.jpg','TransparentSpoon.jpg',20),(14,'Transparent Spork','Description, description, description, description, description, description. ','TransparentSpork.jpg','TransparentSpork.jpg','TransparentSpork.jpg','TransparentSpork.jpg',20);
/*!40000 ALTER TABLE `unclejohns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wings`
--

DROP TABLE IF EXISTS `wings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wings` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image_link` varchar(100) NOT NULL,
  `image_link2` varchar(100) NOT NULL,
  `image_link3` varchar(100) NOT NULL,
  `image_link4` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`image_link`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wings`
--

LOCK TABLES `wings` WRITE;
/*!40000 ALTER TABLE `wings` DISABLE KEYS */;
INSERT INTO `wings` VALUES (1,'Clothes Clips','Description, description, description, description, description, description. ','ClothesClips.jpg','ClothesClips.jpg','ClothesClips.jpg','ClothesClips.jpg',21),(2,'Dipper Round','Description, description, description, description, description, description. ','DipperRound.jpg','DipperRound.jpg','DipperRound.jpg','DipperRound.jpg',21),(3,'Dipper Square','Description, description, description, description, description, description. ','DipperSquare.jpg','DipperSquare.jpg','DipperSquare.jpg','DipperSquare.jpg',21),(4,'Flyswatter','Description, description, description, description, description, description. ','Flyswatter.jpg','Flyswatter.jpg','Flyswatter.jpg','Flyswatter.jpg',21),(5,'Funnel','Description, description, description, description, description, description. ','Funnel.jpg','Funnel.jpg','Funnel.jpg','Funnel.jpg',21),(6,'Heavy Duty Hanger','Description, description, description, description, description, description. ','HeavyDutyHanger.jpg','HeavyDutyHanger.jpg','HeavyDutyHanger.jpg','HeavyDutyHanger.jpg',21),(7,'Indoor/Outdoor Hanger','Description, description, description, description, description, description. ','IndoorOutdoorHanger.jpg','IndoorOutdoorHanger.jpg','IndoorOutdoorHanger.jpg','HangerLong.jpg',21),(8,'Long Hanger','Description, description, description, description, description, description. ','LongHanger.jpg','LongHanger.jpg','LongHanger.jpg','LongHanger.jpg',21),(9,'Multi Purpose Hanger','Description, description, description, description, description, description. ','MultiPurposeHanger.jpg','MultiPurposeHanger.jpg','MultiPurposeHanger.jpg','MattScissors.jpg',21),(10,'Plastic Pail','Description, description, description, description, description, description. ','PlasticPail.jpg','PlasticPail.jpg','PlasticPail.jpg','PlasticPail.jpg',21),(11,'Shoe Hanger','Description, description, description, description, description, description. ','ShoeHanger.jpg','ShoeHanger.jpg','ShoeHanger.jpg','ShoeHanger.jpg',21),(12,'Soap Case Tray','Description, description, description, description, description, description. ','SoapCaseTray.jpg','SoapCaseTray.jpg','SoapCaseTray.jpg','SoapCaseTray.jpg',21),(13,'Sprayer','Description, description, description, description, description, description. ','Sprayer.jpg','Sprayer.jpg','Sprayer.jpg','Sprayer.jpg',21),(14,'Waste Basket','Description, description, description, description, description, description. ','WasteBasket.jpg','WasteBasket.jpg','WasteBasket.jpg','WasteBasket.jpg',21);
/*!40000 ALTER TABLE `wings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-09-30 15:22:36
