-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Abr-2023 às 18:05
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `recrutamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `long_name` text DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bank`
--

INSERT INTO `bank` (`bank_id`, `long_name`, `name`) VALUES
(1, 'Banco do Brasil', 'Banco do Brasil'),
(2, 'Santander', 'Santander'),
(3, 'Itaú', 'Itaú'),
(4, 'Caixa', 'Caixa'),
(5, 'Bradesco', 'Bradesco'),
(6, 'NuBank', 'NuBank'),
(7, 'Inter', 'Inter'),
(8, 'C6', 'C6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bank_account`
--

CREATE TABLE `bank_account` (
  `bank_account_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `type_account_id` int(11) NOT NULL,
  `agencia` varchar(10) NOT NULL,
  `conta` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bank_account`
--

INSERT INTO `bank_account` (`bank_account_id`, `customer_id`, `bank_id`, `type_account_id`, `agencia`, `conta`) VALUES
(8, 3, 3, 2, '0123', '032371'),
(10, 3, 2, 2, '0123', '74123-1'),
(13, 3, 8, 3, '01223', '1231-1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` text DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `email`, `password`, `telephone`) VALUES
(1, 'jose', 'ndonge', 'josedomingos919@gmail.com', '81e13e3ebae95b28a5ba2f3698d0a73a', '944666640'),
(2, 'decolip', 'decolip', 'decolip@gmail.com', '81e13e3ebae95b28a5ba2f3698d0a73a', '999666640'),
(3, 'Ronan', 'Salvador', 'ronan@teste.com', 'e10adc3949ba59abbe56e057f20f883e', '11994963639'),
(7, 'Mateus', 'Souza', 'mateus@teste.com', 'e10adc3949ba59abbe56e057f20f883e', '11123456789'),
(8, 'user', 'teste', 'user@teste.com', 'e10adc3949ba59abbe56e057f20f883e', '1191234556'),
(9, 'user2', 'teste', 'user2@teste.com', 'e10adc3949ba59abbe56e057f20f883e', '11991231231');

-- --------------------------------------------------------

--
-- Estrutura da tabela `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `history_type_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `history`
--

INSERT INTO `history` (`history_id`, `transaction_id`, `customer_id`, `history_type_id`, `note`, `status`, `date_added`) VALUES
(1, 1, 1, 1, 'Produto Vendido', 1, '2020-02-20 10:10:10'),
(2, 5, 1, 2, 'Venda Cancelada', 1, '2020-03-12 10:10:10'),
(3, 6, 1, 3, 'Problema com o produto', 1, '2020-01-23 10:10:10'),
(4, 7, 1, 4, 'Transferência Bancária', 1, '2020-02-02 10:10:10'),
(5, 8, 1, 7, 'Ajuste Valor descontado sem querer', 1, '2020-03-18 10:10:10'),
(6, 10, 3, 4, 'Transferência Bancária', 1, '2023-04-04 16:24:12'),
(7, 11, 3, 4, 'Transferência Bancária', 1, '2023-04-04 16:26:40'),
(8, 12, 3, 4, 'Transferência Bancária', 1, '2023-04-04 17:14:13'),
(9, 13, 3, 4, 'Transferência Bancária', 1, '2023-04-04 17:36:04'),
(10, 14, 3, 4, 'Transferência Bancária', 1, '2023-04-04 17:36:31'),
(11, 15, 3, 4, 'Transferência Bancária', 1, '2023-04-04 17:45:37'),
(12, 16, 3, 4, 'Transferência Bancária', 1, '2023-04-04 18:58:26'),
(13, 17, 3, 4, 'Transferência Bancária', 1, '2023-04-05 12:16:49'),
(14, 18, 3, 4, 'Transferência Bancária', 1, '2023-04-05 14:17:45'),
(15, 19, 3, 4, 'Transferência Bancária', 1, '2023-04-05 14:47:02'),
(16, 20, 3, 4, 'Transferência Bancária', 1, '2023-04-05 18:03:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `history_type`
--

CREATE TABLE `history_type` (
  `history_type_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `history_type`
--

INSERT INTO `history_type` (`history_type_id`, `name`, `description`, `color`) VALUES
(1, 'PRODUCT_SOLD', 'Valor Líquido de Venda', '#b9e8b9'),
(2, 'PRODUCT_SOLD_CANCELED', 'Venda Cancelada', '#e8b9b9'),
(3, 'PRODUCT_SOLD_REFUNDED', 'Venda Reembolsada', '#e8b9b9'),
(4, 'TRANSFER_TO_BANK_ACCOUNT_REQUEST', 'Solicitação de transferência para conta bancária', '#e8e4b9'),
(5, 'TRANSFER_TO_BANK_ACCOUNT_CANCELED', 'Devolução de transferência para conta bancária', '#e8b9b9'),
(6, 'TRANSFER_TO_BANK_ACCOUNT_COMPLETED', 'Transferência para conta bancária', '#b9e8b9'),
(7, 'BALANCE_ADJUSTMENT', 'Ajuste de Saldo', '#8df3f2'),
(8, 'BALANCE_ADJUSTMENT_CANCELED', 'Ajuste de Saldo Cancelado', '#e8b9b9'),
(9, 'PRODUCT_SOLD_PARTIALLY_REFUNDED', 'Venda Parcialmente Reembolsada', '#ffff'),
(10, 'USED_TO_BUY', 'Usado para compra', '#ffff');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `total`, `status`) VALUES
(3, 1, 660, 1),
(2, 1, 990, 1),
(1, 1, 1980, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `order_product`
--

INSERT INTO `order_product` (`order_product_id`, `order_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, 1, 1, 2, 990, 1980),
(2, 2, 2, 3, 330, 990),
(3, 3, 3, 1, 660, 660);

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `quantity`, `image`, `price`, `status`) VALUES
(1, 'Sandália Charlotte Olympia Bruce Vermelho', 'Sapato seminovo, em ótimo estado de conservação. Possui sola gasta e sinais de uso na palmilha. Não acompanha dustbag. Sola 37 Europa. Salto 16cm.', 5, 'https://dptafza4tn3d0.cloudfront.net/cache/catalog/CV15205/vestido-dolce-gabbana-margaridas-%20(2)-250x313.jpg', 990, 1),
(2, 'Sapato Tory Burch Peep Toe Preto', 'Produto seminovo, em ótimo estado de conservação, com alguns desfiadinhos na costura do salto e leve desgaste na sola.', 6, 'https://dptafza4tn3d0.cloudfront.net/cache/catalog/CV22311/sapato-tory-burch-peep-toe-preto-CV22311(1)-640x800.JPG', 330, 1),
(3, 'Conjunto Saia e Blusa Estampa Tory Burch', 'Produto Seminovo em ótimo estado.', 8, 'https://dptafza4tn3d0.cloudfront.net/cache/catalog/1519/conjunto-saia-e-blusa-estampa-tory-burch-640x800.jpg', 660, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `customer_id`, `order_id`, `product_id`, `transfer_id`, `value`, `status`, `date_added`) VALUES
(6, 3, 3, 3, NULL, 660, 1, '2020-03-20 10:10:10'),
(5, 3, 2, 2, NULL, 990, 1, '2020-03-20 10:10:10'),
(1, 3, 1, 1, NULL, 1980, 1, '2020-03-20 10:10:10'),
(7, 1, NULL, NULL, 4, 500, 1, '2020-03-20 10:10:10'),
(8, 1, NULL, NULL, 5, 200, 1, '2020-03-20 10:10:10'),
(9, 3, NULL, NULL, 14, 101, 1, '2023-04-04 16:17:00'),
(10, 3, NULL, NULL, 15, 150, 1, '2023-04-04 16:24:12'),
(11, 3, NULL, NULL, 16, 150, 1, '2023-04-04 16:26:40'),
(12, 3, NULL, NULL, 17, 205, 1, '2023-04-04 17:14:13'),
(13, 3, NULL, NULL, 18, 200, 1, '2023-04-04 17:36:04'),
(14, 3, NULL, NULL, 19, 200.01, 1, '2023-04-04 17:36:31'),
(15, 3, NULL, NULL, 20, 201.5, 1, '2023-04-04 17:45:37'),
(16, 3, NULL, NULL, 21, 1000.5, 1, '2023-04-04 18:58:26'),
(17, 3, NULL, NULL, 22, 100, 1, '2023-04-05 12:16:49'),
(18, 3, NULL, NULL, 23, 2000, 1, '2023-04-05 14:17:45'),
(19, 3, NULL, NULL, 24, 150.31, 1, '2023-04-05 14:47:02'),
(20, 3, NULL, NULL, 25, 150, 1, '2023-04-05 18:03:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transfer`
--

INSERT INTO `transfer` (`transfer_id`, `customer_id`, `bank_account_id`, `amount`, `status`) VALUES
(5, 1, 1, 200, 1),
(4, 1, 1, 500, 1),
(7, 3, 10, 200, 1),
(8, 3, 8, 120, 1),
(9, 3, 8, 121, 1),
(10, 3, 8, 100, 1),
(11, 3, 8, 200, 1),
(12, 3, 8, 200, 1),
(13, 3, 10, 120, 1),
(14, 3, 8, 101, 1),
(15, 3, 10, 150, 1),
(16, 3, 10, 150, 1),
(17, 3, 8, 205, 1),
(18, 3, 8, 200, 1),
(19, 3, 10, 200.01, 1),
(20, 3, 8, 201.5, 1),
(21, 3, 8, 1000.5, 1),
(22, 3, 8, 100, 1),
(23, 3, 8, 2000, 1),
(24, 3, 8, 150.31, 1),
(25, 3, 13, 150, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `type_account`
--

CREATE TABLE `type_account` (
  `type_account_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `type_account`
--

INSERT INTO `type_account` (`type_account_id`, `name`) VALUES
(1, 'Conta Corrente'),
(2, 'Conta Poupança'),
(3, 'Conta Salário');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`),
  ADD UNIQUE KEY `unique_bank_name` (`name`);

--
-- Índices para tabela `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`bank_account_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `type_account_id` (`type_account_id`);

--
-- Índices para tabela `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `history_type_id` (`history_type_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Índices para tabela `history_type`
--
ALTER TABLE `history_type`
  ADD PRIMARY KEY (`history_type_id`);

--
-- Índices para tabela `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Índices para tabela `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`);

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Índices para tabela `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Índices para tabela `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `bank_account_id` (`bank_account_id`);

--
-- Índices para tabela `type_account`
--
ALTER TABLE `type_account`
  ADD PRIMARY KEY (`type_account_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `bank_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `history_type`
--
ALTER TABLE `history_type`
  MODIFY `history_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `transfer`
--
ALTER TABLE `transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `type_account`
--
ALTER TABLE `type_account`
  MODIFY `type_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
