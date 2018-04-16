/*
Navicat MySQL Data Transfer

Source Server         : www.fnying.com
Source Server Version : 50173
Source Host           : 
Source Database       : 

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2018-04-10 14:30:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cnt_url_action
-- ----------------------------
DROP TABLE IF EXISTS `cnt_url_action`;
CREATE TABLE `cnt_url_action` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '访问日志ID',
  `from_url` varchar(255) CHARACTER SET ascii DEFAULT NULL COMMENT '来源URL',
  `from_prm` varchar(255) CHARACTER SET ascii DEFAULT NULL COMMENT '来源URL参数',
  `action_id` char(36) CHARACTER SET ascii DEFAULT NULL COMMENT '访问ID',
  `action_url` varchar(255) CHARACTER SET ascii NOT NULL COMMENT '访问URL',
  `action_prm` varchar(255) CHARACTER SET ascii DEFAULT NULL COMMENT '访问URL参数',
  `action_time` int(11) NOT NULL COMMENT '访问时间戳',
  `action_ip` int(11) DEFAULT NULL COMMENT '访问IP',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网址访问统计';
