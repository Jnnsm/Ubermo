-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Nov-2017 às 01:12
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` varchar(120) DEFAULT NULL,
  `Servico Contratado_id` int(11) NOT NULL,
  `Servico Contratado_Cliente_email` varchar(255) NOT NULL,
  `Servico Contratado_Servico Ofertado_id` int(11) NOT NULL,
  `Servico Contratado_Servico Ofertado_Prestador_email` varchar(255) NOT NULL,
  `Servico Contratado_Servico Ofertado_Servico_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao`
--

CREATE TABLE `cartao` (
  `id` int(11) NOT NULL,
  `mesVencimento` int(11) NOT NULL,
  `anoVencimento` int(11) NOT NULL,
  `codSeguranca` varchar(50) NOT NULL,
  `numeroCartao` varchar(255) NOT NULL,
  `Cliente_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `foto` varchar(1024) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `pontuacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_has_endereco`
--

CREATE TABLE `cliente_has_endereco` (
  `Cliente_email` varchar(255) NOT NULL,
  `Endereco_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_has_telefone`
--

CREATE TABLE `cliente_has_telefone` (
  `Cliente_email` varchar(255) NOT NULL,
  `Telefone_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `complemento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prestador`
--

CREATE TABLE `prestador` (
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `foto` varchar(1024) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  `agencia` varchar(255) NOT NULL,
  `nconta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prestador_has_endereco`
--

CREATE TABLE `prestador_has_endereco` (
  `Prestador_email` varchar(255) NOT NULL,
  `Endereco_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prestador_has_telefone`
--

CREATE TABLE `prestador_has_telefone` (
  `Prestador_email` varchar(255) NOT NULL,
  `Telefone_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico contratado`
--

CREATE TABLE `servico contratado` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `Cliente_has_Endereco_Cliente_email` varchar(255) NOT NULL,
  `Cliente_has_Endereco_Endereco_id` int(11) NOT NULL,
  `Cliente_email` varchar(255) NOT NULL,
  `Servico Ofertado_id` int(11) NOT NULL,
  `Servico Ofertado_Prestador_email` varchar(255) NOT NULL,
  `Servico Ofertado_Servico_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico ofertado`
--

CREATE TABLE `servico ofertado` (
  `id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `Prestador_email` varchar(255) NOT NULL,
  `Servico_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE `telefone` (
  `id` int(11) NOT NULL,
  `numero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id`,`Servico Contratado_id`,`Servico Contratado_Cliente_email`,`Servico Contratado_Servico Ofertado_id`,`Servico Contratado_Servico Ofertado_Prestador_email`,`Servico Contratado_Servico Ofertado_Servico_id`),
  ADD KEY `fk_Avaliacao_Servico Contratado1_idx` (`Servico Contratado_id`,`Servico Contratado_Cliente_email`,`Servico Contratado_Servico Ofertado_id`,`Servico Contratado_Servico Ofertado_Prestador_email`,`Servico Contratado_Servico Ofertado_Servico_id`);

--
-- Indexes for table `cartao`
--
ALTER TABLE `cartao`
  ADD PRIMARY KEY (`id`,`Cliente_email`),
  ADD KEY `fk_Cartão_Cliente1_idx` (`Cliente_email`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `cliente_has_endereco`
--
ALTER TABLE `cliente_has_endereco`
  ADD PRIMARY KEY (`Cliente_email`,`Endereco_id`),
  ADD KEY `fk_Cliente_has_Endereco_Endereco1_idx` (`Endereco_id`),
  ADD KEY `fk_Cliente_has_Endereco_Cliente1_idx` (`Cliente_email`);

--
-- Indexes for table `cliente_has_telefone`
--
ALTER TABLE `cliente_has_telefone`
  ADD PRIMARY KEY (`Cliente_email`,`Telefone_id`),
  ADD KEY `fk_Cliente_has_Telefone_Telefone1_idx` (`Telefone_id`),
  ADD KEY `fk_Cliente_has_Telefone_Cliente1_idx` (`Cliente_email`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestador`
--
ALTER TABLE `prestador`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `prestador_has_endereco`
--
ALTER TABLE `prestador_has_endereco`
  ADD PRIMARY KEY (`Prestador_email`,`Endereco_id`),
  ADD KEY `fk_Prestador_has_Endereco_Endereco1_idx` (`Endereco_id`),
  ADD KEY `fk_Prestador_has_Endereco_Prestador1_idx` (`Prestador_email`);

--
-- Indexes for table `prestador_has_telefone`
--
ALTER TABLE `prestador_has_telefone`
  ADD PRIMARY KEY (`Prestador_email`,`Telefone_id`),
  ADD KEY `fk_Prestador_has_Telefone_Telefone1_idx` (`Telefone_id`),
  ADD KEY `fk_Prestador_has_Telefone_Prestador1_idx` (`Prestador_email`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servico contratado`
--
ALTER TABLE `servico contratado`
  ADD PRIMARY KEY (`id`,`Cliente_email`,`Servico Ofertado_id`,`Servico Ofertado_Prestador_email`,`Servico Ofertado_Servico_id`),
  ADD KEY `fk_Servico Contratado_Cliente_has_Endereco1_idx` (`Cliente_has_Endereco_Cliente_email`,`Cliente_has_Endereco_Endereco_id`),
  ADD KEY `fk_Servico Contratado_Cliente1_idx` (`Cliente_email`),
  ADD KEY `fk_Servico Contratado_Servico Ofertado1_idx` (`Servico Ofertado_id`,`Servico Ofertado_Prestador_email`,`Servico Ofertado_Servico_id`);

--
-- Indexes for table `servico ofertado`
--
ALTER TABLE `servico ofertado`
  ADD PRIMARY KEY (`id`,`Prestador_email`,`Servico_id`),
  ADD KEY `fk_Serviço Ofertado_Prestador1_idx` (`Prestador_email`),
  ADD KEY `fk_Servico Ofertado_Servico1_idx` (`Servico_id`);

--
-- Indexes for table `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cartao`
--
ALTER TABLE `cartao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servico contratado`
--
ALTER TABLE `servico contratado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servico ofertado`
--
ALTER TABLE `servico ofertado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `telefone`
--
ALTER TABLE `telefone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_Avaliacao_Servico Contratado1` FOREIGN KEY (`Servico Contratado_id`,`Servico Contratado_Cliente_email`,`Servico Contratado_Servico Ofertado_id`,`Servico Contratado_Servico Ofertado_Prestador_email`,`Servico Contratado_Servico Ofertado_Servico_id`) REFERENCES `servico contratado` (`id`, `Cliente_email`, `Servico Ofertado_id`, `Servico Ofertado_Prestador_email`, `Servico Ofertado_Servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cartao`
--
ALTER TABLE `cartao`
  ADD CONSTRAINT `fk_Cartão_Cliente1` FOREIGN KEY (`Cliente_email`) REFERENCES `cliente` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cliente_has_endereco`
--
ALTER TABLE `cliente_has_endereco`
  ADD CONSTRAINT `fk_Cliente_has_Endereco_Cliente1` FOREIGN KEY (`Cliente_email`) REFERENCES `cliente` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cliente_has_Endereco_Endereco1` FOREIGN KEY (`Endereco_id`) REFERENCES `endereco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cliente_has_telefone`
--
ALTER TABLE `cliente_has_telefone`
  ADD CONSTRAINT `fk_Cliente_has_Telefone_Cliente1` FOREIGN KEY (`Cliente_email`) REFERENCES `cliente` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cliente_has_Telefone_Telefone1` FOREIGN KEY (`Telefone_id`) REFERENCES `telefone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `prestador_has_endereco`
--
ALTER TABLE `prestador_has_endereco`
  ADD CONSTRAINT `fk_Prestador_has_Endereco_Endereco1` FOREIGN KEY (`Endereco_id`) REFERENCES `endereco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Prestador_has_Endereco_Prestador1` FOREIGN KEY (`Prestador_email`) REFERENCES `prestador` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `prestador_has_telefone`
--
ALTER TABLE `prestador_has_telefone`
  ADD CONSTRAINT `fk_Prestador_has_Telefone_Prestador1` FOREIGN KEY (`Prestador_email`) REFERENCES `prestador` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Prestador_has_Telefone_Telefone1` FOREIGN KEY (`Telefone_id`) REFERENCES `telefone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servico contratado`
--
ALTER TABLE `servico contratado`
  ADD CONSTRAINT `fk_Servico Contratado_Cliente1` FOREIGN KEY (`Cliente_email`) REFERENCES `cliente` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Servico Contratado_Cliente_has_Endereco1` FOREIGN KEY (`Cliente_has_Endereco_Cliente_email`,`Cliente_has_Endereco_Endereco_id`) REFERENCES `cliente_has_endereco` (`Cliente_email`, `Endereco_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Servico Contratado_Servico Ofertado1` FOREIGN KEY (`Servico Ofertado_id`,`Servico Ofertado_Prestador_email`,`Servico Ofertado_Servico_id`) REFERENCES `servico ofertado` (`id`, `Prestador_email`, `Servico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servico ofertado`
--
ALTER TABLE `servico ofertado`
  ADD CONSTRAINT `fk_Servico Ofertado_Servico1` FOREIGN KEY (`Servico_id`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Serviço Ofertado_Prestador1` FOREIGN KEY (`Prestador_email`) REFERENCES `prestador` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
