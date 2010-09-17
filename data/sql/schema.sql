CREATE TABLE usuario (id BIGINT AUTO_INCREMENT, nome VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, senha VARCHAR(128) NOT NULL, type VARCHAR(255), matricula VARCHAR(20) NOT NULL, endereco VARCHAR(200) NOT NULL, fone_residencial VARCHAR(20) NOT NULL, fone_celular VARCHAR(20) NOT NULL, coordenador TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE area_afinidade (id BIGINT AUTO_INCREMENT, nome VARCHAR(50) NOT NULL, slug VARCHAR(255), UNIQUE INDEX area_afinidade_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE area_interesse (id BIGINT AUTO_INCREMENT, professor_id BIGINT NOT NULL, nome VARCHAR(50) NOT NULL, INDEX professor_id_idx (professor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE configuracao (id BIGINT AUTO_INCREMENT, instituicao VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, telefone VARCHAR(50) NOT NULL, alunos_por_professor BIGINT NOT NULL, url VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE cronograma (id BIGINT AUTO_INCREMENT, proposta_id BIGINT, etapa VARCHAR(255), atividade VARCHAR(255) NOT NULL, produto VARCHAR(100) NOT NULL, data_entrega DATE NOT NULL, detalhamento TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX proposta_id_idx (proposta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE curso (id BIGINT AUTO_INCREMENT, nome VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE orientacao (aluno_id BIGINT, professor_id BIGINT, status VARCHAR(255) DEFAULT '0', PRIMARY KEY(aluno_id, professor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE professor_area_afinidade (professor_id INT, area_afinidade_id INT, PRIMARY KEY(professor_id, area_afinidade_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE proposta (id BIGINT AUTO_INCREMENT, aluno_id BIGINT NOT NULL, curso_id BIGINT NOT NULL, titulo VARCHAR(255) NOT NULL, descricao_problema TEXT NOT NULL, descricao_solucao TEXT NOT NULL, objetivos TEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX aluno_id_idx (aluno_id), INDEX curso_id_idx (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE usuario (id BIGINT AUTO_INCREMENT, nome VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, senha VARCHAR(128) NOT NULL, type VARCHAR(255), matricula VARCHAR(20) NOT NULL, endereco VARCHAR(200) NOT NULL, fone_residencial VARCHAR(20) NOT NULL, fone_celular VARCHAR(20) NOT NULL, coordenador TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX usuario_type_idx (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
ALTER TABLE area_interesse ADD CONSTRAINT area_interesse_professor_id_usuario_id FOREIGN KEY (professor_id) REFERENCES usuario(id);
ALTER TABLE cronograma ADD CONSTRAINT cronograma_proposta_id_proposta_id FOREIGN KEY (proposta_id) REFERENCES proposta(id);
ALTER TABLE orientacao ADD CONSTRAINT orientacao_professor_id_usuario_id FOREIGN KEY (professor_id) REFERENCES usuario(id);
ALTER TABLE orientacao ADD CONSTRAINT orientacao_aluno_id_usuario_id FOREIGN KEY (aluno_id) REFERENCES usuario(id);
ALTER TABLE professor_area_afinidade ADD CONSTRAINT professor_area_afinidade_professor_id_usuario_id FOREIGN KEY (professor_id) REFERENCES usuario(id);
ALTER TABLE professor_area_afinidade ADD CONSTRAINT professor_area_afinidade_area_afinidade_id_area_afinidade_id FOREIGN KEY (area_afinidade_id) REFERENCES area_afinidade(id);
ALTER TABLE proposta ADD CONSTRAINT proposta_curso_id_curso_id FOREIGN KEY (curso_id) REFERENCES curso(id);
ALTER TABLE proposta ADD CONSTRAINT proposta_aluno_id_usuario_id FOREIGN KEY (aluno_id) REFERENCES usuario(id);
