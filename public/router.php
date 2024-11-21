<?php

// Incluir os controladores necessários
require_once 'controller/controllergames.php';
require_once 'model/game.php';

// Roteamento das requisições
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Obtém a URL da requisição
$uri = rtrim($uri, '/'); // Remove o "/" no final

// Verifica qual método HTTP foi utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Instancia o controlador
$controller = ControllerGames::getInstance();

// Define as rotas e mapeia os métodos
switch ($uri) {
    case '/games': // Rota para listar todos os jogos
        if ($method == 'GET') {
            $controller->list(); // Chama o método list()
        } elseif ($method == 'POST') { // Rota para criar um novo jogo
            $controller->create(); // Chama o método create()
        }
        break;

    case (preg_match('/^\/games\/\d+$/', $uri) ? true : false): // Rota para buscar um jogo por ID (usando expressões regulares)
        $id = basename($uri); // Extrai o ID do jogo da URL
        if ($method == 'GET') {
            $controller->getById($id); // Chama o método getById()
        } elseif ($method == 'PUT') { // Rota para atualizar um jogo
            $controller->update(); // Chama o método update()
        } elseif ($method == 'DELETE') { // Rota para deletar um jogo
            $controller->delete(); // Chama o método delete()
        }
        break;

    default:
        http_response_code(404); // Rota não encontrada
        echo json_encode(['message' => 'Rota não encontrada']);
        break;
}
?>
