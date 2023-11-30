DROP TABLE IF EXISTS `exames`;
CREATE TABLE `exames` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_estudo` int(11) NOT NULL,
  `nome_paciente` varchar(100) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `modalidade` char(2) NOT NULL,
  `data_estudo` date NOT NULL,
  `data_registro` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

