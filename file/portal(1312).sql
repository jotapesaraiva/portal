-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 13/12/2017 às 11:15
-- Versão do servidor: 5.5.56-MariaDB
-- Versão do PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portal`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `login`
--

INSERT INTO `login` (`id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'joao.saraiva', 'joao.saraiva@sefa.pa.gov.br', '11admin17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_ad_atributo`
--

CREATE TABLE `tbl_ad_atributo` (
  `id` int(6) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_ad_atributo`
--

INSERT INTO `tbl_ad_atributo` (`id`, `login`, `nome`, `sobrenome`, `email`) VALUES
(1, 'sAMAccountName', 'givenName', 'sN', 'mail');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_ad_replicador`
--

CREATE TABLE `tbl_ad_replicador` (
  `id` int(6) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `porta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_ad_replicador`
--

INSERT INTO `tbl_ad_replicador` (`id`, `nome`, `ip`, `porta`) VALUES
(1, 'x-oc-dc', '10.3.1.25', '389'),
(2, 'x-oc-net', '10.3.1.24', '389'),
(3, 'x-oc-win', '10.3.1.30', '389');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_ad_ user`
--

CREATE TABLE `tbl_ad_ user` (
  `id` int(6) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `basedn` varchar(50) NOT NULL,
  `dominio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_ad_ user`
--

INSERT INTO `tbl_ad_ user` (`id`, `usuario`, `senha`, `basedn`, `dominio`) VALUES
(1, 'dokuwiki', 'wikidoku', 'OU=SEFA-PA,DC=sefa,DC=pa,DC=gov,DC=br', '@sefa.pa.gov.br');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_cargo`
--

CREATE TABLE `tbl_cargo` (
  `id_cargo` int(11) NOT NULL,
  `nome_cargo` varchar(100) NOT NULL,
  `comentario_cargo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_cidade`
--

CREATE TABLE `tbl_cidade` (
  `id_cidade` int(11) NOT NULL,
  `nome_cidade` varchar(100) NOT NULL,
  `comentario_cidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_cidade`
--

INSERT INTO `tbl_cidade` (`id_cidade`, `nome_cidade`, `comentario_cidade`) VALUES
(1, 'Abaetetuba', NULL),
(2, 'Abel Figueiredo', NULL),
(3, 'Acará', NULL),
(4, 'Afuá', NULL),
(5, 'Água Azul do Norte', NULL),
(6, 'Alenquer', NULL),
(7, 'Almeirim', NULL),
(8, 'Altamira', NULL),
(9, 'Anajás', NULL),
(10, 'Ananindeua', NULL),
(11, 'Anapu', NULL),
(12, 'Augusto Corrêa', NULL),
(13, 'Aurora do Pará', NULL),
(14, 'Aveiro', NULL),
(15, 'Bagre', NULL),
(16, 'Baião', NULL),
(17, 'Bannach', NULL),
(18, 'Barcarena', NULL),
(19, 'Belém', NULL),
(20, 'Belterra', NULL),
(21, 'Benevides', NULL),
(22, 'Bom Jesus do Tocantins', NULL),
(23, 'Bonito', NULL),
(24, 'Bragança', NULL),
(25, 'Brasil Novo', NULL),
(26, 'Brejo Grande do Araguaia', NULL),
(27, 'Breu Branco', NULL),
(28, 'Breves', NULL),
(29, 'Bujaru', NULL),
(30, 'Cachoeira do Arari', NULL),
(31, 'Cachoeira do Piriá', NULL),
(32, 'Cametá', NULL),
(33, 'Canaã dos Carajás', NULL),
(34, 'Capanema', NULL),
(35, 'Capitão Poço', NULL),
(36, 'Castanhal', NULL),
(37, 'Chaves', NULL),
(38, 'Colares', NULL),
(39, 'Conceição do Araguaia', NULL),
(40, 'Concórdia do Pará', NULL),
(41, 'Cumaru do Norte', NULL),
(42, 'Curionópolis', NULL),
(43, 'Curralinho', NULL),
(44, 'Curuá', NULL),
(45, 'Curuçá', NULL),
(46, 'Dom Eliseu', NULL),
(47, 'Eldorado do Carajás', NULL),
(48, 'Faro', NULL),
(49, 'Floresta do Araguaia', NULL),
(50, 'Garrafão do Norte', NULL),
(51, 'Goianésia do Pará', NULL),
(52, 'Gurupá', NULL),
(53, 'Igarapé-Açu', NULL),
(54, 'Igarapé-Miri', NULL),
(55, 'Inhangapi', NULL),
(56, 'Ipixuna do Pará', NULL),
(57, 'Irituia', NULL),
(58, 'Itaituba', NULL),
(59, 'Itupiranga', NULL),
(60, 'Jacareacanga', NULL),
(61, 'Jacundá', NULL),
(62, 'Juruti', NULL),
(63, 'Limoeiro do Ajuru', NULL),
(64, 'Mãe do Rio', NULL),
(65, 'Magalhães Barata', NULL),
(66, 'Marabá', NULL),
(67, 'Maracanã', NULL),
(68, 'Marapanim', NULL),
(69, 'Marituba', NULL),
(70, 'Medicilândia', NULL),
(71, 'Melgaço', NULL),
(72, 'Mocajuba', NULL),
(73, 'Moju', NULL),
(74, 'Mojuí dos Campos', NULL),
(75, 'Monte Alegre', NULL),
(76, 'Muaná', NULL),
(77, 'Nova Esperança do Piriá', NULL),
(78, 'Nova Ipixuna', NULL),
(79, 'Nova Timboteua', NULL),
(80, 'Novo Progresso', NULL),
(81, 'Novo Repartimento', NULL),
(82, 'Óbidos', NULL),
(83, 'Oeiras do Pará', NULL),
(84, 'Oriximiná', NULL),
(85, 'Ourém', NULL),
(86, 'Ourilândia do Norte', NULL),
(87, 'Pacajá', NULL),
(88, 'Palestina do Pará', NULL),
(89, 'Paragominas', NULL),
(90, 'Parauapebas', NULL),
(91, 'Pau d`Arco', NULL),
(92, 'Peixe-Boi', NULL),
(93, 'Piçarra', NULL),
(94, 'Placas', NULL),
(95, 'Ponta de Pedras', NULL),
(96, 'Portel', NULL),
(97, 'Porto de Moz', NULL),
(98, 'Prainha', NULL),
(99, 'Primavera', NULL),
(100, 'Quatipuru', NULL),
(101, 'Redenção', NULL),
(102, 'Rio Maria', NULL),
(103, 'Rondon do Pará', NULL),
(104, 'Rurópolis', NULL),
(105, 'Salinópolis', NULL),
(106, 'Salvaterra', NULL),
(107, 'Santa Bárbara do Pará', NULL),
(108, 'Santa Cruz do Arari', NULL),
(109, 'Santa Izabel do Pará', NULL),
(110, 'Santa Luzia do Pará', NULL),
(111, 'Santa Maria das Barreiras', NULL),
(112, 'Santa Maria do Pará', NULL),
(113, 'Santana do Araguaia', NULL),
(114, 'Santarém', NULL),
(115, 'Santarém Novo', NULL),
(116, 'Santo Antônio do Tauá', NULL),
(117, 'São Caetano de Odivelas', NULL),
(118, 'São Domingos do Araguaia', NULL),
(119, 'São Domingos do Capim', NULL),
(120, 'São Félix do Xingu', NULL),
(121, 'São Francisco do Pará', NULL),
(122, 'São Geraldo do Araguaia', NULL),
(123, 'São João da Ponta', NULL),
(124, 'São João de Pirabas', NULL),
(125, 'São João do Araguaia', NULL),
(126, 'São Miguel do Guamá', NULL),
(127, 'São Sebastião da Boa Vista', NULL),
(128, 'Sapucaia', NULL),
(129, 'Senador José Porfírio', NULL),
(130, 'Soure', NULL),
(131, 'Tailândia', NULL),
(132, 'Terra Alta', NULL),
(133, 'Terra Santa', NULL),
(134, 'Tomé-Açu', NULL),
(135, 'Tracuateua', NULL),
(136, 'Trairão', NULL),
(137, 'Tucumã', NULL),
(138, 'Tucuruí', NULL),
(139, 'Ulianópolis', NULL),
(140, 'Uruará', NULL),
(141, 'Vigia', NULL),
(142, 'Viseu', NULL),
(143, 'Vitória do Xingu', NULL),
(144, 'Xinguara', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_contato`
--

CREATE TABLE `tbl_contato` (
  `id_contato` int(11) NOT NULL,
  `nome_contato` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_fornecedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_contato_telefone`
--

CREATE TABLE `tbl_contato_telefone` (
  `id_contato` int(11) NOT NULL,
  `id_telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_expediente`
--

CREATE TABLE `tbl_expediente` (
  `id_expediente` int(11) NOT NULL,
  `horario_expediente` varchar(100) NOT NULL,
  `comentario_expediente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_expediente`
--

INSERT INTO `tbl_expediente` (`id_expediente`, `horario_expediente`, `comentario_expediente`) VALUES
(1, '8h - 14h', NULL),
(2, '8h - 17h', NULL),
(3, '8h - 18h', NULL),
(4, '24hs', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_fornecedor`
--

CREATE TABLE `tbl_fornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `nome_fornecedor` varchar(100) NOT NULL,
  `web_site` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_fornecedor_telefone`
--

CREATE TABLE `tbl_fornecedor_telefone` (
  `id_fornecedor` int(11) NOT NULL,
  `id_telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_link`
--

CREATE TABLE `tbl_link` (
  `id_link` int(11) NOT NULL,
  `nome_link` varchar(100) NOT NULL,
  `designacao` varchar(100) NOT NULL,
  `ip_link` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `link_backup` tinyint(1) NOT NULL DEFAULT '0',
  `id_tipo_velocidade` int(11) NOT NULL,
  `id_tipo_acesso` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_perfil`
--

CREATE TABLE `tbl_perfil` (
  `id_perfil` int(11) NOT NULL,
  `nome_perfil` varchar(100) NOT NULL,
  `comentario_perfil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_perfil`
--

INSERT INTO `tbl_perfil` (`id_perfil`, `nome_perfil`, `comentario_perfil`) VALUES
(1, 'Usuario Comum', NULL),
(2, 'Administrador', NULL),
(3, 'Super Admin', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_telefone`
--

CREATE TABLE `tbl_telefone` (
  `id_telefone` int(11) NOT NULL,
  `numero_telefone` varchar(30) NOT NULL,
  `id_tipo_categoria_telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_telefone_voip`
--

CREATE TABLE `tbl_telefone_voip` (
  `id_telefone_voip` int(11) NOT NULL,
  `ip_voip` varchar(15) NOT NULL,
  `descricao_voip` varchar(100) NOT NULL,
  `id_telefone` int(11) NOT NULL,
  `id_tipo_categoria_voip` int(11) NOT NULL,
  `id_tipo_equipamento_voip` int(11) NOT NULL,
  `id_tipo_contexto_voip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_tipo_acesso`
--

CREATE TABLE `tbl_tipo_acesso` (
  `id_tipo_acesso` int(11) NOT NULL,
  `nome_acesso` varchar(100) NOT NULL,
  `comentario_acesso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_tipo_acesso`
--

INSERT INTO `tbl_tipo_acesso` (`id_tipo_acesso`, `nome_acesso`, `comentario_acesso`) VALUES
(1, 'Rádio', NULL),
(2, 'Satélite', NULL),
(3, 'Terrestre', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_tipo_categoria_telefone`
--

CREATE TABLE `tbl_tipo_categoria_telefone` (
  `id_tipo_categoria_telefone` int(11) NOT NULL,
  `nome_tipo_categoria_telefone` varchar(100) NOT NULL,
  `comentario_tipo_categoria_telefone` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_tipo_categoria_telefone`
--

INSERT INTO `tbl_tipo_categoria_telefone` (`id_tipo_categoria_telefone`, `nome_tipo_categoria_telefone`, `comentario_tipo_categoria_telefone`) VALUES
(1, 'Fixo', NULL),
(2, 'Celular', NULL),
(3, 'Ramal', NULL),
(4, 'Voip', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_tipo_categoria_voip`
--

CREATE TABLE `tbl_tipo_categoria_voip` (
  `id_categoria_voip` int(11) NOT NULL,
  `nome_tipo_categoria` varchar(100) NOT NULL,
  `comentario_categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_tipo_categoria_voip`
--

INSERT INTO `tbl_tipo_categoria_voip` (`id_categoria_voip`, `nome_tipo_categoria`, `comentario_categoria`) VALUES
(1, 'FXS', NULL),
(2, 'SIP', NULL),
(3, 'New Bridge', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_tipo_contexto_voip`
--

CREATE TABLE `tbl_tipo_contexto_voip` (
  `id_tipo_contexto_voip` int(11) NOT NULL,
  `nome_tipo_contexto_voip` varchar(100) NOT NULL,
  `comentario_tipo_contexto_voip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_tipo_contexto_voip`
--

INSERT INTO `tbl_tipo_contexto_voip` (`id_tipo_contexto_voip`, `nome_tipo_contexto_voip`, `comentario_tipo_contexto_voip`) VALUES
(1, 'Acesso Padrão', ''),
(2, 'Acesso Local Fixo', ''),
(3, 'Acesso Local Celular', ''),
(4, 'Acesso Fixo PA', ''),
(5, 'Acesso DDD Fixo', ''),
(6, 'Acesso DDD Celular', ''),
(7, 'Acesso Total', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_tipo_equipamento_voip`
--

CREATE TABLE `tbl_tipo_equipamento_voip` (
  `id_tipo_equipamento_voip` int(11) NOT NULL,
  `nome_tipo_equipamento` varchar(100) NOT NULL,
  `comentario_tipo_equipamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_tipo_equipamento_voip`
--

INSERT INTO `tbl_tipo_equipamento_voip` (`id_tipo_equipamento_voip`, `nome_tipo_equipamento`, `comentario_tipo_equipamento`) VALUES
(1, 'ATA', NULL),
(2, 'Telefone IP', NULL),
(3, 'Telefone Analógico', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_tipo_velocidade`
--

CREATE TABLE `tbl_tipo_velocidade` (
  `id_tipo_velocidade` int(11) NOT NULL,
  `nome_velocidade` varchar(100) NOT NULL,
  `comentario_velocidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tbl_tipo_velocidade`
--

INSERT INTO `tbl_tipo_velocidade` (`id_tipo_velocidade`, `nome_velocidade`, `comentario_velocidade`) VALUES
(1, '64', NULL),
(2, '128', NULL),
(3, '256', NULL),
(4, '512', NULL),
(5, '1024', NULL),
(6, '2048', NULL),
(7, '4096', NULL),
(8, '8192', NULL),
(9, '16384', NULL),
(10, '2048', NULL),
(11, '384', NULL),
(12, '6144', NULL),
(13, '10240', NULL),
(14, '34816', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_unidade`
--

CREATE TABLE `tbl_unidade` (
  `id_unidade` int(11) NOT NULL,
  `nome_unidade` varchar(100) NOT NULL,
  `id_unidade_responsavel` int(11) DEFAULT NULL,
  `endereco` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `id_cidade` int(11) NOT NULL,
  `id_expediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_unidade_telefone`
--

CREATE TABLE `tbl_unidade_telefone` (
  `id_unidade` int(11) NOT NULL,
  `id_telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `login_rede` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `sobreaviso` tinyint(1) NOT NULL DEFAULT '0',
  `tecnico` tinyint(1) NOT NULL DEFAULT '0',
  `id_perfil` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_usuario_telefone`
--

CREATE TABLE `tbl_usuario_telefone` (
  `id_usuario` int(11) NOT NULL,
  `id_telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_ad_atributo`
--
ALTER TABLE `tbl_ad_atributo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_ad_replicador`
--
ALTER TABLE `tbl_ad_replicador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_ad_ user`
--
ALTER TABLE `tbl_ad_ user`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Índices de tabela `tbl_cidade`
--
ALTER TABLE `tbl_cidade`
  ADD PRIMARY KEY (`id_cidade`);

--
-- Índices de tabela `tbl_contato`
--
ALTER TABLE `tbl_contato`
  ADD PRIMARY KEY (`id_contato`),
  ADD KEY `FK_tbl_contato_tbl_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tbl_contato_telefone`
--
ALTER TABLE `tbl_contato_telefone`
  ADD PRIMARY KEY (`id_contato`,`id_telefone`),
  ADD KEY `FK_tbl_contato_telefone_tbl_telefone` (`id_telefone`),
  ADD KEY `FK_tbl_contato_telefone_tbl_contato` (`id_contato`);

--
-- Índices de tabela `tbl_expediente`
--
ALTER TABLE `tbl_expediente`
  ADD PRIMARY KEY (`id_expediente`);

--
-- Índices de tabela `tbl_fornecedor`
--
ALTER TABLE `tbl_fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `tbl_fornecedor_telefone`
--
ALTER TABLE `tbl_fornecedor_telefone`
  ADD PRIMARY KEY (`id_fornecedor`,`id_telefone`),
  ADD KEY `FK_tbl_fornecedor_telefone_tbl_telefone` (`id_telefone`),
  ADD KEY `FK_tbl_fornecedor_telefone_tbl_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tbl_link`
--
ALTER TABLE `tbl_link`
  ADD PRIMARY KEY (`id_link`),
  ADD KEY `FK_tbl_link_tbl_tipo_velocidade` (`id_tipo_velocidade`),
  ADD KEY `FK_tbl_link_tbl_tipo_acesso` (`id_tipo_acesso`),
  ADD KEY `FK_tbl_link_tbl_unidade` (`id_unidade`),
  ADD KEY `FK_tbl_link_tbl_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tbl_perfil`
--
ALTER TABLE `tbl_perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices de tabela `tbl_telefone`
--
ALTER TABLE `tbl_telefone`
  ADD PRIMARY KEY (`id_telefone`),
  ADD UNIQUE KEY `numero_telefone` (`numero_telefone`),
  ADD KEY `FK_tbl_telefone_tbl_tipo_categoria_telefone` (`id_tipo_categoria_telefone`);

--
-- Índices de tabela `tbl_telefone_voip`
--
ALTER TABLE `tbl_telefone_voip`
  ADD PRIMARY KEY (`id_telefone_voip`),
  ADD UNIQUE KEY `id_telefone` (`id_telefone`),
  ADD KEY `id_tipo_categoria` (`id_tipo_categoria_voip`),
  ADD KEY `id_tipo_equipamento` (`id_tipo_equipamento_voip`),
  ADD KEY `id_tipo_contexto` (`id_tipo_contexto_voip`);

--
-- Índices de tabela `tbl_tipo_acesso`
--
ALTER TABLE `tbl_tipo_acesso`
  ADD PRIMARY KEY (`id_tipo_acesso`);

--
-- Índices de tabela `tbl_tipo_categoria_telefone`
--
ALTER TABLE `tbl_tipo_categoria_telefone`
  ADD PRIMARY KEY (`id_tipo_categoria_telefone`);

--
-- Índices de tabela `tbl_tipo_categoria_voip`
--
ALTER TABLE `tbl_tipo_categoria_voip`
  ADD PRIMARY KEY (`id_categoria_voip`);

--
-- Índices de tabela `tbl_tipo_contexto_voip`
--
ALTER TABLE `tbl_tipo_contexto_voip`
  ADD PRIMARY KEY (`id_tipo_contexto_voip`);

--
-- Índices de tabela `tbl_tipo_equipamento_voip`
--
ALTER TABLE `tbl_tipo_equipamento_voip`
  ADD PRIMARY KEY (`id_tipo_equipamento_voip`);

--
-- Índices de tabela `tbl_tipo_velocidade`
--
ALTER TABLE `tbl_tipo_velocidade`
  ADD PRIMARY KEY (`id_tipo_velocidade`);

--
-- Índices de tabela `tbl_unidade`
--
ALTER TABLE `tbl_unidade`
  ADD PRIMARY KEY (`id_unidade`),
  ADD KEY `FK_tbl_unidade_tbl_cidade` (`id_cidade`),
  ADD KEY `FK_tbl_unidade_tbl_expediente` (`id_expediente`),
  ADD KEY `FK_tbl_unidade_tbl_unidade` (`id_unidade_responsavel`);

--
-- Índices de tabela `tbl_unidade_telefone`
--
ALTER TABLE `tbl_unidade_telefone`
  ADD PRIMARY KEY (`id_unidade`,`id_telefone`),
  ADD KEY `FK_tbl_unidade_telefone_tbl_telefone_idx` (`id_telefone`),
  ADD KEY `FK_tbl_unidade_telefone_tbl_unidade_idx` (`id_unidade`);

--
-- Índices de tabela `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_tbl_usuario_tbl_cargo` (`id_cargo`),
  ADD KEY `FK_tbl_usuario_tbl_perfil` (`id_perfil`);

--
-- Índices de tabela `tbl_usuario_telefone`
--
ALTER TABLE `tbl_usuario_telefone`
  ADD PRIMARY KEY (`id_usuario`,`id_telefone`),
  ADD KEY `FK_tbl_usuario_telefone_tbl_telefone` (`id_telefone`),
  ADD KEY `FK_tbl_usuario_telefone_tbl_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_ad_atributo`
--
ALTER TABLE `tbl_ad_atributo`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_ad_replicador`
--
ALTER TABLE `tbl_ad_replicador`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_ad_ user`
--
ALTER TABLE `tbl_ad_ user`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_cidade`
--
ALTER TABLE `tbl_cidade`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de tabela `tbl_contato`
--
ALTER TABLE `tbl_contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_expediente`
--
ALTER TABLE `tbl_expediente`
  MODIFY `id_expediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbl_fornecedor`
--
ALTER TABLE `tbl_fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_link`
--
ALTER TABLE `tbl_link`
  MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_perfil`
--
ALTER TABLE `tbl_perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_telefone`
--
ALTER TABLE `tbl_telefone`
  MODIFY `id_telefone` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_telefone_voip`
--
ALTER TABLE `tbl_telefone_voip`
  MODIFY `id_telefone_voip` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_tipo_acesso`
--
ALTER TABLE `tbl_tipo_acesso`
  MODIFY `id_tipo_acesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_tipo_categoria_telefone`
--
ALTER TABLE `tbl_tipo_categoria_telefone`
  MODIFY `id_tipo_categoria_telefone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbl_tipo_categoria_voip`
--
ALTER TABLE `tbl_tipo_categoria_voip`
  MODIFY `id_categoria_voip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_tipo_contexto_voip`
--
ALTER TABLE `tbl_tipo_contexto_voip`
  MODIFY `id_tipo_contexto_voip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbl_tipo_equipamento_voip`
--
ALTER TABLE `tbl_tipo_equipamento_voip`
  MODIFY `id_tipo_equipamento_voip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_tipo_velocidade`
--
ALTER TABLE `tbl_tipo_velocidade`
  MODIFY `id_tipo_velocidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tbl_unidade`
--
ALTER TABLE `tbl_unidade`
  MODIFY `id_unidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tbl_contato`
--
ALTER TABLE `tbl_contato`
  ADD CONSTRAINT `FK_tbl_contato_tbl_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbl_fornecedor` (`id_fornecedor`);

--
-- Restrições para tabelas `tbl_contato_telefone`
--
ALTER TABLE `tbl_contato_telefone`
  ADD CONSTRAINT `FK_tbl_contato_telefone_tbl_contato` FOREIGN KEY (`id_contato`) REFERENCES `tbl_contato` (`id_contato`),
  ADD CONSTRAINT `FK_tbl_contato_telefone_tbl_telefone` FOREIGN KEY (`id_telefone`) REFERENCES `tbl_telefone` (`id_telefone`);

--
-- Restrições para tabelas `tbl_fornecedor_telefone`
--
ALTER TABLE `tbl_fornecedor_telefone`
  ADD CONSTRAINT `FK_tbl_fornecedor_telefone_tbl_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbl_fornecedor` (`id_fornecedor`),
  ADD CONSTRAINT `FK_tbl_fornecedor_telefone_tbl_telefone` FOREIGN KEY (`id_telefone`) REFERENCES `tbl_telefone` (`id_telefone`);

--
-- Restrições para tabelas `tbl_link`
--
ALTER TABLE `tbl_link`
  ADD CONSTRAINT `FK_tbl_link_tbl_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbl_fornecedor` (`id_fornecedor`),
  ADD CONSTRAINT `FK_tbl_link_tbl_tipo_acesso` FOREIGN KEY (`id_tipo_acesso`) REFERENCES `tbl_tipo_acesso` (`id_tipo_acesso`),
  ADD CONSTRAINT `FK_tbl_link_tbl_tipo_velocidade` FOREIGN KEY (`id_tipo_velocidade`) REFERENCES `tbl_tipo_velocidade` (`id_tipo_velocidade`),
  ADD CONSTRAINT `FK_tbl_link_tbl_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `tbl_unidade` (`id_unidade`);

--
-- Restrições para tabelas `tbl_telefone`
--
ALTER TABLE `tbl_telefone`
  ADD CONSTRAINT `FK_tbl_telefone_tbl_tipo_categoria_telefone` FOREIGN KEY (`id_tipo_categoria_telefone`) REFERENCES `tbl_tipo_categoria_telefone` (`id_tipo_categoria_telefone`);

--
-- Restrições para tabelas `tbl_telefone_voip`
--
ALTER TABLE `tbl_telefone_voip`
  ADD CONSTRAINT `FK_tbl_telefone_voip_tbl_telefone` FOREIGN KEY (`id_telefone`) REFERENCES `tbl_telefone` (`id_telefone`),
  ADD CONSTRAINT `FK_tbl_telefone_voip_tbl_tipo_categoria_voip` FOREIGN KEY (`id_tipo_categoria_voip`) REFERENCES `tbl_tipo_categoria_voip` (`id_categoria_voip`),
  ADD CONSTRAINT `FK_tbl_telefone_voip_tbl_tipo_contexto_voip` FOREIGN KEY (`id_tipo_contexto_voip`) REFERENCES `tbl_tipo_contexto_voip` (`id_tipo_contexto_voip`),
  ADD CONSTRAINT `FK_tbl_telefone_voip_tbl_tipo_equipamento_voip` FOREIGN KEY (`id_tipo_equipamento_voip`) REFERENCES `tbl_tipo_equipamento_voip` (`id_tipo_equipamento_voip`);

--
-- Restrições para tabelas `tbl_unidade`
--
ALTER TABLE `tbl_unidade`
  ADD CONSTRAINT `FK_tbl_unidade_tbl_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `tbl_cidade` (`id_cidade`),
  ADD CONSTRAINT `FK_tbl_unidade_tbl_expediente` FOREIGN KEY (`id_expediente`) REFERENCES `tbl_expediente` (`id_expediente`),
  ADD CONSTRAINT `FK_tbl_unidade_tbl_unidade` FOREIGN KEY (`id_unidade_responsavel`) REFERENCES `tbl_unidade` (`id_unidade`);

--
-- Restrições para tabelas `tbl_unidade_telefone`
--
ALTER TABLE `tbl_unidade_telefone`
  ADD CONSTRAINT `FK_tbl_unidade_telefone_tbl_telefone` FOREIGN KEY (`id_telefone`) REFERENCES `tbl_telefone` (`id_telefone`),
  ADD CONSTRAINT `FK_tbl_unidade_telefone_tbl_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `tbl_unidade` (`id_unidade`);

--
-- Restrições para tabelas `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `FK_tbl_usuario_tbl_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `tbl_cargo` (`id_cargo`),
  ADD CONSTRAINT `FK_tbl_usuario_tbl_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_perfil` (`id_perfil`);

--
-- Restrições para tabelas `tbl_usuario_telefone`
--
ALTER TABLE `tbl_usuario_telefone`
  ADD CONSTRAINT `FK_tbl_usuario_telefone_tbl_telefone` FOREIGN KEY (`id_telefone`) REFERENCES `tbl_telefone` (`id_telefone`),
  ADD CONSTRAINT `FK_tbl_usuario_telefone_tbl_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
