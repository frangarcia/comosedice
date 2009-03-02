-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-03-2009 a las 18:39:15
-- Versión del servidor: 3.23.32
-- Versión de PHP: 5.2.4-2ubuntu5.5


--
-- Base de datos: `comosedice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comosedice_examples`
--

CREATE TABLE IF NOT EXISTS `comosedice_examples` (
  `id` int(11) NOT NULL auto_increment,
  `src_lang` varchar(200) NOT NULL,
  `dest_lang` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `translation` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comosedice_links`
--

CREATE TABLE IF NOT EXISTS `comosedice_links` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comosedice_messages`
--

CREATE TABLE IF NOT EXISTS `comosedice_messages` (
  `id` int(11) NOT NULL auto_increment,
  `phonenumber` varchar(12) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `src_lang` varchar(3) NOT NULL,
  `dest_lang` varchar(3) NOT NULL,
  `translation` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comosedice_news`
--

CREATE TABLE IF NOT EXISTS `comosedice_news` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `language` varchar(200) NOT NULL default 'es',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comosedice_users`
--

CREATE TABLE IF NOT EXISTS `comosedice_users` (
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `secretcode` text NOT NULL,
  PRIMARY KEY  (`phonenumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
