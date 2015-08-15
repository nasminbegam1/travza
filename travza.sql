-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2015 at 06:15 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `travza`
--

-- --------------------------------------------------------

--
-- Table structure for table `tr_cms`
--

CREATE TABLE IF NOT EXISTS `tr_cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_title` varchar(50) NOT NULL,
  `cms_slug` varchar(255) NOT NULL,
  `cms_content` longtext NOT NULL,
  `cms_image` varchar(255) NOT NULL,
  `cms_meta_title` varchar(255) NOT NULL,
  `cms_meta_key` text NOT NULL,
  `cms_meta_desc` text NOT NULL,
  `cms_status` enum('0','1') NOT NULL DEFAULT '1',
  `cms_added_on` datetime NOT NULL,
  `cms_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_cms`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_email_template`
--

CREATE TABLE IF NOT EXISTS `tr_email_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) NOT NULL,
  `responce_email` varchar(100) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_content` longtext NOT NULL,
  `template_status` enum('0','1') NOT NULL DEFAULT '1',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'CURRENT_TIMESTAMP',
  PRIMARY KEY (`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_email_template`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_menu`
--

CREATE TABLE IF NOT EXISTS `tr_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tr_menu`
--

INSERT INTO `tr_menu` (`id`, `menu_id`, `menu_name`) VALUES
(1, 1, 'Dashboard'),
(2, 2, 'Sitesettings'),
(3, 3, 'CMS'),
(4, 4, 'CMS Pages'),
(5, 5, 'Email Template');

-- --------------------------------------------------------

--
-- Table structure for table `tr_role_master`
--

CREATE TABLE IF NOT EXISTS `tr_role_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `menu_id` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_role_master`
--

INSERT INTO `tr_role_master` (`id`, `role_id`, `parent_id`, `role`, `menu_id`, `status`) VALUES
(1, 1, 0, 'Super Admin', '1,2,3,4,5', 'Active'),
(2, 2, 0, 'Agent', '1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tr_sitesettings`
--

CREATE TABLE IF NOT EXISTS `tr_sitesettings` (
  `sitesettings_id` int(5) NOT NULL AUTO_INCREMENT,
  `sitesettings_name` varchar(255) NOT NULL,
  `sitesettings_type` enum('TEXT','COMBO','CHECKBOX','TEXTAREA','SELECT') NOT NULL DEFAULT 'TEXT',
  `sitesettings_data_type` enum('TEXT','NUMERIC') NOT NULL DEFAULT 'TEXT',
  `sitesettings_lebel` varchar(255) NOT NULL,
  `sitesettings_value` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sitesettings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_sitesettings`
--

INSERT INTO `tr_sitesettings` (`sitesettings_id`, `sitesettings_name`, `sitesettings_type`, `sitesettings_data_type`, `sitesettings_lebel`, `sitesettings_value`, `status`, `last_updated_on`) VALUES
(1, 'webmaster_email', 'TEXT', 'TEXT', 'Webmaster', 'nasmin.begam91@gmail.com', 'active', '2015-08-15 21:24:21'),
(2, 'sitename', 'TEXT', 'TEXT', 'Site Name', 'Travza', 'active', '2015-08-15 21:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `tr_usermaster`
--

CREATE TABLE IF NOT EXISTS `tr_usermaster` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_login_ip_adr` varchar(30) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  KEY `email_id` (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_usermaster`
--

INSERT INTO `tr_usermaster` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `image`, `role_id`, `status`, `last_login_ip_adr`, `last_login`, `added_on`, `updated_on`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '123456', '', '1', 'active', '127.0.0.1', '2015-08-15 21:34:07', '2015-08-15 17:34:59', '2015-08-15 21:19:21'),
(2, 'agent', 'agent', 'agent@agent.com', '123456', '', '2', 'active', '127.0.0.1', '2015-08-15 20:18:11', '2015-08-15 17:34:59', '0000-00-00 00:00:00');
