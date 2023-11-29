-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29-Nov-2023 às 00:18
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastroprodutos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_xppd`
--

DROP TABLE IF EXISTS `admin_xppd`;
CREATE TABLE IF NOT EXISTS `admin_xppd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `admin_xppd`
--

INSERT INTO `admin_xppd` (`id`, `username`, `password`) VALUES
(1, 'AdminXppd2023', 'P@ssw0rd!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `pagamentoid` int NOT NULL AUTO_INCREMENT,
  `pedido_idpedido` int NOT NULL,
  `prodrutos_idprodrutos` int NOT NULL,
  PRIMARY KEY (`pagamentoid`,`pedido_idpedido`,`prodrutos_idprodrutos`),
  KEY `pedido_idpedido` (`pedido_idpedido`),
  KEY `prodrutos_idprodrutos` (`prodrutos_idprodrutos`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`pagamentoid`, `pedido_idpedido`, `prodrutos_idprodrutos`) VALUES
(4, 39, 24),
(5, 39, 25),
(6, 39, 26),
(7, 40, 24),
(8, 40, 25),
(9, 40, 26),
(10, 41, 25),
(11, 42, 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `total` int DEFAULT NULL,
  PRIMARY KEY (`idpedido`,`usuarios_id`),
  KEY `usuarios_id` (`usuarios_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idpedido`, `usuarios_id`, `total`) VALUES
(42, 11, 20000),
(41, 11, 20000),
(40, 10, 47000),
(39, 8, 47000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_prod` int NOT NULL AUTO_INCREMENT,
  `nome_prod` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `preco_prod` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `url_prod` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_prod`, `nome_prod`, `preco_prod`, `url_prod`) VALUES
(24, 'Mochila em Re-Nylon e pele de carneiro', '16500', 'https://www.prada.com/content/dam/pradabkg_products/1/1BZ/1BZ074/K4DF0F24/1BZ074_K4D_F0F24_V_O1M_SLF.jpg/_jcr_content/renditions/cq5dam.web.hebebed.1000.1000.jpg'),
(25, 'Mini bolsa em veludo', '10000', 'https://www.prada.com/content/dam/pradabkg_products/1/1BC/1BC204/2CXGF0002/1BC204_2CXG_F0002_V_JOO_SLF.jpg/_jcr_content/renditions/cq5dam.web.hebebed.1000.1000.jpg'),
(26, 'Blusa sem mangas em lã e cashmere', '20500', 'https://www.prada.com/content/dam/pradabkg_products/P/P29/P29A75/136LF0065/P29A75_136L_F0065_S_OOO_SLF.jpg/_jcr_content/renditions/cq5dam.web.hebebed.1000.1000.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `img_user` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_user`, `email_user`, `senha_user`, `img_user`) VALUES
(10, 'asdsada', 'maria.jungbluth@icloud.com', '$2y$10$lquDQNk7XL6GNoClwKOk2O23VjcgVNlnqAluav.FKlD0NbLR2dsVa', '2f95d06d0012fc1b31a12e0c0e6a691b.jpg'),
(11, 'Dudoca', 'maria.jungbluth@icloud.comwe', '$2y$10$ZwVY8uxwuKZlA.vgQOjIfeEi1v07P1cqHTTK6SgOaXLz1vzIuUXwS', 'bb2fd3291ccdfb7008200ec9ea142d33.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
