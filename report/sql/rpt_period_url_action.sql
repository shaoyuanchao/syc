/*
Navicat MySQL Data Transfer

Source Server         : www.fnying.com
Source Server Version : 50173
Source Host           : 
Source Database       : 

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2018-04-10 14:31:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rpt_period_url_action
-- ----------------------------
DROP TABLE IF EXISTS `rpt_period_url_action`;
CREATE TABLE `rpt_period_url_action` (
  `action_url` varchar(255) CHARACTER SET ascii NOT NULL COMMENT '访问URL',
  `rpt_title` varchar(50) NOT NULL COMMENT '报告标题',
  `rpt_type` varchar(10) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT '报告类型',
  `from_time_stamp` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '统计开始时间戳',
  `to_time_stamp` int(11) DEFAULT NULL COMMENT '统计结束时间戳',
  `action_count` int(11) NOT NULL DEFAULT '0' COMMENT '访问次数',
  `id_count` int(11) NOT NULL DEFAULT '0' COMMENT '访问ID数量',
  `rpt_time` datetime DEFAULT NULL COMMENT '报表生成时间',
  PRIMARY KEY (`action_url`,`rpt_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='期间网址访问统计报表';
