-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 08 2017 г., 14:35
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `loto_fortuna_new`
--

-- --------------------------------------------------------

--
-- Структура таблицы `p_payments`
--

CREATE TABLE IF NOT EXISTS `p_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payeer_purse` varchar(16) NOT NULL,
  `summa` float(11,2) NOT NULL,
  `summa_commission` float(11,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_stat`
--

CREATE TABLE IF NOT EXISTS `p_roulette_stat` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `last_game_data` datetime NOT NULL,
  `admin_profit` float(11,2) NOT NULL DEFAULT '0.00',
  `total_game` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `p_roulette_stat`
--

INSERT INTO `p_roulette_stat` (`id`, `last_game_data`, `admin_profit`, `total_game`) VALUES
(1, '2017-08-08 11:26:16', 0.00, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_game`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` int(14) NOT NULL,
  `finish` int(14) NOT NULL DEFAULT '0',
  `check_finish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_game_2`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_game_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` int(14) NOT NULL,
  `finish` int(14) NOT NULL DEFAULT '0',
  `check_finish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_game_3`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_game_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` int(14) NOT NULL,
  `finish` int(14) NOT NULL DEFAULT '0',
  `check_finish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_game_4`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_game_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `sum_bet` float(11,2) NOT NULL,
  `percent` float(5,2) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` int(14) NOT NULL,
  `finish` int(14) NOT NULL DEFAULT '0',
  `check_finish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Структура таблицы `p_roulette_users_game_5`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_game_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `sum_bet` float(11,2) NOT NULL,
  `percent` float(5,2) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` int(14) NOT NULL,
  `finish` int(14) NOT NULL DEFAULT '0',
  `check_finish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Структура таблицы `p_roulette_users_game_6`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_game_6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `sum_bet` float(11,2) NOT NULL,
  `percent` float(5,2) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` int(14) NOT NULL,
  `finish` int(14) NOT NULL DEFAULT '0',
  `check_finish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_stat`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  `sum` float(8,2) NOT NULL DEFAULT '0.00',
  `lost` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_stat_2`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_stat_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  `sum` float(8,2) NOT NULL DEFAULT '0.00',
  `lost` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_stat_3`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_stat_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  `sum` float(8,2) NOT NULL DEFAULT '0.00',
  `lost` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_stat_4`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_stat_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  `sum` float(8,2) NOT NULL DEFAULT '0.00',
  `sum_bet` float(8,2) NOT NULL DEFAULT '0.00',
  `percent` float(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------






--
-- Структура таблицы `p_roulette_users_stat_5`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_stat_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  `sum` float(8,2) NOT NULL DEFAULT '0.00',
  `sum_bet` float(8,2) NOT NULL DEFAULT '0.00',
  `percent` float(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_roulette_users_stat_6`
--

CREATE TABLE IF NOT EXISTS `p_roulette_users_stat_6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  `sum` float(8,2) NOT NULL DEFAULT '0.00',
  `sum_bet` float(8,2) NOT NULL DEFAULT '0.00',
  `percent` float(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------






--
-- Структура таблицы `p_settings`
--

CREATE TABLE IF NOT EXISTS `p_settings` (
  `nas_id` int(2) NOT NULL AUTO_INCREMENT,
  `nas_par` varchar(40) NOT NULL,
  `nas_znach` varchar(255) NOT NULL,
  PRIMARY KEY (`nas_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `p_settings`
--

INSERT INTO `p_settings` (`nas_id`, `nas_par`, `nas_znach`) VALUES
(1, 'min_summa_out', '10'),
(2, 'min_summa_in', '2'),
(3, 'bonus_reg', '2'),
(4, 'ref_percent', '10'),
(5, 'set_payments', 'on'),
(6, 'commission_pay_out', '10'),
(7, 'site_commission_loto', '5'),
(8, 'ref_percent_bet', '1'),
(9, 'bonus_interval', '86400'),
(10, 'bonus_min_summ', '1'),
(11, 'bonus_max_summ', '100');

-- --------------------------------------------------------

--
-- Структура таблицы `p_stat_bonus`
--

CREATE TABLE IF NOT EXISTS `p_stat_bonus` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `summa` float(4,2) NOT NULL DEFAULT '0.00',
  `data` int(14) NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_update`
--

CREATE TABLE IF NOT EXISTS `p_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `summa` float(11,2) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `pay_system` text NOT NULL,
  `bonus` float(11,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_update_balance`
--

CREATE TABLE IF NOT EXISTS `p_update_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `summa` int(11) NOT NULL,
  `usd` decimal(8,2) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `pay_system` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `p_users`
--

CREATE TABLE IF NOT EXISTS `p_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `vk_id` int(14) NOT NULL,
  `vk_avatar` varchar(300) NOT NULL,
  `vk_avatar_100` varchar(300) NOT NULL,
  `user_ref` int(50) NOT NULL,
  `ot_kuda_prishel` varchar(70) NOT NULL DEFAULT '0',
  `user_email` varchar(100) NOT NULL,
  `chek_ban` int(1) DEFAULT '0',
  `user_login` varchar(50) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  `user_sol` char(3) NOT NULL,
  `user_payeer` text NOT NULL,
  `last_bonus` int(14) NOT NULL,
  `last_payout` int(14) NOT NULL,
  `user_regtime` int(14) NOT NULL,
  `reg_date` date NOT NULL,
  `user_vizit` datetime NOT NULL,
  `user_total_zarabotok` float(11,4) NOT NULL DEFAULT '0.0000',
  `user_prava` int(1) NOT NULL DEFAULT '0',
  `user_ip` varchar(15) NOT NULL,
  `total_play_game` int(10) NOT NULL DEFAULT '0',
  `total_roulette_win` int(10) NOT NULL DEFAULT '0',
  `total_roulette_lost` int(10) NOT NULL DEFAULT '0',
  `total_roulette_money` float(11,2) NOT NULL DEFAULT '0.00',
  `user_balance` float(11,4) NOT NULL DEFAULT '0.0000',
  `total_ref_money` float(14,4) NOT NULL DEFAULT '0.0000',
  `notification` int(1) NOT NULL DEFAULT '1',
  `ref_link_trek` int(10) NOT NULL DEFAULT '0',
  `ref_link_money` float(11,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
