SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dta`
-- ----------------------------
DROP TABLE IF EXISTS `dta`;
CREATE TABLE `dta` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `account_owner` varchar(255) NOT NULL,
  `blz` varchar(255) NOT NULL,
  `konto` varchar(255) NOT NULL,
  `betrag` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `BIC` varchar(55) NOT NULL,
  `iban` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=289 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dta
-- ----------------------------
INSERT INTO `dta` VALUES ('30', '2014-02-15', 'max mustermann1', '61****00', '1*******8', '40', '1', 'G******X', 'DE7************78');
INSERT INTO `dta` VALUES ('31', '2014-02-15', 'max mustermann2', '76****85', '0******54', '40', '4', 'PB*****XX', 'DE*************54');
INSERT INTO `dta` VALUES ('32', '2014-02-15', 'max mustermann3', '60****10', '00*****7', '45', '2', 'S*******BN', 'DE*************57');
INSERT INTO `dta` VALUES ('33', '2014-02-15', 'max mustermann4', '53****00', '10*****67', '51', '5', 'H******AR', 'DE*************67');
INSERT INTO `dta` VALUES ('34', '2014-02-15', 'max mustermann5', '76****01', '00*****37', '55', '7', 'SS*****XX', 'DE*************37');
INSERT INTO `dta` VALUES ('35', '2014-02-15', 'max mustermann6', '78****76', '15******23', '40', '14', 'HY******80', 'DE*************23');
INSERT INTO `dta` VALUES ('36', '2014-02-15', 'max mustermann7', '100****00', '6******40', '25', '22', 'BE******XX', 'DE*************40');
