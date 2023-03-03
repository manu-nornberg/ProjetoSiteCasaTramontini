-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jan-2023 às 00:43
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod_end` int(11) NOT NULL,
  `cep` int(10) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `cod_pessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cod_end`, `cep`, `estado`, `municipio`, `bairro`, `rua`, `numero`, `complemento`, `cod_pessoa`) VALUES
(6, 96030000, 'RS', 'Fragata', 'Pelotas', 'Avenida Duque de Caxias', 788, '', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `cod_pedido` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `cod_pessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `cod_pessoa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `tipo` int(1) NOT NULL DEFAULT 1,
  `imagem` varchar(100) DEFAULT 'foto.png',
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`cod_pessoa`, `nome`, `sobrenome`, `dt_nasc`, `email`, `senha`, `telefone`, `cpf`, `tipo`, `imagem`, `status`) VALUES
(1, 'Casa Tramontini', NULL, NULL, 'argelymanu@gmail.com', '$2y$10$zgenz4HXoFuWN4ctpE0Q/ehiohWfjzj/j7WlV9/JOWE/rYO9R/Hfa', NULL, NULL, 0, 'icone.png', 1),
(13, 'Manu', 'Nörnberg', '1999-12-17', 'emanuelleporto10@gmail.com', '$2y$10$XVLgnzXnoO5QNsbHKL60h.EswIxqkyuKwbxMuYT5pB.ONBHeQu45u', NULL, '048.263.200-35', 1, '2ba1930cba1b2dd2af73d658b958fe64.jpg', 1),
(18, 'argel', 'MOZAO DA VIDA DELA', '1212-02-21', 'argelhr@hotmail.com', '$2y$10$EvVqcVeAsYLAS/Tk4wGQpe1Iu7nTXEPgw0b7T9flYltLAXNEa9ATi', NULL, '212.121.231-21', 1, '2ba1930cba1b2dd2af73d658b958fe64.jpg', 1),
(19, '123', '123123', '1231-03-12', '123@gmail.com', '$2y$10$U/kcVUjsoxoQTxpz2DklQ.JUOkHhfbxl.qifEnDJlrnfv0g56dU2q', NULL, '123.123.123-12', 1, 'agro.png', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `cod_prod` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `preco` decimal(7,2) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `imagem` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`cod_prod`, `nome`, `descricao`, `preco`, `categoria`, `imagem`) VALUES
(17, 'Aneis', 'Aneis para cilindro', '5.00', 'maritimo', 'aneis.jpg'),
(18, 'Cabeçote', 'Cabeçote do motor', '500.00', 'agricola', 'cabeçote.jpg'),
(19, 'Disco', 'Disco de embreagem para motor', '120.00', 'agricola', 'disco.jpg'),
(20, 'Elemento da bomba', 'Elemento da bomba para motores', '14.00', 'agricola', 'elemento.jpg'),
(21, 'Conjunto ', 'kits completo, com anel, cilindro e pistão', '400.00', 'agricola', 'kits.jpg'),
(22, 'Retentor', 'Retentor M25', '30.00', 'maritimo', 'retentor.jpg'),
(23, 'Rolamento', 'Rolamento para motor', '80.00', 'maritimo', 'rolamento.jpg'),
(24, 'Tanque de combustível', 'Tanque de combustível para motor Branco', '200.00', 'maritimo', 'tanque.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prod_ped`
--

CREATE TABLE `prod_ped` (
  `codigo` int(11) NOT NULL,
  `qnt` int(11) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `cod_prod` int(11) NOT NULL DEFAULT 0,
  `cod_pedido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao`
--

CREATE TABLE `requisicao` (
  `email` varchar(50) NOT NULL,
  `token` int(100) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `requisicao`
--

INSERT INTO `requisicao` (`email`, `token`) VALUES
('argelhr@hotmail.com', 786),
('emanuelleporto10@gmail.com', 930);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cod_end`),
  ADD KEY `cod_pessoa` (`cod_pessoa`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`cod_pedido`),
  ADD KEY `cod_pessoa` (`cod_pessoa`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`cod_pessoa`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`cod_prod`);

--
-- Índices para tabela `prod_ped`
--
ALTER TABLE `prod_ped`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `cod_prod` (`cod_prod`),
  ADD KEY `cod_pedido` (`cod_pedido`);

--
-- Índices para tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod_end` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `cod_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `cod_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `cod_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `prod_ped`
--
ALTER TABLE `prod_ped`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`cod_pessoa`) REFERENCES `pessoas` (`cod_pessoa`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cod_pessoa`) REFERENCES `pessoas` (`cod_pessoa`);

--
-- Limitadores para a tabela `prod_ped`
--
ALTER TABLE `prod_ped`
  ADD CONSTRAINT `prod_ped_ibfk_1` FOREIGN KEY (`cod_prod`) REFERENCES `produtos` (`cod_prod`),
  ADD CONSTRAINT `prod_ped_ibfk_2` FOREIGN KEY (`cod_pedido`) REFERENCES `pedidos` (`cod_pedido`);

--
-- Limitadores para a tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD CONSTRAINT `requisicao_ibfk_1` FOREIGN KEY (`email`) REFERENCES `pessoas` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
