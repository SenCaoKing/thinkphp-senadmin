/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : thinkphp-senadmin

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 31/08/2018 20:17:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sen_admin_nav
-- ----------------------------
DROP TABLE IF EXISTS `sen_admin_nav`;
CREATE TABLE `sen_admin_nav`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单表id',
  `pid` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '所属菜单',
  `name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '菜单名称',
  `mca` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '模块、控制器、方法',
  `ico` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'font-awesome图标',
  `order_number` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sen_admin_nav
-- ----------------------------
INSERT INTO `sen_admin_nav` VALUES (1, 0, '系统设置', 'Admin/ShowNav/config', 'cog', 1);
INSERT INTO `sen_admin_nav` VALUES (3, 1, '菜单管理', 'Admin/Nav/index', '', NULL);
INSERT INTO `sen_admin_nav` VALUES (4, 0, '权限控制', 'Admin/ShowNav/rule', 'expeditedssl', NULL);
INSERT INTO `sen_admin_nav` VALUES (5, 4, '权限管理', 'Admin/Rule/index', '', NULL);
INSERT INTO `sen_admin_nav` VALUES (6, 4, '用户组管理', 'Admin/Rule/group', '', NULL);
INSERT INTO `sen_admin_nav` VALUES (7, 4, '管理员列表', 'Admin/Rule/admin_user_list', '', NULL);
INSERT INTO `sen_admin_nav` VALUES (8, 0, '会员管理', 'Admin/ShowNav/', 'users', NULL);
INSERT INTO `sen_admin_nav` VALUES (9, 8, '会员列表', 'Admin/Users/index', '', NULL);
INSERT INTO `sen_admin_nav` VALUES (10, 0, '文章管理', 'Admin/ShowNav/posts', 'th', NULL);
INSERT INTO `sen_admin_nav` VALUES (11, 10, '文章列表', 'Admin/Posts/index', '', NULL);

-- ----------------------------
-- Table structure for sen_articles
-- ----------------------------
DROP TABLE IF EXISTS `sen_articles`;
CREATE TABLE `sen_articles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(1) NOT NULL DEFAULT 0 COMMENT '分类id',
  `title` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sen_articles
-- ----------------------------
INSERT INTO `sen_articles` VALUES (2, 5, '文章5', '内容5', NULL, NULL, NULL);
INSERT INTO `sen_articles` VALUES (5, 4, '文章4', '内容4', NULL, NULL, NULL);
INSERT INTO `sen_articles` VALUES (16, 0, '标题125-1', '内容125', '2018-05-23 22:40:05', '2018-05-29 21:06:01', NULL);
INSERT INTO `sen_articles` VALUES (8, 5, '文章5', '内容5', NULL, NULL, NULL);
INSERT INTO `sen_articles` VALUES (9, 6, '文章6', '内容6', '2018-05-23 19:21:31', '2018-05-23 19:21:31', NULL);
INSERT INTO `sen_articles` VALUES (10, 6, '文章6', '内容6', '2018-05-23 19:37:10', '2018-05-23 19:37:10', NULL);
INSERT INTO `sen_articles` VALUES (11, 6, '文章6', '内容6', '2018-05-23 19:37:10', '2018-05-23 19:37:10', NULL);
INSERT INTO `sen_articles` VALUES (12, 6, '文章6', '内容6', '2018-05-23 19:38:01', '2018-05-23 19:38:01', NULL);
INSERT INTO `sen_articles` VALUES (13, 6, '文章6', '内容6', '2018-05-23 19:38:01', '2018-05-23 19:38:01', NULL);
INSERT INTO `sen_articles` VALUES (15, 6, '文章6', '内容6', '2018-05-23 19:43:26', '2018-05-23 19:43:26', NULL);

-- ----------------------------
-- Table structure for sen_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `sen_auth_group`;
CREATE TABLE `sen_auth_group`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rules` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of sen_auth_group
-- ----------------------------
INSERT INTO `sen_auth_group` VALUES (1, '超级管理员', 1, '1,2,3,4,5,6,7,8,9,10,12,13,11');
INSERT INTO `sen_auth_group` VALUES (2, '产品管理员', 1, '1,2,4,5,6,7,11');

-- ----------------------------
-- Table structure for sen_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `sen_auth_group_access`;
CREATE TABLE `sen_auth_group_access`  (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  UNIQUE INDEX `uid_group_id`(`uid`, `group_id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of sen_auth_group_access
-- ----------------------------
INSERT INTO `sen_auth_group_access` VALUES (1, 1);
INSERT INTO `sen_auth_group_access` VALUES (2, 2);

-- ----------------------------
-- Table structure for sen_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `sen_auth_rule`;
CREATE TABLE `sen_auth_rule`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级id',
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态：为1正常，为0禁用',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `condition` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '规则表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of sen_auth_rule
-- ----------------------------
INSERT INTO `sen_auth_rule` VALUES (1, 0, 'Admin/Index/index', '后台首页', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (2, 1, 'Admin/Index/welcome', '欢迎界面', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (3, 0, 'Admin/ShowNav/config', '系统设置', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (4, 3, 'Admin/ShowNav/nav', '菜单管理', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (5, 4, 'Admin/Nav/index', '菜单列表', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (6, 4, 'Admin/Nav/add', '添加菜单', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (7, 4, 'Admin/Na/edit', '修改菜单', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (8, 4, 'Admin/Na/delete', '删除菜单', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (9, 4, 'Admin/Na/order', '菜单排序', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (10, 3, 'Admin/ShowNav/rule', '权限控制', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (11, 3, 'Admin/ShowNav/posts', '文章管理', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (12, 10, 'Admin/Rule/index', '权限管理', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (13, 10, 'Admin/Rule/group', '用户组管理', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (14, 12, 'Admin/Rule/add', '添加权限', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (15, 12, 'Admin/Rule/edit', '修改权限', 1, 1, '');
INSERT INTO `sen_auth_rule` VALUES (16, 12, 'Admin/Rule/delete', '删除权限', 1, 1, '');

-- ----------------------------
-- Table structure for sen_getfield_user
-- ----------------------------
DROP TABLE IF EXISTS `sen_getfield_user`;
CREATE TABLE `sen_getfield_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `avatar` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '用户图像',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sen_getfield_user
-- ----------------------------
INSERT INTO `sen_getfield_user` VALUES (1, 'sen01', 'sen01.jpg');
INSERT INTO `sen_getfield_user` VALUES (2, 'sen02', 'sen02.jpg');
INSERT INTO `sen_getfield_user` VALUES (3, 'sen03', 'sen02.jpg');

-- ----------------------------
-- Table structure for sen_users
-- ----------------------------
DROP TABLE IF EXISTS `sen_users`;
CREATE TABLE `sen_users`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '激活码',
  `phone` bigint(11) UNSIGNED NULL DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `register_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册时间',
  `last_login_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) UNSIGNED NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_login_key`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sen_users
-- ----------------------------
INSERT INTO `sen_users` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, 0, 1, 1534853019, '', 0);
INSERT INTO `sen_users` VALUES (2, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, 0, 1, 1534854117, '', 0);
INSERT INTO `sen_users` VALUES (3, 'admin3', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, 0, 0, 1534862341, '', 0);

SET FOREIGN_KEY_CHECKS = 1;
