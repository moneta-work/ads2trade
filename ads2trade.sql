/*
JOSH WAS HERE
Navicat MySQL Data Transfer

Source Server         : ads2trade
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : ads2trade

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-07-22 18:07:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `addtional_charges_type`
-- ----------------------------
DROP TABLE IF EXISTS `addtional_charges_type`;
CREATE TABLE `addtional_charges_type` (
  `adct_id` smallint(6) NOT NULL,
  `adct_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`adct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of addtional_charges_type
-- ----------------------------

-- ----------------------------
-- Table structure for `asset`
-- ----------------------------
DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset` (
  `ass_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ast_id` smallint(6) DEFAULT NULL COMMENT 'FK: asset_type',
  `ass_description` varchar(255) DEFAULT NULL,
  `emp_id_maintenance` smallint(6) DEFAULT NULL,
  `ass_disposed_of` tinyint(4) DEFAULT NULL,
  `ass_acquisition_cost` float DEFAULT NULL,
  `ass_book_value` float DEFAULT NULL,
  `ass_printable_height` float DEFAULT NULL,
  `ass_proportional_costs` tinyint(4) DEFAULT NULL,
  `ass_printable_width` float DEFAULT NULL,
  `ass_production_cost_BCY` float DEFAULT NULL,
  `ass_production_price_SCY` float DEFAULT NULL,
  `mat_id` smallint(6) DEFAULT NULL,
  `loc_id` smallint(6) DEFAULT NULL,
  `med_id` smallint(6) DEFAULT NULL,
  `met_id` smallint(6) DEFAULT NULL,
  `ass_lead_time` decimal(9,3) DEFAULT NULL,
  `meu_id_lead_time` smallint(6) DEFAULT NULL,
  `ass_production_requirements` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ass_id`),
  KEY `ast_id_idx` (`ast_id`),
  KEY `mat_id_idx` (`mat_id`),
  KEY `med_id_idx` (`med_id`),
  KEY `met_id_idx` (`met_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of asset
-- ----------------------------

-- ----------------------------
-- Table structure for `asset_accounts_receivable`
-- ----------------------------
DROP TABLE IF EXISTS `asset_accounts_receivable`;
CREATE TABLE `asset_accounts_receivable` (
  `aar_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `aar_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of asset_accounts_receivable
-- ----------------------------

-- ----------------------------
-- Table structure for `asset_category`
-- ----------------------------
DROP TABLE IF EXISTS `asset_category`;
CREATE TABLE `asset_category` (
  `asc_id` smallint(6) NOT NULL,
  `asc_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`asc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of asset_category
-- ----------------------------

-- ----------------------------
-- Table structure for `asset_color`
-- ----------------------------
DROP TABLE IF EXISTS `asset_color`;
CREATE TABLE `asset_color` (
  `asc_id` smallint(6) NOT NULL AUTO_INCREMENT,
  ` asc_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`asc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of asset_color
-- ----------------------------

-- ----------------------------
-- Table structure for `asset_type`
-- ----------------------------
DROP TABLE IF EXISTS `asset_type`;
CREATE TABLE `asset_type` (
  `ast_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ast_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ast_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of asset_type
-- ----------------------------
INSERT INTO `asset_type` VALUES ('1', 'bins');
INSERT INTO `asset_type` VALUES ('2', 'street pole');
INSERT INTO `asset_type` VALUES ('3', 'billboards');

-- ----------------------------
-- Table structure for `auction`
-- ----------------------------
DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction` (
  `auc_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `auc_minimum_bid_amount` float DEFAULT NULL,
  `auc_maximum_bid_amount` float DEFAULT NULL,
  `auc_status` tinyint(4) DEFAULT NULL,
  `auc_start_date` datetime DEFAULT NULL,
  `auc_end_date` datetime DEFAULT NULL,
  `auc_increment` decimal(9,3) DEFAULT NULL,
  `ass_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`auc_id`),
  KEY `ass_id_idx` (`ass_id`),
  CONSTRAINT `ass_id` FOREIGN KEY (`ass_id`) REFERENCES `asset` (`ass_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of auction
-- ----------------------------

-- ----------------------------
-- Table structure for `bidder`
-- ----------------------------
DROP TABLE IF EXISTS `bidder`;
CREATE TABLE `bidder` (
  `bdd_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `bid_id` smallint(6) DEFAULT NULL,
  `bls_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`bdd_id`),
  KEY `bls_id_idx` (`bls_id`),
  KEY `bid_id_idx` (`bid_id`),
  CONSTRAINT `bid_id` FOREIGN KEY (`bid_id`) REFERENCES `bid` (`bid_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `bls_id` FOREIGN KEY (`bls_id`) REFERENCES `blocked_status` (`bls_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bidder
-- ----------------------------

-- ----------------------------
-- Table structure for `billing_category`
-- ----------------------------
DROP TABLE IF EXISTS `billing_category`;
CREATE TABLE `billing_category` (
  `bil_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `bil_description` varchar(45) DEFAULT NULL COMMENT 'values: prime/non prime',
  PRIMARY KEY (`bil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of billing_category
-- ----------------------------

-- ----------------------------
-- Table structure for `billing_status`
-- ----------------------------
DROP TABLE IF EXISTS `billing_status`;
CREATE TABLE `billing_status` (
  `bis_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `bis_start_date` datetime DEFAULT NULL,
  `bis_end_date` datetime DEFAULT NULL,
  `bil_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`bis_id`),
  KEY `bil_id_idx` (`bil_id`),
  CONSTRAINT `bil_id` FOREIGN KEY (`bil_id`) REFERENCES `billing_category` (`bil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of billing_status
-- ----------------------------

-- ----------------------------
-- Table structure for `blocked_status`
-- ----------------------------
DROP TABLE IF EXISTS `blocked_status`;
CREATE TABLE `blocked_status` (
  `bls_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `bls_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of blocked_status
-- ----------------------------

-- ----------------------------
-- Table structure for `booking_status`
-- ----------------------------
DROP TABLE IF EXISTS `booking_status`;
CREATE TABLE `booking_status` (
  `bos_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `bos_code` varchar(255) DEFAULT NULL,
  `bos_authorization_required` tinyint(4) DEFAULT NULL,
  `bos_update_authorization` tinyint(4) DEFAULT NULL,
  `bst_id` smallint(6) DEFAULT NULL COMMENT 'FK : booking_status_type',
  `bos_form_editable` tinyint(4) DEFAULT NULL,
  `bos_import_code` varchar(255) DEFAULT NULL,
  `bos_validate_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`bos_id`),
  KEY `bst_id_idx` (`bst_id`),
  CONSTRAINT `bst_id` FOREIGN KEY (`bst_id`) REFERENCES `booking_status_type` (`bst_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of booking_status
-- ----------------------------

-- ----------------------------
-- Table structure for `booking_status_type`
-- ----------------------------
DROP TABLE IF EXISTS `booking_status_type`;
CREATE TABLE `booking_status_type` (
  `bst_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `bst_description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`bst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of booking_status_type
-- ----------------------------

-- ----------------------------
-- Table structure for `campaign`
-- ----------------------------
DROP TABLE IF EXISTS `campaign`;
CREATE TABLE `campaign` (
  `cam_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cam_requested_start_date` datetime DEFAULT NULL,
  `cam_requested_end_date` datetime DEFAULT NULL,
  `cam_title` varchar(255) DEFAULT NULL,
  `cam_budget` float DEFAULT NULL,
  `cam_requested_response_date` datetime DEFAULT NULL,
  `cam_description` varchar(1000) DEFAULT NULL,
  `adv_id` smallint(6) DEFAULT NULL,
  `cas_id` smallint(6) DEFAULT NULL COMMENT 'FK to the campaign status table',
  `cam_number` varchar(255) DEFAULT NULL,
  `cab_id` smallint(6) DEFAULT NULL COMMENT 'FK to the campaign budget table',
  `cam_order_number` int(11) DEFAULT NULL,
  `cur_id` smallint(6) DEFAULT NULL,
  `cam_risk_limit` float DEFAULT NULL,
  `cam_current_risk` float DEFAULT NULL,
  `cst_id` smallint(6) DEFAULT NULL COMMENT 'FK: campaign_source_type',
  `cam_partial_availability_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`cam_id`),
  KEY `adv_id_idx` (`adv_id`),
  KEY `cab_id_idx` (`cab_id`),
  KEY `cst_id_idx` (`cst_id`),
  KEY `cas_id_idx` (`cas_id`),
  KEY `cur_id_idx` (`cur_id`),
  CONSTRAINT `adv_id` FOREIGN KEY (`adv_id`) REFERENCES `advertiser` (`adv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cab_id` FOREIGN KEY (`cab_id`) REFERENCES `campaign_budget` (`cab_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cas_id` FOREIGN KEY (`cas_id`) REFERENCES `campaign_status` (`cas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cst_id` FOREIGN KEY (`cst_id`) REFERENCES `campaign_source_type` (`cst_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cur_id` FOREIGN KEY (`cur_id`) REFERENCES `currency` (`cur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of campaign
-- ----------------------------

-- ----------------------------
-- Table structure for `campaign_budget_date`
-- ----------------------------
DROP TABLE IF EXISTS `campaign_budget_date`;
CREATE TABLE `campaign_budget_date` (
  `cbd_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cbd_start_date` datetime DEFAULT NULL,
  `cbd_end_date` datetime DEFAULT NULL,
  `cbd_quantity` int(11) DEFAULT NULL,
  `cbd_rate_per_unit` float DEFAULT NULL,
  `cbd_rate_card_rate` float DEFAULT NULL,
  `cbd_commision` float DEFAULT NULL,
  `cbd_VAT` float DEFAULT NULL,
  PRIMARY KEY (`cbd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of campaign_budget_date
-- ----------------------------

-- ----------------------------
-- Table structure for `campaign_budget_type`
-- ----------------------------
DROP TABLE IF EXISTS `campaign_budget_type`;
CREATE TABLE `campaign_budget_type` (
  `cat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cat_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of campaign_budget_type
-- ----------------------------

-- ----------------------------
-- Table structure for `campaign_locations`
-- ----------------------------
DROP TABLE IF EXISTS `campaign_locations`;
CREATE TABLE `campaign_locations` (
  `cal_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cam_id` smallint(6) DEFAULT NULL,
  `cal_lattitude` varchar(255) DEFAULT NULL,
  `cal_longitude` varchar(255) DEFAULT NULL,
  `cal_GPS1` varchar(255) DEFAULT NULL,
  `cal_GPS2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of campaign_locations
-- ----------------------------

-- ----------------------------
-- Table structure for `campaign_source_type`
-- ----------------------------
DROP TABLE IF EXISTS `campaign_source_type`;
CREATE TABLE `campaign_source_type` (
  `cst_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cst_description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`cst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of campaign_source_type
-- ----------------------------

-- ----------------------------
-- Table structure for `campaign_status`
-- ----------------------------
DROP TABLE IF EXISTS `campaign_status`;
CREATE TABLE `campaign_status` (
  `cas_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cst_id` smallint(6) DEFAULT NULL COMMENT 'FK: campaign_source_type',
  `cas_description` varchar(255) DEFAULT NULL,
  `dot_id` smallint(6) DEFAULT NULL COMMENT 'FK : pdocument_type',
  `cas_code` varchar(255) DEFAULT NULL,
  `cas_authorization` tinyint(4) DEFAULT NULL,
  `cas_update_authorization` tinyint(4) DEFAULT NULL,
  `cas_form_editable` tinyint(4) DEFAULT NULL,
  `cas_import_coce` varchar(255) DEFAULT NULL,
  `cas_validate_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`cas_id`),
  KEY `dot_id_idx` (`dot_id`),
  CONSTRAINT `dot_id` FOREIGN KEY (`dot_id`) REFERENCES `document_type` (`dot_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of campaign_status
-- ----------------------------

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `is_logged_in` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------

-- ----------------------------
-- Table structure for `comment_sheet`
-- ----------------------------
DROP TABLE IF EXISTS `comment_sheet`;
CREATE TABLE `comment_sheet` (
  `com_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `com_date` datetime DEFAULT NULL,
  `com_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comment_sheet
-- ----------------------------

-- ----------------------------
-- Table structure for `commission`
-- ----------------------------
DROP TABLE IF EXISTS `commission`;
CREATE TABLE `commission` (
  `comm_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `comt_id` smallint(6) DEFAULT NULL,
  `comm_percentage` decimal(3,3) DEFAULT NULL,
  PRIMARY KEY (`comm_id`),
  KEY `comt_id_idx` (`comt_id`),
  CONSTRAINT `comt_id` FOREIGN KEY (`comt_id`) REFERENCES `commission_type` (`comt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of commission
-- ----------------------------

-- ----------------------------
-- Table structure for `commission_type`
-- ----------------------------
DROP TABLE IF EXISTS `commission_type`;
CREATE TABLE `commission_type` (
  `comt_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `commt_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`comt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of commission_type
-- ----------------------------

-- ----------------------------
-- Table structure for `contact_address_format`
-- ----------------------------
DROP TABLE IF EXISTS `contact_address_format`;
CREATE TABLE `contact_address_format` (
  `caf_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `caf_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`caf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contact_address_format
-- ----------------------------

-- ----------------------------
-- Table structure for `contract`
-- ----------------------------
DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract` (
  `con_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `con_date` datetime DEFAULT NULL,
  `cnt_id` smallint(6) DEFAULT NULL,
  `ope_id` smallint(6) DEFAULT NULL,
  `contractcol` varchar(45) DEFAULT NULL,
  `cam_id` smallint(6) DEFAULT NULL,
  `con_start_date` datetime DEFAULT NULL,
  `con_end_date` datetime DEFAULT NULL,
  `con_notes` varchar(4005) DEFAULT NULL,
  `use_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `cnt_id_idx` (`cnt_id`),
  KEY `ope_id_idx` (`ope_id`),
  KEY `cam_id_idx` (`cam_id`),
  KEY `use_id_idx` (`use_id`),
  CONSTRAINT `cam_id` FOREIGN KEY (`cam_id`) REFERENCES `campaign` (`cam_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cnt_id` FOREIGN KEY (`cnt_id`) REFERENCES `contract_type` (`cnt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ope_id` FOREIGN KEY (`ope_id`) REFERENCES `operator` (`ope_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `use_id` FOREIGN KEY (`use_id`) REFERENCES `ads2trade_user` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contract
-- ----------------------------

-- ----------------------------
-- Table structure for `contract_type`
-- ----------------------------
DROP TABLE IF EXISTS `contract_type`;
CREATE TABLE `contract_type` (
  `cnt_id` smallint(6) NOT NULL,
  `cnt_description` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`cnt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contract_type
-- ----------------------------

-- ----------------------------
-- Table structure for `country`
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `cou_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cou_name` varchar(255) DEFAULT NULL,
  `adf_id` smallint(6) DEFAULT NULL COMMENT 'FK: address_format',
  `cou_zip_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`cou_id`),
  KEY `adf_id_idx` (`adf_id`),
  CONSTRAINT `adf_id` FOREIGN KEY (`adf_id`) REFERENCES `country_address_format` (`adf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'South Africa', '1', '277');

-- ----------------------------
-- Table structure for `country_address_format`
-- ----------------------------
DROP TABLE IF EXISTS `country_address_format`;
CREATE TABLE `country_address_format` (
  `adf_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `adr_address_format` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of country_address_format
-- ----------------------------
INSERT INTO `country_address_format` VALUES ('1', 'country, region, city, surbub, plot number, street');

-- ----------------------------
-- Table structure for `currency`
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `cur_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cur_code` varchar(255) DEFAULT NULL,
  `cur_description` varchar(255) DEFAULT NULL,
  `cur_EMU` tinyint(4) DEFAULT NULL,
  `cur_rounding_precision` float DEFAULT NULL,
  `cur_decimal_places` int(11) DEFAULT NULL,
  `cur_invoice_rounding_precision` float DEFAULT NULL,
  `cur_unit_rounding_precision` float DEFAULT NULL,
  `cur_unit_decimal_places` float DEFAULT NULL,
  `cur_application_rounding_precision` float DEFAULT NULL,
  `cur_date_adjusted` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of currency
-- ----------------------------

-- ----------------------------
-- Table structure for `customer_group`
-- ----------------------------
DROP TABLE IF EXISTS `customer_group`;
CREATE TABLE `customer_group` (
  `cus_group_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cus_group_name` varchar(255) DEFAULT NULL,
  `cus_GCP_id` tinyint(4) DEFAULT NULL,
  `time_type_id` tinyint(4) DEFAULT NULL,
  `pay_id` tinyint(4) DEFAULT NULL,
  `cus_group_customer` varchar(255) DEFAULT NULL,
  `cus_holding_company` varchar(255) DEFAULT NULL,
  `cur_id` tinyint(4) DEFAULT NULL,
  `cou_id` varchar(255) DEFAULT NULL,
  `cus_group_name2` varchar(255) DEFAULT NULL,
  `cus_legal_entity_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cus_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_group
-- ----------------------------

-- ----------------------------
-- Table structure for `district`
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `dis_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lot_id` smallint(6) DEFAULT NULL,
  `dis_description` varchar(255) DEFAULT NULL,
  `dis_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of district
-- ----------------------------

-- ----------------------------
-- Table structure for `document_status`
-- ----------------------------
DROP TABLE IF EXISTS `document_status`;
CREATE TABLE `document_status` (
  `dos_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `dos_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of document_status
-- ----------------------------

-- ----------------------------
-- Table structure for `document_type`
-- ----------------------------
DROP TABLE IF EXISTS `document_type`;
CREATE TABLE `document_type` (
  `dot_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `dot_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of document_type
-- ----------------------------

-- ----------------------------
-- Table structure for `employee`
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `emp_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `emt_id` smallint(6) DEFAULT NULL COMMENT 'FK: employee_type',
  `emp_first_name` varchar(255) DEFAULT NULL,
  `emp_surname` varchar(255) DEFAULT NULL,
  `jot_id` smallint(6) DEFAULT NULL COMMENT 'FK: job_type',
  `emp_tel_code` int(11) DEFAULT NULL,
  `emp_tel` int(11) DEFAULT NULL,
  `emp_cell_code` int(11) DEFAULT NULL,
  `emp_cell` int(11) DEFAULT NULL,
  `emp_comment` varchar(255) DEFAULT NULL,
  `cnd_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `emt_id_idx` (`emt_id`),
  KEY `jot_id_idx` (`jot_id`),
  KEY `cnd_id_idx` (`cnd_id`),
  CONSTRAINT `cnd_id` FOREIGN KEY (`cnd_id`) REFERENCES `contact_details` (`cnd_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `emt_id` FOREIGN KEY (`emt_id`) REFERENCES `employee_type` (`emt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `jot_id` FOREIGN KEY (`jot_id`) REFERENCES `job_title` (`jot_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_type`
-- ----------------------------
DROP TABLE IF EXISTS `employee_type`;
CREATE TABLE `employee_type` (
  `emt_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `emt_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`emt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_type
-- ----------------------------

-- ----------------------------
-- Table structure for `face`
-- ----------------------------
DROP TABLE IF EXISTS `face`;
CREATE TABLE `face` (
  `fac_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `fac_description` varchar(255) DEFAULT NULL,
  `fac_number` int(11) DEFAULT NULL,
  `fac_reference_number` varchar(255) DEFAULT NULL,
  `fac_name` varchar(255) DEFAULT NULL,
  `inv_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of face
-- ----------------------------

-- ----------------------------
-- Table structure for `inventory_status`
-- ----------------------------
DROP TABLE IF EXISTS `inventory_status`;
CREATE TABLE `inventory_status` (
  `ins_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ins_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ins_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inventory_status
-- ----------------------------

-- ----------------------------
-- Table structure for `job_title`
-- ----------------------------
DROP TABLE IF EXISTS `job_title`;
CREATE TABLE `job_title` (
  `jot_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `jot_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`jot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job_title
-- ----------------------------

-- ----------------------------
-- Table structure for `lms_user`
-- ----------------------------
DROP TABLE IF EXISTS `lms_user`;
CREATE TABLE `lms_user` (
  `use_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `use_password` varchar(32) NOT NULL,
  `ust_id` smallint(5) unsigned NOT NULL DEFAULT '5',
  `use_username` varchar(45) NOT NULL,
  `use_status` tinyint(4) NOT NULL DEFAULT '1',
  `pem_id` smallint(5) unsigned DEFAULT NULL,
  `use_registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `use_date_updated` datetime DEFAULT NULL,
  `use_date_deleted` datetime DEFAULT NULL,
  `use_first_name` varchar(35) DEFAULT NULL,
  `use_last_name` varchar(35) DEFAULT NULL,
  `use_email` varchar(50) DEFAULT NULL,
  `use_photo` varchar(200) NOT NULL,
  PRIMARY KEY (`use_id`),
  KEY `per_id_idx` (`pem_id`),
  KEY `ust_id_idx` (`ust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lms_user
-- ----------------------------

-- ----------------------------
-- Table structure for `location_costing`
-- ----------------------------
DROP TABLE IF EXISTS `location_costing`;
CREATE TABLE `location_costing` (
  `lcc_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `wor_id` smallint(6) DEFAULT NULL COMMENT 'FK: work_type',
  `meu_id` smallint(6) DEFAULT NULL,
  `lcc_quantity` int(11) DEFAULT NULL,
  `lcc_unit_price_SCY` float DEFAULT NULL,
  `lcc_total_price_SCY` float DEFAULT NULL,
  `lcc_total_billed_SCY` float DEFAULT NULL,
  `lcc_billable_percentage` float DEFAULT NULL,
  `lcc_unit_cost_BCY` float DEFAULT NULL,
  `lcc_total_cost_BCY` float DEFAULT NULL,
  `lcc_total_invoiced` float DEFAULT NULL,
  PRIMARY KEY (`lcc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_costing
-- ----------------------------

-- ----------------------------
-- Table structure for `location_direction`
-- ----------------------------
DROP TABLE IF EXISTS `location_direction`;
CREATE TABLE `location_direction` (
  `ldi_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ldi_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ldi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_direction
-- ----------------------------

-- ----------------------------
-- Table structure for `location_gender`
-- ----------------------------
DROP TABLE IF EXISTS `location_gender`;
CREATE TABLE `location_gender` (
  `log_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `log_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_gender
-- ----------------------------

-- ----------------------------
-- Table structure for `location_group`
-- ----------------------------
DROP TABLE IF EXISTS `location_group`;
CREATE TABLE `location_group` (
  `lgr_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lgr_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lgr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_group
-- ----------------------------

-- ----------------------------
-- Table structure for `location_owner_type`
-- ----------------------------
DROP TABLE IF EXISTS `location_owner_type`;
CREATE TABLE `location_owner_type` (
  `lwt_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lwt_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lwt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_owner_type
-- ----------------------------

-- ----------------------------
-- Table structure for `location_photo_type`
-- ----------------------------
DROP TABLE IF EXISTS `location_photo_type`;
CREATE TABLE `location_photo_type` (
  `lpt_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lpt_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lpt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_photo_type
-- ----------------------------

-- ----------------------------
-- Table structure for `location_position`
-- ----------------------------
DROP TABLE IF EXISTS `location_position`;
CREATE TABLE `location_position` (
  `lop_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `met_id` smallint(6) DEFAULT NULL,
  `lop_description` varchar(255) DEFAULT NULL,
  `lop_media_description` varchar(255) DEFAULT NULL,
  `lop_risk_calculation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`lop_id`),
  KEY `met_id_idx` (`met_id`),
  CONSTRAINT `met_id` FOREIGN KEY (`met_id`) REFERENCES `medium_type` (`met_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_position
-- ----------------------------

-- ----------------------------
-- Table structure for `location_rating`
-- ----------------------------
DROP TABLE IF EXISTS `location_rating`;
CREATE TABLE `location_rating` (
  `lor_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lor_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_rating
-- ----------------------------

-- ----------------------------
-- Table structure for `location_road_orientation`
-- ----------------------------
DROP TABLE IF EXISTS `location_road_orientation`;
CREATE TABLE `location_road_orientation` (
  `lro_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lro_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_road_orientation
-- ----------------------------

-- ----------------------------
-- Table structure for `location_status`
-- ----------------------------
DROP TABLE IF EXISTS `location_status`;
CREATE TABLE `location_status` (
  `lss_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lss_description` varchar(255) DEFAULT NULL,
  `lss_voided` tinyint(4) DEFAULT NULL,
  `lss_start_date` datetime DEFAULT NULL,
  `lss_end_date` datetime DEFAULT NULL,
  `lsd_id` smallint(6) DEFAULT NULL COMMENT 'FK: location_status_document',
  PRIMARY KEY (`lss_id`),
  KEY `lsd_id_idx` (`lsd_id`),
  CONSTRAINT `lsd_id` FOREIGN KEY (`lsd_id`) REFERENCES `location_status_document` (`lsd_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_status
-- ----------------------------

-- ----------------------------
-- Table structure for `location_status_document`
-- ----------------------------
DROP TABLE IF EXISTS `location_status_document`;
CREATE TABLE `location_status_document` (
  `lsd_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lsd_url` varchar(255) DEFAULT NULL,
  `lsd_number` varchar(255) DEFAULT NULL,
  `lsd_version` varchar(255) DEFAULT NULL,
  `dos_id` smallint(6) DEFAULT NULL COMMENT 'FK: document_status',
  `lsd_description` varchar(255) DEFAULT NULL,
  `lsd_creator` smallint(6) DEFAULT NULL,
  `lsd_creation_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`lsd_id`),
  KEY `dos_id_idx` (`dos_id`),
  CONSTRAINT `dos_id` FOREIGN KEY (`dos_id`) REFERENCES `document_status` (`dos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_status_document
-- ----------------------------

-- ----------------------------
-- Table structure for `location_type`
-- ----------------------------
DROP TABLE IF EXISTS `location_type`;
CREATE TABLE `location_type` (
  `lot_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lot_description` varchar(255) DEFAULT NULL,
  `mec_id` smallint(6) DEFAULT NULL COMMENT 'FK: madia_category',
  `lot_description2` varchar(255) DEFAULT NULL,
  `lot_telmar_code` varchar(255) DEFAULT NULL,
  `lot_medium_link` tinyint(4) DEFAULT NULL,
  `lot_base_rate` float DEFAULT NULL,
  PRIMARY KEY (`lot_id`),
  KEY `mec_id_idx` (`mec_id`),
  CONSTRAINT `mec_id` FOREIGN KEY (`mec_id`) REFERENCES `media_category` (`mec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_type
-- ----------------------------
INSERT INTO `location_type` VALUES ('1', 'suburb', null, null, null, null, null);

-- ----------------------------
-- Table structure for `markers`
-- ----------------------------
DROP TABLE IF EXISTS `markers`;
CREATE TABLE `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of markers
-- ----------------------------

-- ----------------------------
-- Table structure for `market_type`
-- ----------------------------
DROP TABLE IF EXISTS `market_type`;
CREATE TABLE `market_type` (
  `mat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `mat_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of market_type
-- ----------------------------

-- ----------------------------
-- Table structure for `master_medium_type`
-- ----------------------------
DROP TABLE IF EXISTS `master_medium_type`;
CREATE TABLE `master_medium_type` (
  `mam_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `met_description` varchar(255) DEFAULT NULL,
  `met_sequence` varchar(255) DEFAULT NULL,
  `met_auto_editions` tinyint(4) DEFAULT NULL,
  `met_editions_mandatory` tinyint(4) DEFAULT NULL,
  `mef_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mam_id`),
  KEY `mef_id_idx` (`mef_id`),
  CONSTRAINT `mef_id` FOREIGN KEY (`mef_id`) REFERENCES `media_family` (`mef_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_medium_type
-- ----------------------------

-- ----------------------------
-- Table structure for `measurement_unit`
-- ----------------------------
DROP TABLE IF EXISTS `measurement_unit`;
CREATE TABLE `measurement_unit` (
  `meu_id` smallint(6) NOT NULL AUTO_INCREMENT,
  ` meu_description` varchar(255) DEFAULT NULL,
  `meu_code` varchar(255) DEFAULT NULL,
  `meu_unit` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`meu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of measurement_unit
-- ----------------------------

-- ----------------------------
-- Table structure for `media_category`
-- ----------------------------
DROP TABLE IF EXISTS `media_category`;
CREATE TABLE `media_category` (
  `mec_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `mec_description` varchar(255) DEFAULT NULL,
  `mam_id` smallint(6) DEFAULT NULL,
  `mec_tearsheet_printing` tinyint(4) DEFAULT NULL,
  `mec_editions_mandatory` tinyint(4) DEFAULT NULL,
  `mec_contractor` tinyint(4) DEFAULT NULL,
  `mec_time_dependant` tinyint(4) DEFAULT NULL,
  `mec_height_dependant` tinyint(4) DEFAULT NULL,
  `mec_site_dependant` tinyint(4) DEFAULT NULL,
  `mec_interval_billing` tinyint(4) DEFAULT NULL,
  `mec_base_rate` float DEFAULT NULL,
  `mec_rate_card_nett` tinyint(4) DEFAULT NULL,
  `rlm_id` smallint(6) DEFAULT NULL,
  `mec_export_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mec_id`),
  KEY `mam_id_idx` (`mam_id`),
  CONSTRAINT `mam_id` FOREIGN KEY (`mam_id`) REFERENCES `master_medium_type` (`mam_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of media_category
-- ----------------------------

-- ----------------------------
-- Table structure for `media_family`
-- ----------------------------
DROP TABLE IF EXISTS `media_family`;
CREATE TABLE `media_family` (
  `mef_id` smallint(6) NOT NULL,
  `mef_description` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mef_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of media_family
-- ----------------------------

-- ----------------------------
-- Table structure for `operator_status`
-- ----------------------------
DROP TABLE IF EXISTS `operator_status`;
CREATE TABLE `operator_status` (
  `ops_status_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ops_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ops_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of operator_status
-- ----------------------------

-- ----------------------------
-- Table structure for `owner_status`
-- ----------------------------
DROP TABLE IF EXISTS `owner_status`;
CREATE TABLE `owner_status` (
  `ows_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ows_description` varchar(255) DEFAULT NULL,
  `ows_authorization` tinyint(4) DEFAULT NULL,
  `ows_update_authorization` tinyint(4) DEFAULT NULL,
  `ost_id` smallint(6) DEFAULT NULL COMMENT 'FK: owner_status_type',
  `ows_import_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ows_id`),
  KEY `ost_id_idx` (`ost_id`),
  CONSTRAINT `ost_id` FOREIGN KEY (`ost_id`) REFERENCES `owner_status_type` (`ost_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of owner_status
-- ----------------------------

-- ----------------------------
-- Table structure for `owner_status_type`
-- ----------------------------
DROP TABLE IF EXISTS `owner_status_type`;
CREATE TABLE `owner_status_type` (
  `ost_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ost_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of owner_status_type
-- ----------------------------

-- ----------------------------
-- Table structure for `payment_agreement`
-- ----------------------------
DROP TABLE IF EXISTS `payment_agreement`;
CREATE TABLE `payment_agreement` (
  `pay_id` tinyint(4) DEFAULT NULL,
  `pay_code` varchar(255) DEFAULT NULL,
  `pay_description` varchar(255) DEFAULT NULL,
  `bal_account_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_agreement
-- ----------------------------

-- ----------------------------
-- Table structure for `payment_method`
-- ----------------------------
DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
  `pam_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pam_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_method
-- ----------------------------

-- ----------------------------
-- Table structure for `proposal_number_specification`
-- ----------------------------
DROP TABLE IF EXISTS `proposal_number_specification`;
CREATE TABLE `proposal_number_specification` (
  `pns_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pns_starting_date` date DEFAULT NULL,
  `pns_last_date_used` date DEFAULT NULL,
  `pns_starting_number` varchar(255) DEFAULT NULL,
  `pns_ending_number` varchar(255) DEFAULT NULL,
  `pns_warning_number` varchar(255) DEFAULT NULL,
  `pns_increment_number` int(11) DEFAULT NULL,
  `pns_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pns_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proposal_number_specification
-- ----------------------------

-- ----------------------------
-- Table structure for `proposal_status`
-- ----------------------------
DROP TABLE IF EXISTS `proposal_status`;
CREATE TABLE `proposal_status` (
  `pro_status_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prs_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pro_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proposal_status
-- ----------------------------

-- ----------------------------
-- Table structure for `proposal_type`
-- ----------------------------
DROP TABLE IF EXISTS `proposal_type`;
CREATE TABLE `proposal_type` (
  `prt_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prt_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`prt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proposal_type
-- ----------------------------

-- ----------------------------
-- Table structure for `province`
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province` (
  `pro_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(255) DEFAULT NULL,
  `cou_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `cou_id_idx` (`cou_id`),
  CONSTRAINT `cou_id` FOREIGN KEY (`cou_id`) REFERENCES `country` (`cou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES ('3', 'Gauteng', '1');
INSERT INTO `province` VALUES ('4', 'KwaZulu-Natal', '1');
INSERT INTO `province` VALUES ('5', 'Limpopo', '1');
INSERT INTO `province` VALUES ('6', 'Mpumalanga', '1');
INSERT INTO `province` VALUES ('7', 'North West', '1');
INSERT INTO `province` VALUES ('8', 'Northern Cape', '1');
INSERT INTO `province` VALUES ('9', 'Western Cape', '1');

-- ----------------------------
-- Table structure for `rate_card_loading_method`
-- ----------------------------
DROP TABLE IF EXISTS `rate_card_loading_method`;
CREATE TABLE `rate_card_loading_method` (
  `rlm_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `rlm_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rlm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rate_card_loading_method
-- ----------------------------

-- ----------------------------
-- Table structure for `rate_card_status`
-- ----------------------------
DROP TABLE IF EXISTS `rate_card_status`;
CREATE TABLE `rate_card_status` (
  `ras_id` smallint(6) NOT NULL,
  `ras_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ras_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rate_card_status
-- ----------------------------

-- ----------------------------
-- Table structure for `responsibility_center`
-- ----------------------------
DROP TABLE IF EXISTS `responsibility_center`;
CREATE TABLE `responsibility_center` (
  `rec_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `rec_name` varchar(255) DEFAULT NULL,
  `loc_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`rec_id`),
  KEY `loc_id_idx` (`loc_id`),
  CONSTRAINT `loc_id` FOREIGN KEY (`loc_id`) REFERENCES `location` (`loc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of responsibility_center
-- ----------------------------

-- ----------------------------
-- Table structure for `rfp_status`
-- ----------------------------
DROP TABLE IF EXISTS `rfp_status`;
CREATE TABLE `rfp_status` (
  `rfp_status_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rfp_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rfp_status
-- ----------------------------

-- ----------------------------
-- Table structure for `road_grade`
-- ----------------------------
DROP TABLE IF EXISTS `road_grade`;
CREATE TABLE `road_grade` (
  `roa_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `roa_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of road_grade
-- ----------------------------

-- ----------------------------
-- Table structure for `sale`
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale` (
  `sal_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pay_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`sal_id`),
  KEY `pay_id_idx` (`pay_id`),
  CONSTRAINT `pay_id` FOREIGN KEY (`pay_id`) REFERENCES `payment` (`pay_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sale
-- ----------------------------

-- ----------------------------
-- Table structure for `special_deal`
-- ----------------------------
DROP TABLE IF EXISTS `special_deal`;
CREATE TABLE `special_deal` (
  `spd_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `spd_description` varchar(255) DEFAULT NULL,
  `spd_start_date` datetime DEFAULT NULL,
  `spd_end_date` datetime DEFAULT NULL,
  `cur_code_customer` smallint(6) DEFAULT NULL,
  `cur_code_location_owner` smallint(6) DEFAULT NULL,
  `spd_discount_percentage` decimal(3,3) DEFAULT NULL,
  `spd_availability` tinyint(4) DEFAULT NULL,
  `med_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`spd_id`),
  KEY `med_id_idx` (`med_id`),
  CONSTRAINT `med_id` FOREIGN KEY (`med_id`) REFERENCES `media_owner` (`med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of special_deal
-- ----------------------------

-- ----------------------------
-- Table structure for `surbub`
-- ----------------------------
DROP TABLE IF EXISTS `surbub`;
CREATE TABLE `surbub` (
  `sur_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `sur_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of surbub
-- ----------------------------

-- ----------------------------
-- Table structure for `tax`
-- ----------------------------
DROP TABLE IF EXISTS `tax`;
CREATE TABLE `tax` (
  `tax_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(45) DEFAULT NULL,
  `tax_percentage` float DEFAULT NULL,
  `tax_mandatory` tinyint(4) DEFAULT NULL,
  `txt_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tax_id`),
  KEY `txt_id_idx` (`txt_id`),
  CONSTRAINT `txt_id` FOREIGN KEY (`txt_id`) REFERENCES `tax_type` (`txt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tax
-- ----------------------------

-- ----------------------------
-- Table structure for `tax_type`
-- ----------------------------
DROP TABLE IF EXISTS `tax_type`;
CREATE TABLE `tax_type` (
  `txt_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `txt_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`txt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tax_type
-- ----------------------------

-- ----------------------------
-- Table structure for `town`
-- ----------------------------
DROP TABLE IF EXISTS `town`;
CREATE TABLE `town` (
  `tow_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `tow_description` varchar(255) DEFAULT NULL,
  `tow_code` varchar(255) DEFAULT NULL,
  `lot_id` smallint(6) DEFAULT NULL COMMENT 'FK : location_type',
  PRIMARY KEY (`tow_id`),
  KEY `lot_id_idx` (`lot_id`),
  CONSTRAINT `lot_id` FOREIGN KEY (`lot_id`) REFERENCES `location_type` (`lot_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of town
-- ----------------------------
INSERT INTO `town` VALUES ('1', 'johannesburg', 'JHB', '1');
INSERT INTO `town` VALUES ('2', 'pretoria', 'PRE', '1');

-- ----------------------------
-- Table structure for `transaction_category`
-- ----------------------------
DROP TABLE IF EXISTS `transaction_category`;
CREATE TABLE `transaction_category` (
  `tctg_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `tctg_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tctg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaction_category
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `use_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `use_password` varchar(32) NOT NULL,
  `ust_id` smallint(5) unsigned NOT NULL DEFAULT '5',
  `use_username` varchar(45) NOT NULL,
  `use_status` tinyint(4) NOT NULL DEFAULT '1',
  `pem_id` smallint(5) unsigned DEFAULT NULL,
  `use_registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `use_date_updated` datetime DEFAULT NULL,
  `use_date_deleted` datetime DEFAULT NULL,
  `use_first_name` varchar(35) DEFAULT NULL,
  `use_last_name` varchar(35) DEFAULT NULL,
  `use_email` varchar(50) DEFAULT NULL,
  `use_photo` varchar(200) NOT NULL,
  PRIMARY KEY (`use_id`),
  KEY `per_id_idx` (`pem_id`),
  KEY `ust_id_idx` (`ust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('5', 'pintos', '2', 'pintos', '1', null, '2014-07-16 19:33:59', null, null, 'media owner', 'developer', null, '');
INSERT INTO `user` VALUES ('6', 'advertiser', '1', 'advertiser', '1', null, '2014-07-18 16:09:41', null, null, 'advertiser', 'developer', null, '');

-- ----------------------------
-- Table structure for `user_permission`
-- ----------------------------
DROP TABLE IF EXISTS `user_permission`;
CREATE TABLE `user_permission` (
  `usp_id` smallint(6) NOT NULL,
  `ust_id` smallint(6) DEFAULT NULL,
  `usp_description` varchar(45) DEFAULT NULL,
  `usp_edited_by` smallint(6) DEFAULT NULL,
  `usp_date_edited` datetime DEFAULT NULL,
  `usp_date_created` timestamp NULL DEFAULT NULL,
  `usp_created_by` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`usp_id`),
  KEY `usp_created_by_idx` (`usp_created_by`),
  KEY `ust_id_idx` (`ust_id`),
  CONSTRAINT `usp_created_by` FOREIGN KEY (`usp_created_by`) REFERENCES `ads2trade_user` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ust_id` FOREIGN KEY (`ust_id`) REFERENCES `user_type` (`ust_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_permission
-- ----------------------------

-- ----------------------------
-- Table structure for `user_type`
-- ----------------------------
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `ust_id` smallint(6) NOT NULL,
  `ust_description` varchar(45) DEFAULT NULL,
  `caf_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ust_id`),
  KEY `caf_id_idx` (`caf_id`),
  CONSTRAINT `caf_id` FOREIGN KEY (`caf_id`) REFERENCES `contact_address_format` (`caf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_type
-- ----------------------------
INSERT INTO `user_type` VALUES ('1', 'advertiser', '1');
INSERT INTO `user_type` VALUES ('2', 'media owner', '1');
INSERT INTO `user_type` VALUES ('3', 'operator', '1');

-- ----------------------------
-- Table structure for `work_type`
-- ----------------------------
DROP TABLE IF EXISTS `work_type`;
CREATE TABLE `work_type` (
  `wor_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `wor_description` varchar(255) DEFAULT NULL,
  `wor_IE` varchar(255) DEFAULT NULL,
  `wor_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`wor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of work_type
-- ----------------------------
