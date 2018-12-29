/*
Navicat MySQL Data Transfer

Source Server         : erp
Source Server Version : 50718
Source Host           : rm-bp109bb59op5uq8km1o.mysql.rds.aliyuncs.com:3306
Source Database       : gmy

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2018-12-19 16:52:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) DEFAULT NULL COMMENT '昵称',
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `thumb` int(11) NOT NULL DEFAULT '1' COMMENT '管理员头像',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(100) DEFAULT NULL COMMENT '最后登录ip',
  `admin_cate_id` int(2) NOT NULL DEFAULT '1' COMMENT '管理员分组',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `admin_cate_id` (`admin_cate_id`) USING BTREE,
  KEY `nickname` (`nickname`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'Abin', 'admin', '9095c7a202307486c09f3be526c8b312', '1', '1510885948', '1534654392', '1545207591', '1.192.32.56', '1');
INSERT INTO `admin` VALUES ('16', '普通', 'gmy', '972262e4efe2e00f364d979a7c6ae7ee', '36', '1530589608', '1533369396', '1533522752', '222.89.84.153', '20');
INSERT INTO `admin` VALUES ('17', '格美云1号', 'gmy1', '972262e4efe2e00f364d979a7c6ae7ee', '35', '1533202583', '1533202583', '1533453334', '127.0.0.1', '20');
INSERT INTO `admin` VALUES ('18', '测试', 'gmy2', '972262e4efe2e00f364d979a7c6ae7ee', '1', '1533300051', '1533300051', '1533453132', '127.0.0.1', '20');
INSERT INTO `admin` VALUES ('19', 'qq', 'qq', '7a2a059eb4bb7855757f36adf4af44ad', '1', '1534930099', '1534930099', '1534932875', '222.89.84.153', '20');

-- ----------------------------
-- Table structure for admin_cate
-- ----------------------------
DROP TABLE IF EXISTS `admin_cate`;
CREATE TABLE `admin_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `permissions` text COMMENT '权限菜单',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `desc` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admin_cate
-- ----------------------------
INSERT INTO `admin_cate` VALUES ('1', '超级管理员', '3,9,97,6,7,8,25,26,28,29,13,14,16,17,19,20,21,37,38,39,40,42,43,44,45,47,48,61,62,64,65,69,70,98,110,79,81,82,90,91,111,112,113,114,115', '0', '1545185988', '超级管理员，拥有最高权限！');
INSERT INTO `admin_cate` VALUES ('20', '普通管理员', '6,7,8,34,35,37,38,39,40,42,43,44,45,47,48', '1530778455', '1533455814', '测试普通管理员操作权限');
INSERT INTO `admin_cate` VALUES ('21', '数据管理', null, '1534915077', '1534915077', '');
