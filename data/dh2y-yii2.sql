/*
Navicat MySQL Data Transfer

Source Server         : myPc
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : dh2y-yii2

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-10-30 13:15:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dh_admin`
-- ----------------------------
DROP TABLE IF EXISTS `dh_admin`;
CREATE TABLE `dh_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `password_reset_token` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dh_admin
-- ----------------------------
INSERT INTO `dh_admin` VALUES ('1', 'admin', 'i8A7YnWnduNh_L0xIlUpEl0p4VENLj2q', '$2y$13$7S4UuyOEe.0s3TN/0OZX1e53cJFtTj6Fqqbp.RA4GgxTIjp6ynAcW', null, '123456@qq.com', '10', '1461143622', '1463361596');

-- ----------------------------
-- Table structure for `dh_auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `dh_auth_assignment`;
CREATE TABLE `dh_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `dh_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `dh_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限与用户关系表';

-- ----------------------------
-- Records of dh_auth_assignment
-- ----------------------------
INSERT INTO `dh_auth_assignment` VALUES ('admin/add', '1', '1475904988');
INSERT INTO `dh_auth_assignment` VALUES ('超级管理员', '1', '1471504158');

-- ----------------------------
-- Table structure for `dh_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `dh_auth_item`;
CREATE TABLE `dh_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `dh_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `dh_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限表';

-- ----------------------------
-- Records of dh_auth_item
-- ----------------------------
INSERT INTO `dh_auth_item` VALUES ('admin/add', '2', '创建了 admin/add 许可', null, null, '1475904988', '1475904988');
INSERT INTO `dh_auth_item` VALUES ('admin/index', '2', '创建了 admin/index 许可', null, null, '1471500474', '1471500474');
INSERT INTO `dh_auth_item` VALUES ('admin/role', '2', '创建了 admin/role 许可', null, null, '1471503211', '1471503211');
INSERT INTO `dh_auth_item` VALUES ('role/role-create', '2', '创建了 role/role-create 许可', null, null, '1471415411', '1471415411');
INSERT INTO `dh_auth_item` VALUES ('role/role-delete', '2', '创建了 role/role-delete 许可', null, null, '1471434727', '1471434727');
INSERT INTO `dh_auth_item` VALUES ('role/role-index', '2', '创建了 role/role-index 许可', null, null, '1471403856', '1471403856');
INSERT INTO `dh_auth_item` VALUES ('role/role-node', '2', '创建了 role/role-node 许可', null, null, '1471482975', '1471482975');
INSERT INTO `dh_auth_item` VALUES ('role/role-update', '2', '创建了 role/role-update 许可', null, null, '1471433794', '1471433794');
INSERT INTO `dh_auth_item` VALUES ('普通管理员', '1', '创建了 普通管理员角色、部门、权限组', null, null, '1469973489', '1469973489');
INSERT INTO `dh_auth_item` VALUES ('游客', '1', '创建了 游客角色、部门、权限组', null, null, '1469973709', '1469973709');
INSERT INTO `dh_auth_item` VALUES ('超级管理员', '1', '超级管理员', null, null, '1471423635', '1471423635');

-- ----------------------------
-- Table structure for `dh_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `dh_auth_item_child`;
CREATE TABLE `dh_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `dh_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `dh_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dh_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `dh_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限关系表';

-- ----------------------------
-- Records of dh_auth_item_child
-- ----------------------------
INSERT INTO `dh_auth_item_child` VALUES ('超级管理员', 'role/role-create');
INSERT INTO `dh_auth_item_child` VALUES ('超级管理员', 'role/role-delete');
INSERT INTO `dh_auth_item_child` VALUES ('普通管理员', 'role/role-index');
INSERT INTO `dh_auth_item_child` VALUES ('超级管理员', 'role/role-index');
INSERT INTO `dh_auth_item_child` VALUES ('普通管理员', 'role/role-node');
INSERT INTO `dh_auth_item_child` VALUES ('超级管理员', 'role/role-node');
INSERT INTO `dh_auth_item_child` VALUES ('普通管理员', 'role/role-update');
INSERT INTO `dh_auth_item_child` VALUES ('超级管理员', 'role/role-update');

-- ----------------------------
-- Table structure for `dh_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `dh_auth_rule`;
CREATE TABLE `dh_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of dh_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for `dh_menu`
-- ----------------------------
DROP TABLE IF EXISTS `dh_menu`;
CREATE TABLE `dh_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `dh_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `dh_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dh_menu
-- ----------------------------
INSERT INTO `dh_menu` VALUES ('13', '菜单列表', '20', 'menu/index', '1', null);
INSERT INTO `dh_menu` VALUES ('17', '管理员管理', '20', 'admin/index', '3', null);
INSERT INTO `dh_menu` VALUES ('19', '角色管理', '20', 'role/role-index', '2', null);
INSERT INTO `dh_menu` VALUES ('20', '权限管理', null, null, null, 'icon-user');
INSERT INTO `dh_menu` VALUES ('21', '系统设置', null, null, null, null);
INSERT INTO `dh_menu` VALUES ('22', '基本设置', '21', null, null, null);
INSERT INTO `dh_menu` VALUES ('23', '路由管理', '20', 'role/node-list', '0', null);

-- ----------------------------
-- Table structure for `dh_user`
-- ----------------------------
DROP TABLE IF EXISTS `dh_user`;
CREATE TABLE `dh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `password_reset_token` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dh_user
-- ----------------------------
INSERT INTO `dh_user` VALUES ('1', 'admin', 'i8A7YnWnduNh_L0xIlUpEl0p4VENLj2q', '$2y$13$7S4UuyOEe.0s3TN/0OZX1e53cJFtTj6Fqqbp.RA4GgxTIjp6ynAcW', null, '123456@qq.com', '10', '1461143622', '1463361596');
INSERT INTO `dh_user` VALUES ('3', 'test', 'LQhpMWYcEZZvngqn4fP1jlIKMVwori01', '$2y$13$/Ok52xJ40xVckeE5WMxKWOIUi/uVgzesppTHj5bX3LcpadlUlIgCC', null, '123456111@qq.com', '10', '1461557693', '1461557693');
INSERT INTO `dh_user` VALUES ('4', 'test01', 'T7KHuSa7hDsUySKdX9o5fOcA2Pj1kRYU', '$2y$13$i3VdZDLM71ErCuQlj.9jJeG2G1Hm3uNbnNVSn2at2kYMOMB6h8vnS', null, '12345611122@qq.com', '10', '1461557767', '1461557767');
INSERT INTO `dh_user` VALUES ('5', 'test02', 'blDvwbtcOCroUk3aMsxx496gWu9G0z8p', '$2y$13$0iWcHC4YeYSU4Tk.1PSNUOraHwKv5jI2THlo4ktWZNEAtwdgDhUku', null, '123456111221@qq.com', '10', '1461557819', '1463019969');
INSERT INTO `dh_user` VALUES ('6', 'dai', 'i9GcUOGZaDWLbjacqDUDnJgl7Nma0ujt', '$2y$13$xvGKsRr1N2kV3pf.UyxTx.x49SypSrTNDF0mhtj2iAMyVQ5A2qS.q', null, 'dai@dai.com', '10', '1467858950', '1467858950');
INSERT INTO `dh_user` VALUES ('8', 'qq', 'm4vcKyg3UqiWZP53S_qa2rgLWENinF9h', '$2y$13$Wfzg83Sekv8x0RPUAY3qoO.Z74dluoRKUlLC/Dk7MtryLs9AMB.wi', null, 'qq@qq.com', '10', '1467943880', '1467943880');
