-- Local: /admin/sql/install.mysql.utf8.sql
-- Estrutura do Banco de Dados SIGESPE

-- 1. Tabela de Companhias
CREATE TABLE IF NOT EXISTS `#__sigespe_companhia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `sigla` VARCHAR(20) NOT NULL,
  `id_responsavel` INT(11) DEFAULT NULL,
  `ordenacao` INT(11) DEFAULT 0,
  `estado` TINYINT(1) DEFAULT 1,
  `created` DATETIME DEFAULT '0000-00-00 00:00:00',
  `created_by` INT(10) UNSIGNED DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabela de Seções
CREATE TABLE IF NOT EXISTS `#__sigespe_secao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `sigla` VARCHAR(20) NOT NULL,
  `descricao` TEXT,
  `companhia_id` INT(11) NOT NULL,
  `id_responsavel` INT(11) DEFAULT NULL,
  `ordenacao` INT(11) DEFAULT 0,
  `estado` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_companhia` (`companhia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabela de Carteiras (Função/Setor)
CREATE TABLE IF NOT EXISTS `#__sigespe_carteira` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `sigla` VARCHAR(20) NOT NULL,
  `descricao` TEXT,
  `secao_id` INT(11) NOT NULL,
  `id_responsavel` INT(11) DEFAULT NULL,
  `estado` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_secao` (`secao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabela de Cursos
CREATE TABLE IF NOT EXISTS `#__sigespe_curso` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `tipo` ENUM('Militar', 'Civil') NOT NULL DEFAULT 'Militar',
  `nivel` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabela de Militares
CREATE TABLE IF NOT EXISTS `#__sigespe_militar` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` VARCHAR(255) NOT NULL,
  `nome_guerra` VARCHAR(100) NOT NULL,
  `posto_grad` VARCHAR(50) NOT NULL,
  `companhia_id` INT(11) DEFAULT NULL,
  `secao_id` INT(11) DEFAULT NULL,
  `carteira_id` INT(11) DEFAULT NULL,
  `status` VARCHAR(50) DEFAULT 'Pronto para Serviço',
  `foto` VARCHAR(255) DEFAULT NULL,
  `estado` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_companhia_mil` (`companhia_id`),
  KEY `idx_secao_mil` (`secao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Tabela Pivô (Militar x Cursos)
CREATE TABLE IF NOT EXISTS `#__sigespe_militar_cursos` (
  `militar_id` INT(11) NOT NULL,
  `curso_id` INT(11) NOT NULL,
  PRIMARY KEY (`militar_id`, `curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir dados básicos para teste (opcional)
INSERT IGNORE INTO `#__sigespe_companhia` (`nome`, `sigla`) VALUES ('Comando e Apoio', 'CCAp');
INSERT IGNORE INTO `#__sigespe_curso` (`nome`, `tipo`, `nivel`) VALUES ('Não possui Cursos', 'Civil', 'N/A');