<?php

header('Content-Type: application/json');

// Simulando uma resposta da API (como um GET simples)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Resposta com uma lista de jogos
    echo json_encode([
        [
            "id" => 1,
            "nome" => "GTA V",
            "descricao" => "Ação, Aventura",
            "preco" => 150.00,
            "id_jogo" => "12345",
            "ano" => 2014
        ],
        [
            "id" => 2,
            "nome" => "Minecraft",
            "descricao" => "Aventura, Criativo",
            "preco" => 50.00,
            "id_jogo" => "12346",
            "ano" => 2011
        ]
    ]);
}
?>
