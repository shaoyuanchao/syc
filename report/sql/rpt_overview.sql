/*
Navicat MySQL Data Transfer

Source Server         : www.fnying.com
Source Server Version : 50173
Source Host           : 
Source Database       : 

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2018-04-12 11:33:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rpt_overview
-- ----------------------------
DROP TABLE IF EXISTS `rpt_overview`;
CREATE TABLE `rpt_overview` (
  `rpt_title` varchar(50) NOT NULL COMMENT '报告标题',
  `rpt_sort` tinyint(10) NOT NULL DEFAULT '0' COMMENT '报告排序',
  `url_key` varchar(255) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'URL关键字',
  `rpt_unit` varchar(10) NOT NULL COMMENT '报告单位',
  `rpt_count` int(11) NOT NULL DEFAULT '0' COMMENT '报告数据',
  `rpt_time` datetime NOT NULL COMMENT '报告时间',
  PRIMARY KEY (`rpt_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='概要统计报告';
