-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2020 às 17:46
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetos_painel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin.estoque_imagens`
--

CREATE TABLE `admin.estoque_imagens` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin.estoque_imagens`
--

INSERT INTO `admin.estoque_imagens` (`id`, `produto_id`, `imagem`) VALUES
(1, 1, '5f8f7b4a5eb0a.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin.imagens_imoveis`
--

CREATE TABLE `admin.imagens_imoveis` (
  `id` int(11) NOT NULL,
  `imovel_id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin.imagens_imoveis`
--

INSERT INTO `admin.imagens_imoveis` (`id`, `imovel_id`, `imagem`) VALUES
(2, 2, '5fb40540e031b.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_agenda`
--

CREATE TABLE `admin_agenda` (
  `id` int(11) NOT NULL,
  `tarefa` varchar(255) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_agenda`
--

INSERT INTO `admin_agenda` (`id`, `tarefa`, `data`) VALUES
(1, 'Teste', '2020-11-18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_chat`
--

CREATE TABLE `admin_chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_chat`
--

INSERT INTO `admin_chat` (`id`, `user_id`, `mensagem`) VALUES
(1, 1, 'Teste\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_clientes`
--

CREATE TABLE `admin_clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_clientes`
--

INSERT INTO `admin_clientes` (`id`, `nome`, `email`, `tipo`, `cpf_cnpj`) VALUES
(1, 'Cliente', 'cliente@email.com', 'fisico', '000.000.000-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_empreendimentos`
--

CREATE TABLE `admin_empreendimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `preco` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_empreendimentos`
--

INSERT INTO `admin_empreendimentos` (`id`, `nome`, `tipo`, `preco`, `imagem`, `slug`, `order_id`) VALUES
(1, 'Empreendimento', 'residencial', '100.000,00', '5f8f79a5a20b7.jpg', 'empreendimento', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_estoque`
--

CREATE TABLE `admin_estoque` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `largura` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `comprimento` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_estoque`
--

INSERT INTO `admin_estoque` (`id`, `nome`, `descricao`, `largura`, `altura`, `comprimento`, `peso`, `quantidade`) VALUES
(1, 'Mouse', 'Black & Green', 2, 1, 1, 3, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_financeiro`
--

CREATE TABLE `admin_financeiro` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `vencimento` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_financeiro`
--

INSERT INTO `admin_financeiro` (`id`, `cliente_id`, `nome`, `valor`, `vencimento`, `status`) VALUES
(1, 1, 'Pagamento', '100,00', '2020-10-22', 1),
(2, 1, 'Pagamento', '100,00', '2020-11-21', 0),
(3, 1, 'Pagamento', '100,00', '2020-12-21', 0),
(4, 1, 'Pagamento', '100,00', '2021-01-20', 0),
(5, 1, 'Pagamento', '100,00', '2021-02-19', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_imoveis`
--

CREATE TABLE `admin_imoveis` (
  `id` int(11) NOT NULL,
  `empreend_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `area` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_imoveis`
--

INSERT INTO `admin_imoveis` (`id`, `empreend_id`, `nome`, `preco`, `area`, `order_id`) VALUES
(2, 1, 'Teste', '100.00', 200, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_online`
--

CREATE TABLE `admin_online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin_users`
--

INSERT INTO `admin_users` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'admin', 'admin', '', 'Admin', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_visits`
--

CREATE TABLE `admin_visits` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_categorias`
--

CREATE TABLE `site_categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_config`
--

CREATE TABLE `site_config` (
  `id` int(11) NOT NULL,
  `nome_autor` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `icone1` varchar(255) NOT NULL,
  `descricao1` text NOT NULL,
  `icone2` varchar(255) NOT NULL,
  `descricao2` text NOT NULL,
  `icone3` varchar(255) NOT NULL,
  `descricao3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_depoimentos`
--

CREATE TABLE `site_depoimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `depoimento` text NOT NULL,
  `data` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_noticias`
--

CREATE TABLE `site_noticias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `capa` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_servicos`
--

CREATE TABLE `site_servicos` (
  `id` int(11) NOT NULL,
  `servico` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_slides`
--

CREATE TABLE `site_slides` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin.estoque_imagens`
--
ALTER TABLE `admin.estoque_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin.imagens_imoveis`
--
ALTER TABLE `admin.imagens_imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_agenda`
--
ALTER TABLE `admin_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_chat`
--
ALTER TABLE `admin_chat`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_clientes`
--
ALTER TABLE `admin_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_empreendimentos`
--
ALTER TABLE `admin_empreendimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_estoque`
--
ALTER TABLE `admin_estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_financeiro`
--
ALTER TABLE `admin_financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_imoveis`
--
ALTER TABLE `admin_imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_online`
--
ALTER TABLE `admin_online`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `admin_visits`
--
ALTER TABLE `admin_visits`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `site_categorias`
--
ALTER TABLE `site_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `site_config`
--
ALTER TABLE `site_config`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `site_depoimentos`
--
ALTER TABLE `site_depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `site_noticias`
--
ALTER TABLE `site_noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `site_servicos`
--
ALTER TABLE `site_servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `site_slides`
--
ALTER TABLE `site_slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin.estoque_imagens`
--
ALTER TABLE `admin.estoque_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `admin.imagens_imoveis`
--
ALTER TABLE `admin.imagens_imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `admin_agenda`
--
ALTER TABLE `admin_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `admin_chat`
--
ALTER TABLE `admin_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `admin_clientes`
--
ALTER TABLE `admin_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `admin_empreendimentos`
--
ALTER TABLE `admin_empreendimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `admin_estoque`
--
ALTER TABLE `admin_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `admin_financeiro`
--
ALTER TABLE `admin_financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `admin_imoveis`
--
ALTER TABLE `admin_imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `admin_online`
--
ALTER TABLE `admin_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `admin_visits`
--
ALTER TABLE `admin_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_categorias`
--
ALTER TABLE `site_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_depoimentos`
--
ALTER TABLE `site_depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_noticias`
--
ALTER TABLE `site_noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_servicos`
--
ALTER TABLE `site_servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_slides`
--
ALTER TABLE `site_slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
