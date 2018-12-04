/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost
 Source Database       : project_laravel55_platform4api

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : utf-8

 Date: 12/04/2018 18:06:49 PM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `pf_failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `pf_failed_jobs`;
CREATE TABLE `pf_failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pf_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `pf_jobs`;
CREATE TABLE `pf_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pf_migrations`
-- ----------------------------
DROP TABLE IF EXISTS `pf_migrations`;
CREATE TABLE `pf_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pf_migrations`
-- ----------------------------
BEGIN;
INSERT INTO `pf_migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1'), ('2', '2014_10_12_100000_create_password_resets_table', '1'), ('3', '2016_06_01_000001_create_oauth_auth_codes_table', '2'), ('4', '2016_06_01_000002_create_oauth_access_tokens_table', '2'), ('5', '2016_06_01_000003_create_oauth_refresh_tokens_table', '2'), ('6', '2016_06_01_000004_create_oauth_clients_table', '2'), ('7', '2016_06_01_000005_create_oauth_personal_access_clients_table', '2'), ('8', '2018_12_02_094654_create_jobs_table', '3'), ('9', '2018_12_02_094819_create_failed_jobs_table', '4');
COMMIT;

-- ----------------------------
--  Table structure for `pf_oauth_access_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `pf_oauth_access_tokens`;
CREATE TABLE `pf_oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pf_oauth_access_tokens`
-- ----------------------------
BEGIN;
INSERT INTO `pf_oauth_access_tokens` VALUES ('5a695f241bdf482de26de74b910701a9a30fb959dbd1bd84752e2ba24041eaa47a5ac9bf912f4aee', '1', '2', null, '[]', '0', '2018-12-04 08:34:29', '2018-12-04 08:34:29', '2018-12-19 08:34:29');
COMMIT;

-- ----------------------------
--  Table structure for `pf_oauth_auth_codes`
-- ----------------------------
DROP TABLE IF EXISTS `pf_oauth_auth_codes`;
CREATE TABLE `pf_oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pf_oauth_clients`
-- ----------------------------
DROP TABLE IF EXISTS `pf_oauth_clients`;
CREATE TABLE `pf_oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pf_oauth_clients`
-- ----------------------------
BEGIN;
INSERT INTO `pf_oauth_clients` VALUES ('1', null, 'Laravel Personal Access Client', '3L6IdWZzFzLwq9MmH25YVrVyGj1SkuuEagClFpAV', 'http://localhost', '1', '0', '0', '2018-12-02 08:20:38', '2018-12-02 08:20:38'), ('2', null, 'Laravel Password Grant Client', 'fMCZGN8gekt8BBP13taC9vwPmHiCWmRr379e7Tz4', 'http://localhost', '0', '1', '0', '2018-12-02 08:20:38', '2018-12-02 08:20:38');
COMMIT;

-- ----------------------------
--  Table structure for `pf_oauth_personal_access_clients`
-- ----------------------------
DROP TABLE IF EXISTS `pf_oauth_personal_access_clients`;
CREATE TABLE `pf_oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pf_oauth_personal_access_clients`
-- ----------------------------
BEGIN;
INSERT INTO `pf_oauth_personal_access_clients` VALUES ('1', '1', '2018-12-02 08:20:38', '2018-12-02 08:20:38');
COMMIT;

-- ----------------------------
--  Table structure for `pf_oauth_refresh_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `pf_oauth_refresh_tokens`;
CREATE TABLE `pf_oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pf_oauth_refresh_tokens`
-- ----------------------------
BEGIN;
INSERT INTO `pf_oauth_refresh_tokens` VALUES ('37a821179010df7144951f5a5ea7190fc663e64c9452f26ac4a5eb2d33a3bbc18a07d938e949cbff', '5a695f241bdf482de26de74b910701a9a30fb959dbd1bd84752e2ba24041eaa47a5ac9bf912f4aee', '0', '2019-01-03 08:34:29');
COMMIT;

-- ----------------------------
--  Table structure for `pf_password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `pf_password_resets`;
CREATE TABLE `pf_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pf_users`
-- ----------------------------
DROP TABLE IF EXISTS `pf_users`;
CREATE TABLE `pf_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pf_users`
-- ----------------------------
BEGIN;
INSERT INTO `pf_users` VALUES ('1', 'cyb_43`', 'cyb_43@foxmail.com', '$2y$10$xk5dsSVHD5.LaR3u7T3lPeg1mExaL4J/XVDZdVxpARuPdC9VacA9G', 'RT8Yb6a7ksoSoMqzLeXFApXFr4k8ICeHZBbrDCz7A9s9heVe6fD1QRm70ImD', '2018-12-04 06:42:35', '2018-12-04 06:42:35');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
