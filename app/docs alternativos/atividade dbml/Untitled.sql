CREATE TABLE `usuarios` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) UNIQUE NOT NULL,
  `criado_em` timestamp DEFAULT (now())
);

CREATE TABLE `cursos` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text,
  `carga_horaria` integer
);

CREATE TABLE `matriculas` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `usuario_id` integer NOT NULL,
  `curso_id` integer NOT NULL,
  `data_matricula` timestamp DEFAULT (now())
);

ALTER TABLE `matriculas` ADD FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

ALTER TABLE `matriculas` ADD FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
