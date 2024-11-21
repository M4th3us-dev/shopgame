-- Criação do banco de dados
CREATE DATABASE api_db;

-- Seleção do banco de dados
USE api_db;

-- Criação da tabela 'games' para armazenar informações dos jogos
CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Usando AUTO_INCREMENT para gerar os IDs automaticamente
    nome VARCHAR(100) NOT NULL,         -- Nome do jogo
    descricao VARCHAR(255) NOT NULL,    -- Descrição do jogo
    preco DECIMAL(10, 2) NOT NULL,      -- Preço do jogo (usando DECIMAL para valores monetários)
    id_jogo VARCHAR(50) NOT NULL UNIQUE, -- ID único do jogo
    ano INT NOT NULL                    -- Ano de lançamento
);

-- Criação da tabela 'game_parts' para armazenar partes relacionadas aos jogos
CREATE TABLE game_parts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,         -- Tipo da parte (ex: expansão, conteúdo adicional)
    descricao VARCHAR(255) NOT NULL,    -- Descrição da parte
    id_game INT NOT NULL,               -- ID do jogo ao qual a parte pertence
    FOREIGN KEY (id_game) REFERENCES games(id)  -- Relacionamento com a tabela 'games'
);
