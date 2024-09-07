-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6786
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando dados para a tabela lara_eventos.eventos: ~1 rows (aproximadamente)
INSERT INTO `eventos` (`id`, `title`, `slug`, `description`, `data_inicio`, `data_fim`, `local`, `capacidade`, `banner`, `created_at`, `updated_at`, `responsavel`) VALUES
	(3, 'Escola Bíblica de Jovens 2024 - Setor 8', 'escola-biblica-de-jovens-2024-setor-8', 'EBJ 2024', '2024-10-10', '2024-10-13', 'AD Pirangi', 150, 'banner_escola-biblica-de-jovens-2024.png', '2024-09-01 18:20:37', '2024-09-06 19:48:35', NULL);

-- Copiando dados para a tabela lara_eventos.failed_jobs: ~0 rows (aproximadamente)

-- Copiando dados para a tabela lara_eventos.inscritos: ~1 rows (aproximadamente)
INSERT INTO `inscritos` (`id`, `tipos_inscricao_id`, `evento_id`, `nome`, `idade`, `email`, `telefone`, `created_at`, `updated_at`, `congregacao`, `status`) VALUES
	(2, 1, 3, 'Leonardo', 31, 'leonandrade22@gmail.com', '84996667335', '2024-09-06 16:47:26', '2024-09-06 16:47:26', 'Pirangi', 'Pendente');

-- Copiando dados para a tabela lara_eventos.migrations: ~8 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(19, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(20, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(21, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(22, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(23, '2023_02_06_130723_create_eventos_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(24, '2023_02_06_130736_create_inscritos_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(25, '2024_09_05_234238_create_tipos_inscricao_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(26, '2024_09_05_234527_add_fields_to_inscritos_table', 3);

-- Copiando dados para a tabela lara_eventos.password_resets: ~0 rows (aproximadamente)

-- Copiando dados para a tabela lara_eventos.personal_access_tokens: ~0 rows (aproximadamente)

-- Copiando dados para a tabela lara_eventos.tipos_inscricao: ~2 rows (aproximadamente)
INSERT INTO `tipos_inscricao` (`id`, `nome`, `descricao`, `valor`, `created_at`, `updated_at`, `numero_vagas`) VALUES
	(1, 'Kit Inscrição - Camisa s/lanche', 'Kit Inscrição - Camisa s/lanche', 40.00, '2024-09-06 16:16:45', '2024-09-06 17:35:20', 129);
INSERT INTO `tipos_inscricao` (`id`, `nome`, `descricao`, `valor`, `created_at`, `updated_at`, `numero_vagas`) VALUES
	(2, 'Kit Inscrição - Camisa c/lanche', 'Kit Inscrição - Camisa c/lanche', 45.00, '2024-09-06 17:35:57', '2024-09-06 17:35:57', 130);

-- Copiando dados para a tabela lara_eventos.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Leonardo', 'leonandrade22@gmail.com', NULL, '$2y$10$Y3vC8RKjA6GrXb4/4qwRcu4hMMSUh2CWZMux065STU2o8HYVfQZSi', NULL, '2023-05-12 12:28:01', '2023-05-12 12:28:01');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'Teste', 'email@email.com', NULL, '$2y$10$gm7lAkt6JPT7pqH9dlyHzuXA2aN2mcOZXbt5SG8UqAnfzh8tmFqMu', NULL, '2023-07-25 21:39:42', '2023-07-25 21:39:42');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
