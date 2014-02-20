SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dta`
-- ----------------------------
DROP TABLE IF EXISTS `dta`;
CREATE TABLE `dta` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `account_owner` varchar(255) NOT NULL,
  `betrag` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `BIC` varchar(55) NOT NULL,
  `iban` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=289 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dta
-- ----------------------------
INSERT INTO `dta_copy` VALUES ('30', '2014-02-15', 'max mustermann1', '40', '1', 'G******X', 'DE7************78');
INSERT INTO `dta_copy` VALUES ('31', '2014-02-15', 'max mustermann2', '40', '4', 'PB*****XX', 'DE*************54');
INSERT INTO `dta_copy` VALUES ('32', '2014-02-15', 'max mustermann3', '45', '2', 'S*******BN', 'DE*************57');
INSERT INTO `dta_copy` VALUES ('33', '2014-02-15', 'max mustermann4', '51', '5', 'H******AR', 'DE*************67');
INSERT INTO `dta_copy` VALUES ('34', '2014-02-15', 'max mustermann5', '55', '7', 'SS*****XX', 'DE*************37');
INSERT INTO `dta_copy` VALUES ('35', '2014-02-15', 'max mustermann6', '40', '14', 'HY******80', 'DE*************23');
INSERT INTO `dta_copy` VALUES ('36', '2014-02-15', 'max mustermann7', '25', '22', 'BE******XX', 'DE*************40');
