-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 11/06/2025 às 02:14
-- Versão do servidor: 8.0.41
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logradouro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uf` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ibge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ddd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `addresses`
--

INSERT INTO `addresses` (`id`, `order_id`, `cep`, `logradouro`, `complemento`, `bairro`, `localidade`, `uf`, `estado`, `ibge`, `ddd`, `created_at`, `updated_at`) VALUES
(1, 12, '74934-150', 'Rua 20', '', 'Cardoso Continuação', 'Aparecida de Goiânia', 'GO', 'Goiás', '5201405', '62', '2025-06-11 01:10:45', '2025-06-11 01:10:45'),
(2, 13, '74934-150', 'Rua 20', '', 'Cardoso Continuação', 'Aparecida de Goiânia', 'GO', 'Goiás', '5201405', '62', '2025-06-11 01:13:11', '2025-06-11 01:13:11'),
(3, 14, '74934-150', 'Rua 20', '', 'Cardoso Continuação', 'Aparecida de Goiânia', 'GO', 'Goiás', '5201405', '62', '2025-06-11 01:16:09', '2025-06-11 01:16:09'),
(4, 15, '74934-150', 'Rua 20', '', 'Cardoso Continuação', 'Aparecida de Goiânia', 'GO', 'Goiás', '5201405', '62', '2025-06-11 01:44:03', '2025-06-11 01:44:03'),
(5, 16, '74934-150', 'Rua 20', '', 'Cardoso Continuação', 'Aparecida de Goiânia', 'GO', 'Goiás', '5201405', '62', '2025-06-11 01:51:23', '2025-06-11 01:51:23'),
(6, 17, '74934-150', 'Rua 20', '', 'Cardoso Continuação', 'Aparecida de Goiânia', 'GO', 'Goiás', '5201405', '62', '2025-06-11 01:52:00', '2025-06-11 01:52:00'),
(7, 18, '74350-650', 'Alameda Fleury Curado', '', 'Setor Faiçalville', 'Goiânia', 'GO', 'Goiás', '5208707', '62', '2025-06-11 02:00:15', '2025-06-11 02:00:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `min_subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valid_until` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `min_subtotal`, `valid_until`, `created_at`, `updated_at`) VALUES
(1, 'APPNINJA', 5.00, 100.00, '2025-06-30', '2025-06-11 00:31:57', '2025-06-11 00:31:57'),
(2, 'IPHONE200', 30.00, 150.00, '2025-06-30', '2025-06-11 02:06:21', '2025-06-11 02:06:21'),
(3, 'MONITOR5', 20.00, 25.00, '2025-07-12', '2025-06-11 02:06:55', '2025-06-11 02:06:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_06_09_230855_create_products_table', 1),
(7, '2025_06_09_230855_create_stocks_table', 1),
(8, '2025_06_09_230856_create_coupons_table', 1),
(9, '2025_06_09_230856_create_orders_table', 1),
(10, '2025_06_10_001532_create_order_items_table', 1),
(11, '2025_06_11_010324_create_addresses_table', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('CARRINHO','AGUARDANDO_PAGAMENTO','CANCELADO','PAGAMENTO_REALIZADO','ENTREGUE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CARRINHO',
  `subtotal` decimal(10,2) NOT NULL,
  `freight` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `user_id`, `status`, `subtotal`, `freight`, `total`, `cep`, `coupon_id`, `created_at`, `updated_at`) VALUES
(1, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74934-150', NULL, '2025-06-11 00:38:54', '2025-06-11 00:38:54'),
(2, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74934-150', NULL, '2025-06-11 00:39:07', '2025-06-11 00:39:07'),
(3, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74934-150', NULL, '2025-06-11 00:39:47', '2025-06-11 00:39:47'),
(4, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74934-150', NULL, '2025-06-11 00:42:08', '2025-06-11 00:42:08'),
(5, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74922320', NULL, '2025-06-11 00:43:17', '2025-06-11 00:43:17'),
(6, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74934-150', NULL, '2025-06-11 00:47:06', '2025-06-11 00:47:06'),
(7, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 500.00, 0.00, 500.00, '74934-150', NULL, '2025-06-11 00:50:06', '2025-06-11 00:50:06'),
(8, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 500.00, 0.00, 500.00, '74934-150', NULL, '2025-06-11 00:50:29', '2025-06-11 00:50:29'),
(9, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 500.00, 0.00, 500.00, '74934-150', NULL, '2025-06-11 00:55:07', '2025-06-11 00:55:07'),
(10, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74934-150', NULL, '2025-06-11 00:55:23', '2025-06-11 00:55:23'),
(11, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74350650', NULL, '2025-06-11 00:57:14', '2025-06-11 00:57:14'),
(12, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 25.00, 20.00, 45.00, '74934-150', NULL, '2025-06-11 01:10:44', '2025-06-11 01:10:44'),
(13, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 25.00, 20.00, 45.00, '74934-150', NULL, '2025-06-11 01:13:10', '2025-06-11 01:13:10'),
(14, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 25.00, 20.00, 45.00, '74934-150', NULL, '2025-06-11 01:16:08', '2025-06-11 01:16:08'),
(15, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 50.00, 20.00, 70.00, '74934-150', NULL, '2025-06-11 01:44:03', '2025-06-11 01:44:03'),
(16, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 0.00, 20.00, 20.00, '74934-150', NULL, '2025-06-11 01:51:22', '2025-06-11 01:51:22'),
(17, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 25.00, 20.00, 45.00, '74934-150', NULL, '2025-06-11 01:51:59', '2025-06-11 01:51:59'),
(18, 'VUuvfHTgvvGXoaZwx6aPsUNbfdiwFp6aI1HJoBqt', NULL, 'AGUARDANDO_PAGAMENTO', 200.00, 20.00, 215.00, '74350650', NULL, '2025-06-11 02:00:11', '2025-06-11 02:00:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 7, 9, 1, 500.00, '2025-06-11 00:50:06', '2025-06-11 00:50:06'),
(2, 8, 9, 1, 500.00, '2025-06-11 00:50:29', '2025-06-11 00:50:29'),
(3, 9, 9, 1, 500.00, '2025-06-11 00:55:07', '2025-06-11 00:55:07'),
(4, 12, 1, 1, 25.00, '2025-06-11 01:10:44', '2025-06-11 01:10:44'),
(5, 13, 1, 1, 25.00, '2025-06-11 01:13:10', '2025-06-11 01:13:10'),
(6, 14, 1, 1, 25.00, '2025-06-11 01:16:08', '2025-06-11 01:16:08'),
(7, 15, 1, 2, 25.00, '2025-06-11 01:44:03', '2025-06-11 01:44:03'),
(8, 17, 1, 1, 25.00, '2025-06-11 01:51:59', '2025-06-11 01:51:59'),
(9, 18, 2, 1, 200.00, '2025-06-11 02:00:11', '2025-06-11 02:00:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Cadeira', 25.00, '2025-06-10 00:48:39', '2025-06-10 00:48:39'),
(2, 'Mesa', 200.00, '2025-06-10 00:48:59', '2025-06-10 00:48:59'),
(8, 'Sofa', 2500.00, '2025-06-11 00:29:53', '2025-06-11 00:29:53'),
(9, 'Estante', 500.00, '2025-06-11 00:32:29', '2025-06-11 00:32:29'),
(10, 'Monitor', 800.00, '2025-06-11 02:07:16', '2025-06-11 02:07:16'),
(11, 'Iphone 15 Apple, 128GB', 4319.00, '2025-06-11 02:08:41', '2025-06-11 02:08:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `variation`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'madeira', 4, '2025-06-10 00:48:39', '2025-06-11 01:51:59'),
(2, 2, 'madeira', 4, '2025-06-10 00:48:59', '2025-06-11 02:00:11'),
(8, 8, 'Sala', 10, '2025-06-11 00:29:53', '2025-06-11 00:29:53'),
(9, 9, 'Sala', 1, '2025-06-11 00:32:29', '2025-06-11 00:55:07'),
(10, 10, 'Informatica', 10, '2025-06-11 02:07:16', '2025-06-11 02:07:16'),
(11, 11, 'SmartPhone', 5, '2025-06-11 02:08:41', '2025-06-11 02:08:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Renato de Oliveira Lucena', 'cpdrenato@gmail.com', NULL, '$2y$10$KfhLC/zZRYEhsfKipuYkouG3CpjH15iHJqVr/i.T5nxQ6lVA8kmku', NULL, '2025-06-11 00:30:10', '2025-06-11 00:30:10');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_order_id_foreign` (`order_id`);

--
-- Índices de tabela `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`);

--
-- Índices de tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
