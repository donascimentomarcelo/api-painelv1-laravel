-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Maio-2017 às 03:43
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juniorm1_programmer`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_05_11_162645_create_projects_table', 2),
('2017_05_11_162646_create_uploads_table', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `projects`
--

INSERT INTO `projects` (`id`, `category`, `name`, `link`, `description`, `created_at`, `updated_at`) VALUES
(14, 'Aplicativo', 'New Project', 'www.playstore.com', 'Loren Ipsun...', '2017-05-14 00:09:12', '2017-05-14 00:09:12'),
(15, 'Web Site', 'New Project', 'www.website.com', 'Loren Ipsun...', '2017-05-14 00:09:12', '2017-05-14 00:09:12'),
(16, 'Sistema', 'New Project', 'www.sistema.com', 'Loren Ipsun...', '2017-05-14 00:09:12', '2017-05-14 00:09:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uploads`
--

CREATE TABLE `uploads` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `way` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projects_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `way`, `mime`, `original_filename`, `projects_id`, `created_at`, `updated_at`) VALUES
(4, 'php64D2.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '7679719272938074684283498447890h765834824687940690517849.PNG', 14, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(5, 'php6560.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '774396984800953636225975615476441758864258124656206543142968.PNG', 14, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(6, 'php6570.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '206428908933892659599365548134901359825970m756978786859896.PNG', 14, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(7, 'php64D2.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '7679719272938074684283498447890h765834824687940690517849.PNG', 15, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(8, 'php6560.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '774396984800953636225975615476441758864258124656206543142968.PNG', 15, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(9, 'php6570.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '206428908933892659599365548134901359825970m756978786859896.PNG', 15, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(10, 'php64D2.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '7679719272938074684283498447890h765834824687940690517849.PNG', 16, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(11, 'php6560.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '774396984800953636225975615476441758864258124656206543142968.PNG', 16, '2017-05-14 00:09:13', '2017-05-14 00:09:13'),
(12, 'php6570.tmp.PNG', 'http://localhost:8000/uploads/project/', 'image/png', '206428908933892659599365548134901359825970m756978786859896.PNG', 16, '2017-05-14 00:09:13', '2017-05-14 00:09:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Marcelo', 'marcelojunin2010@hotmail.com', '$2y$10$bJGweb2UZxfD87NGGkM15.H3nN9dSy1AXpc.//7auk67OE6TMXA7e', 'admin', '6pa86DZfMJPgD4cWfb8Cw1e4vTxs9880xWwI52ksNXUtOhSCrT3zaMSkpsNy', '2017-05-10 03:25:36', '2017-05-10 04:24:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploads_projects_id_foreign` (`projects_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_projects_id_foreign` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
