-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 24 jan. 2023 à 10:41
-- Version du serveur : 10.3.35-MariaDB
-- Version de PHP : 8.1.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `ti2`
--

CREATE DATABASE IF NOT EXISTS `ti2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ti2`;

-- --------------------------------------------------------

--
-- Structure de la table `livreor`
--


CREATE TABLE IF NOT EXISTS `livreor` (
                                         `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                         `firstname` varchar(100) NOT NULL,
                                         `lastname` varchar(100) DEFAULT NULL,
                                         `usermail` varchar(200) NOT NULL,
                                         `message` varchar(600) NOT NULL,
                                         `datemessage` datetime NOT NULL DEFAULT current_timestamp(),
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
